<?php

return export(default: fn () => new class () extends Exception {
    public const string name = 'dependencies/missing-default-export';

    public function __construct()
    {
        parent::__construct('default export is missing');
    }
});
