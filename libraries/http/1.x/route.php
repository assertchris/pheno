<?php

return export(default: fn (...$params) => new class (...$params) {
    private string $method;

    private string $path;

    /**
     * @var string|string[]|closure
     */
    private string|array|Closure $handler;

    /**
     * @var array<string, mixed>
     */
    private array $parameters = [];

    private ?string $name = null;

    /**
     * @param string|string[]|closure $handler
     */
    public function __construct(
        string $method,
        string $path,
        string|array|closure $handler,
    ) {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }

    /**
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return $this->parameters;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function matches(string $method, string $path): bool
    {
        if ($this->method === $method && $this->path === $path) {
            return true;
        }

        $regexPattern = preg_replace_callback(
            '#\{([a-zA-Z_][a-zA-Z0-9_]*)(?::([^}]+))?\}#',
            function ($matches) {
                $paramName = $matches[1];
                $regex = $matches[2] ?? '[^/]+';

                return "(?P<{$paramName}>{$regex})";
            },
            $this->path
        );

        $regexPattern = "#^{$regexPattern}$#";

        if (preg_match($regexPattern, $path, $matches)) {
            $this->parameters = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return true;
        }

        return false;
    }

    private function normalisePath(string $path): string
    {
        $path = trim($path, '/');

        return preg_replace('/\/{2,}/', '/', "/{$path}/");
    }

    public function dispatch(): mixed
    {
        return import('../../support/1.x/call')($this->handler, $this->parameters);
    }

    public function name(?string $name = null): null|string|self
    {
        if (is_null($name)) {
            return $this->name;
        }

        $this->name = $name;

        return $this;
    }
});
