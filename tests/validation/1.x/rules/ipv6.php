<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $ipv6 = import('b/validation/1.x/rules/ipv6');

    // 1. valid cases: valid IPv6 addresses
    $assert($ipv6($context(field: 'ipv6', value: '::1')) == null);
    $assert($ipv6($context(field: 'ipv6', value: '2001:0db8:85a3:0000:0000:8a2e:0370:7334')) == null);
    $assert($ipv6($context(field: 'ipv6', value: '::')) == null);
    $assert($ipv6($context(field: 'ipv6', value: '2001:db8::ff00:42:8329')) == null);

    // 2. invalid cases: non-IPv6 addresses
    $assert($ipv6($context(field: 'ipv6', value: '192.168.1.1')) == 'validation.ipv6');
    $assert($ipv6($context(field: 'ipv6', value: '256.256.256.256')) == 'validation.ipv6');
    $assert($ipv6($context(field: 'ipv6', value: 'abc:def:ghi:jkl')) == 'validation.ipv6');
    $assert($ipv6($context(field: 'ipv6', value: '::g')) == 'validation.ipv6');

    // 3. edge case: empty value
    $assert($ipv6($context(field: 'ipv6', value: '')) == 'validation.ipv6');
});
