<?php

return export(default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
    public const string name = 'http/missing-named-route';

    public function __construct(string $key)
    {
        parent::__construct("'{$key}' named route missing");
    }
});
