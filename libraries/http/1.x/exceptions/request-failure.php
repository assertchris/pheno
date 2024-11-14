<?php

return export(default: fn (...$params) => new class (...$params) extends Exception {
    public const string name = 'http/request-failure';

    public function __construct(string $key)
    {
        parent::__construct('request failure');
    }
});
