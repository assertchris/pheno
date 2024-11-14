<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $ipv4 = import('b/validation/1.x/rules/ipv4');

    // 1. valid cases: valid IPv4 addresses
    $assert($ipv4($context(field: 'ipv4', value: '192.168.1.1')) == null);
    $assert($ipv4($context(field: 'ipv4', value: '255.255.255.255')) == null);
    $assert($ipv4($context(field: 'ipv4', value: '0.0.0.0')) == null);

    // 2. invalid cases: non-IPv4 addresses
    $assert($ipv4($context(field: 'ipv4', value: '256.256.256.256')) == 'validation.ipv4');
    $assert($ipv4($context(field: 'ipv4', value: '192.168.1.256')) == 'validation.ipv4');
    $assert($ipv4($context(field: 'ipv4', value: '192.168.1')) == 'validation.ipv4');
    $assert($ipv4($context(field: 'ipv4', value: 'abc.def.ghi.jkl')) == 'validation.ipv4');
    $assert($ipv4($context(field: 'ipv4', value: '::1')) == 'validation.ipv4');

    // 3. edge case: empty value
    $assert($ipv4($context(field: 'ipv4', value: '')) == 'validation.ipv4');
});
