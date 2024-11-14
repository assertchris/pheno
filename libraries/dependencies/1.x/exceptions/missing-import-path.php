<?php

return export(default: fn () => new class () extends Exception {
    public const string name = 'dependencies/missing-import-path';

    public function __construct()
    {
        parent::__construct('missing import path');
    }
});
