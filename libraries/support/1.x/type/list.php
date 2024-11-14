<?php

return export(default: fn (...$params) => new class (...$params) {
    private bool $required = true;

    private mixed $default = null;

    private int|float|null $min = null;

    private int|float|null $max = null;

    public function __construct(
        private readonly object $key,
        private readonly object $value
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

    public function min(int|float|null $value = null): int|float|null|self
    {
        return import('shared/access-min')($this, $value);
    }

    public function max(int|float|null $value = null): int|float|null|self
    {
        return import('shared/access-max')($this, $value);
    }

    public function assert(mixed $value = null, ?string $key = null): bool
    {
        import('shared/validate-required')($this, $value, $key);

        if (! is_array($value)) {
            throw import('exceptions/invalid-type')($value, 'array');
        }

        import('shared/validate-size')(that: $this, value: $value, size: count($value));

        foreach ($value as $k => $v) {
            $this->key->assert($k);
            $this->value->assert($v);
        }

        return true;
    }
});
