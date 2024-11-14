<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $string = import('b/validation/1.x/rules/string');

    // 1. valid cases
    $assert($string($context(field: 'string', value: 'hello world')) == null);

    // 2. invalid cases
    $assert($string($context(field: 'string', value: null)) == 'validation.string');
    $assert($string($context(field: 'string', value: 123)) == 'validation.string');
    $assert($string($context(field: 'string', value: 456.789)) == 'validation.string');
    $assert($string($context(field: 'string', value: false)) == 'validation.string');
    $assert($string($context(field: 'string', value: [])) == 'validation.string');
    $assert($string($context(field: 'string', value: new StdClass())) == 'validation.string');
});
