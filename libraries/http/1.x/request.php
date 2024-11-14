<?php

$type = import('../../support/1.x/type');

return export(
    default: fn (...$params) => new class (...$params) {
        private string $path;

        /**
         * @var array<string, array<int, string>|string>
         */
        public array $query = [];

        /**
         * @param array<string, array<int, string>|string> $body
         * @param array<string, string> $headers
         */
        public function __construct(
            private string $method,
            public string $uri,
            public array $body = [],
            public array $headers = [],
        ) {
            $this->path ??= $this->resolvePath();
            $this->query ??= $this->resolveQuery();
        }

        public function method(?string $value = null): string|self
        {
            if (is_null($value)) {
                return $this->method;
            }

            $this->method = $value;
            return $this;
        }

        public function path(?string $value = null): string|self
        {
            if (is_null($value)) {
                return $this->path;
            }

            $this->path = $value;
            return $this;
        }

        /**
         * @return string|array<string, string>
         */
        private function parsedUrl(?string $key = null, mixed $default = null): string|array
        {
            $parsed = parse_url(rawurldecode($this->uri));

            if (!$parsed) {
                throw import('exceptions/url-parsing-error')();
            }

            $parsed = array_map(fn ($next) => (string) $next, $parsed);

            if (!is_null($key)) {
                if (isset($parsed[$key])) {
                    return $parsed[$key];
                }

                return $default;
            }

            return $parsed;
        }

        private function resolvePath(): string
        {
            /** @var string $result */
            $result = $this->parsedUrl('path', '');

            return $result;
        }

        /**
         * @return array<string, array|string>
         */
        private function resolveQuery(): array
        {
            /** @var string $parsed */
            $parsed = $this->parsedUrl('query', '');

            parse_str($parsed, $query);

            return $query;
        }

        public function has(string $key): bool
        {
            if (array_key_exists($key, $this->body)) {
                return true;
            }

            return array_key_exists($key, $this->query);
        }

        public function get(string $key, mixed $default = null): mixed
        {
            if (array_key_exists($key, $this->body)) {
                return $this->body[$key];
            }

            if (array_key_exists($key, $this->query)) {
                return $this->query[$key];
            }

            return $default;
        }
    },
    named: [
        'type' => fn () => $type->object([
            'method' => $type->function()->returns('string'),
            'uri' => $type->string(),
            'array' => $type->array(),
            'headers' => $type->array(),
            'path' => $type->function()->returns('string'),
            'query' => $type->array(),
        ]),
        'capture' => fn () => import('request')(
            method: $_SERVER['REQUEST_METHOD'],
            uri: $_SERVER['REQUEST_URI'],
            body: json_decode((string) file_get_contents('php://input'), true) ?? [],
            headers: array_filter($_SERVER, fn ($key) => str_starts_with($key, 'HTTP_'), ARRAY_FILTER_USE_KEY),
        ),
    ],
);
