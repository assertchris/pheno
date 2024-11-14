<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $timezone = import('b/validation/1.x/rules/timezone');

    $assert($timezone($context(field: 'timezone', value: 'UTC')) == null);
    $assert($timezone($context(field: 'timezone', value: 'America/New_York')) == null);
    $assert($timezone($context(field: 'timezone', value: 'Europe/London')) == null);
    $assert($timezone($context(field: 'timezone', value: 'Asia/Tokyo')) == null);

    $assert($timezone($context(field: 'timezone', value: 'Invalid/Timezone')) == 'validation.timezone');
    $assert($timezone($context(field: 'timezone', value: 'GMT+2')) == 'validation.timezone');
    $assert($timezone($context(field: 'timezone', value: 'EST')) == 'validation.timezone');
    $assert($timezone($context(field: 'timezone', value: 'Etc/GMT+2')) == 'validation.timezone');

    $assert($timezone($context(field: 'timezone', value: '')) == 'validation.timezone');
    $assert($timezone($context(field: 'timezone', value: null)) == 'validation.timezone');
    $assert($timezone($context(field: 'timezone', value: 123)) == 'validation.timezone');
});
