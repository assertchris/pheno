<?php

return export(default: fn () => new class () extends Exception {
    public const string name = 'dependencies/setting-named-exports-prohibited';

    public function __construct()
    {
        parent::__construct('setting named exports is prohibited');
    }
});
