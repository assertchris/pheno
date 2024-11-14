<?php

return export(default: fn () => new class () {
    private bool $required = true;

    private mixed $default = null;

    private ?string $returns = null;

    public function required(?bool $value = null): bool|self
    {
        return import('shared/access-required')($this, $value);
    }

    public function default(mixed $value): mixed
    {
        return import('shared/access-default')($this, $value);
    }

    public function returns(?string $value): self|string|null
    {
        return import('shared/access-returns')($this, $value);
    }

    public function assert(mixed $value = null, ?string $key = null): bool
    {
        import('shared/validate-required')($this, $value, $key);

        if (! is_object($value) || ! ($value instanceof Closure)) {
            throw import('exceptions/invalid-type')($value, 'function');
        }

        if (! is_null($this->returns)) {
            $reflector = new ReflectionFunction($value);

            $actual = $reflector->getReturnType();
            $expected = $this->returns;

            if (is_null($actual)) {
                throw import('exceptions/missing-return-type')($expected);
            }

            if ($actual instanceof ReflectionNamedType && $actual->getName() !== $expected) {
                throw import('exceptions/invalid-return-type')($actual, $expected);
            }
        }

        return true;
    }
});
