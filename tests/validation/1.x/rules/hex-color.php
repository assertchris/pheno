<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $hexColor = import('b/validation/1.x/rules/hex-color');

    // 1. valid cases: correct hex color codes
    $assert($hexColor($context(field: 'hex-color', value: '#FFF')) == null);
    $assert($hexColor($context(field: 'hex-color', value: '#ffffff')) == null);
    $assert($hexColor($context(field: 'hex-color', value: '#123456')) == null);
    $assert($hexColor($context(field: 'hex-color', value: '#ABC')) == null);

    // 2. invalid cases: incorrect hex color codes
    $assert($hexColor($context(field: 'hex-color', value: '#GGG')) == 'validation.hex-color');
    $assert($hexColor($context(field: 'hex-color', value: '#12345G')) == 'validation.hex-color');
    $assert($hexColor($context(field: 'hex-color', value: 'FFF')) == 'validation.hex-color');
    $assert($hexColor($context(field: 'hex-color', value: '#1234567')) == 'validation.hex-color');
    $assert($hexColor($context(field: 'hex-color', value: 'not-a-color')) == 'validation.hex-color');
});
