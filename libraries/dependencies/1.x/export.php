<?php

return fn (...$params) => new class (...$params) implements ArrayAccess {
    private Closure $default;

    /**
     * @var ArrayObject<string, object>|null
     */
    private ?ArrayObject $named = null;

    /**
     * @param array<string, object>|null $named
     */
    public function __construct(?Closure $default = null, ?array $named = null)
    {
        if (! is_null($default)) {
            $this->default = $default;
        }

        if (! is_null($named)) {
            $this->named = new ArrayObject($named, flags: ArrayObject::ARRAY_AS_PROPS);
        }
    }

    public function __invoke(mixed ...$params): mixed
    {
        if (isset($this->default)) {
            return ($this->default)(...$params);
        }

        throw import('exceptions/missing-default-export')();
    }

    public function offsetExists(mixed $offset): bool
    {
        if (isset($this->named)) {
            return isset($this->named[$offset]);
        }

        throw import('exceptions/missing-named-export')();
    }

    public function offsetGet(mixed $offset): mixed
    {
        if (isset($this->named)) {
            return $this->named[$offset];
        }

        throw import('exceptions/missing-named-export')();
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw import('exceptions/setting-named-exports-prohibited')();
    }

    public function offsetUnset(mixed $offset): void
    {
        throw import('exceptions/setting-named-exports-prohibited')();
    }

    public function __get(string $property): mixed
    {
        return $this->named->$property;
    }

    public function __set(string $property, mixed $value)
    {
        throw import('exceptions/setting-named-exports-prohibited')();
    }

    /**
     * @param array<mixed> $params
     */
    public function __call(string $method, array $params): mixed
    {
        if (isset($this->named, $this->named->$method)) {
            return ($this->named->$method)(...$params);
        }

        throw import('exceptions/missing-named-export')();
    }
};
