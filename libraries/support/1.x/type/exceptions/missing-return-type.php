<?php

return export(default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
    public const string name = 'support/type/missing-return-type';

    public function __construct(string $key)
    {
        parent::__construct("'{$key}' return type is missing");
    }
});
