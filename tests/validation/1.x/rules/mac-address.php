<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $macAddress = import('b/validation/1.x/rules/mac-address');

    // 1. all valid MAC addresses
    $assert($macAddress($context(field: 'mac-address', value: '00:1A:2B:3C:4D:5E')) == null);
    $assert($macAddress($context(field: 'mac-address', value: '00-1A-2B-3C-4D-5E')) == null);
    $assert($macAddress($context(field: 'mac-address', value: '00:1A:2B:3C:4D:5E')) == null);
    $assert($macAddress($context(field: 'mac-address', value: 'A1:B2:C3:D4:E5:F6')) == null);
    $assert($macAddress($context(field: 'mac-address', value: 'A1-B2-C3-D4-E5-F6')) == null);

    // 2. invalid MAC addresses
    $assert($macAddress($context(field: 'mac-address', value: '00:1A:2B:3C:4D:5Z')) == 'validation.mac-address');
    $assert($macAddress($context(field: 'mac-address', value: '00-1A-2B-3C-4D')) == 'validation.mac-address');
    $assert($macAddress($context(field: 'mac-address', value: '00:1A:2B:3C:4D:5E:6F')) == 'validation.mac-address');
    $assert($macAddress($context(field: 'mac-address', value: 'NotAValidMAC')) == 'validation.mac-address');
});
