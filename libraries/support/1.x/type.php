<?php

$named = [];

$types = [
    'array',
    'boolean',
    'function',
    'list',
    'map',
    'mixed',
    'number',
    'object',
    'string',
];

foreach ($types as $type) {
    $named[$type] = import("type/{$type}");
}

return export(named: $named);
