<?php

return export(default: fn () => new class () extends InvalidArgumentException {
    public const string name = 'http/url-parsing-error';

    public function __construct()
    {
        parent::__construct('error parsing URL');
    }
});
