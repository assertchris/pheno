<?php

return export(default: fn () => new class () {
    private bool $required = true;

    private mixed $default = null;

    public function required(?bool $value = null): bool|self
    {
        return import('shared/access-required')($this, $value);
    }

    public function default(mixed $value): mixed
    {
        return import('shared/access-default')($this, $value);
    }

    public function assert(mixed $value = null, ?string $key = null): bool
    {
        import('shared/validate-required')($this, $value, $key);

        if (! is_array($value)) {
            throw import('exceptions/invalid-type')($value, 'array');
        }

        return true;
    }
});
