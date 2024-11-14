<?php

return export(default: fn () => new class () extends Exception {
    public const string name = 'dependencies/missing-named-export';

    public function __construct()
    {
        parent::__construct('named exports are missing');
    }
});
