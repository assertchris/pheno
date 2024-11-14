<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $ip = import('b/validation/1.x/rules/ip');

    // 1. valid cases: valid IP addresses
    $assert($ip($context(field: 'ip', value: '192.168.1.1')) == null);
    $assert($ip($context(field: 'ip', value: '::1')) == null);
    $assert($ip($context(field: 'ip', value: '2001:0db8:85a3:0000:0000:8a2e:0370:7334')) == null);

    // 2. invalid cases: invalid IP addresses
    $assert($ip($context(field: 'ip', value: '256.256.256.256')) == 'validation.ip');
    $assert($ip($context(field: 'ip', value: 'abc:def:ghi:jkl')) == 'validation.ip');
    $assert($ip($context(field: 'ip', value: '::g')) == 'validation.ip');

    // 3. edge case: empty value
    $assert($ip($context(field: 'ip', value: '')) == 'validation.ip');
});
