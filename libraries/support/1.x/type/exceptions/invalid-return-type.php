<?php

return export(default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
    public const string name = 'support/type/invalid-return-type';

    public function __construct(string $actual, string $expected)
    {
        parent::__construct("'{$actual}' return type is not '{$expected}'");
    }
});
