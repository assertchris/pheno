<?php

return export(default: fn () => new class () {
    private bool $required = true;

    private mixed $default = null;

    /**
     * @var array<mixed, mixed>
     */
    private array $options = [];

    private int|float|null $min = null;

    private int|float|null $max = null;

    public function required(?bool $value = null): bool|self
    {
        return import('shared/access-required')($this, $value);
    }

    public function default(mixed $value): mixed
    {
        return import('shared/access-default')($this, $value);
    }

    /**
     * @param array<int|string, mixed>|null $value
     * @return array<int|string, mixed>|self
     */
    public function options(?array $value = null): array|self
    {
        return import('shared/access-options')($this, $value);
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

        if (! is_numeric($value)) {
            throw import('exceptions/invalid-type')($value, 'number');
        }

        import('shared/validate-size')(that: $this, value: $value, size: $value);
        import('shared/validate-options')(that: $this, value: $value);

        return true;
    }
});
