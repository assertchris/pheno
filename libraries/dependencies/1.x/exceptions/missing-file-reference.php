<?php

return export(default: fn () => new class () extends Exception {
    public const string name = 'dependencies/missing-file-reference';

    public function __construct()
    {
        parent::__construct('missing file reference');
    }
});
