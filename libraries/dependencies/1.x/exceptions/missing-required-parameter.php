<?php

return export(default: fn () => new class () extends Exception {
    public const string name = 'dependencies/missing-required-parameter';

    public function __construct(?string $name = null)
    {
        parent::__construct("missing required parameter ({$name})");
    }
});
