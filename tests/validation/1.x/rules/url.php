<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $url = import('b/validation/1.x/rules/url');

    // 1. Valid cases: correct URLs
    $assert($url($context(field: 'url', value: 'http://example.com')) == null);
    $assert($url($context(field: 'url', value: 'https://www.example.com')) == null);
    $assert($url($context(field: 'url', value: 'ftp://ftp.example.com')) == null);
    $assert($url($context(field: 'url', value: 'http://example.com/path/to/page?param1=value1&param2=value2')) == null);
    $assert($url($context(field: 'url', value: 'http://localhost')) == null);
    $assert($url($context(field: 'url', value: 'http://127.0.0.1')) == null);
    $assert($url($context(field: 'url', value: 'http://example')) == null);

    // 2. Invalid cases: incorrect URLs
    $assert($url($context(field: 'url', value: 'not a url')) == 'validation.url');
    $assert($url($context(field: 'url', value: 'http://')) == 'validation.url');
    $assert($url($context(field: 'url', value: 'http://.com')) == 'validation.url');
    $assert($url($context(field: 'url', value: 'example.com')) == 'validation.url');

    // 3. Edge cases
    $assert($url($context(field: 'url', value: '')) == 'validation.url');
    $assert($url($context(field: 'url', value: null)) == 'validation.url');
    $assert($url($context(field: 'url', value: 123)) == 'validation.url');
});
