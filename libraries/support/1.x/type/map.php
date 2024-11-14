<?php

return export(default: fn (...$params) => new class (...$params) {
    private bool $required = true;

    private mixed $default = null;

    /**
     * @var array<mixed, mixed>
     */
    private static array $parsed = [];

    /**
     * @param array<string, mixed> $map
     */
    public function __construct(
        private readonly array $map = [],
    ) {
    }

    public function required(?bool $value = null): bool|self
    {
        return import('shared/access-required')($this, $value);
    }

    public function default(mixed $value): mixed
    {
        return import('shared/access-default')($this, $value);
    }

    public function is(mixed $value = null, ?string $key = null): bool
    {
        if (! is_object($value) && ! is_array($value)) {
            return false;
        }

        [$error] = import('../attempt')(fn () => $this->assertMap($value, $key));

        return !$error;
    }

    public function assert(mixed $value = null, ?string $key = null): bool
    {
        import('shared/validate-required')($this, $value, $key);

        if (! is_object($value) && ! is_array($value)) {
            throw import('exceptions/invalid-type')($value, 'object|array');
        }

        $this->assertMap($value, $key);

        return true;
    }

    private function assertMap(mixed $value, ?string $key = null): void
    {
        foreach ($this->map as $key => $parser) {
            if (is_array($value)) {
                if (! isset($value[$key])) {
                    throw import('exceptions/missing-value')($key);
                }

                $parser->assert(
                    value: $value[$key],
                    key: $key,
                );

                continue;
            }

            if (is_object($value)) {
                if (! isset($value->$key) && ! method_exists($value, $key) && $parser->required()) {
                    throw import('exceptions/missing-value')($key);
                }

                if (method_exists($value, $key)) {
                    $parser->assert(
                        value: $value->$key(...),
                        key: $key,
                    );

                    continue;
                }

                if (property_exists($value, $key)) {
                    $parser->assert(
                        value: $value->$key,
                        key: $key,
                    );

                    continue;
                }
            }

            $parser->assert(
                value: $value,
                key: $key,
            );
        }
    }
});
