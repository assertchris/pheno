<?php

$GLOBALS['__import'] = require '1.x/import.php';
$GLOBALS['__export'] = require '1.x/export.php';
$GLOBALS['__path'] = require '1.x/path.php';

if (! function_exists('export')) {
    /**
     * @param array<string, object>|null $named
     */
    function export(?Closure $default = null, ?array $named = null): mixed
    {
        return $GLOBALS['__export'](default: $default, named: $named);
    }
}

if (! function_exists('import')) {
    function import(string $path): mixed
    {
        return $GLOBALS['__import'](path: $path);
    }
}

if (! function_exists('path')) {
    function path(?string $evaluate = null, ?string $from = null, ?string $to = null): mixed
    {
        return $GLOBALS['__path'](evaluate: $evaluate, from: $from, to: $to);
    }
}
