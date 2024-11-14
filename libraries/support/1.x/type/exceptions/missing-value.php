<?php

return export(default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
    public const string name = 'support/type/missing-value';

    public function __construct(string $key)
    {
        parent::__construct(trim("{$key} value is missing"));
    }
});
