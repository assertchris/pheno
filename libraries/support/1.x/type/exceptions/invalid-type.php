<?php

return export(default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
    public const string name = 'support/type/invalid-type';

    public function __construct(mixed $value, string $type)
    {
        if (is_object($value)) {
            if ($value instanceof Closure) {
                $value = 'function';
            } else {
                $value = 'object';
            }
        }

        if (is_array($value)) {
            $value = 'array';
        }

        parent::__construct("'{$value}' is not {$type}");
    }
});
