<?php

return export(default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
    public const string name = 'support/type/too-small';

    public function __construct(mixed $value, int $size)
    {
        parent::__construct("'{$value}' is smaller than {$size}");
    }
});
