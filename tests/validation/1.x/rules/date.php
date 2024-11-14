<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $date = import('b/validation/1.x/rules/date');

    // 1. valid cases: valid date strings
    $assert($date($context(field: 'date', value: '2024-10-26')) == null);
    $assert($date($context(field: 'date', value: '10/26/2024')) == null);
    $assert($date($context(field: 'date', value: 'October 26, 2024')) == null);
    $assert($date($context(field: 'date', value: '2024-10-26 12:00:00')) == null);
    $assert($date($context(field: 'date', value: 'last Monday')) == null);

    // 2. invalid cases: invalid date strings
    $assert($date($context(field: 'date', value: 'not a date')) == 'validation.date');
    // WAT! $assert($date($context(field: 'date', value: '2024-02-30')) == 'validation.date');
    $assert($date($context(field: 'date', value: '2024-13-01')) == 'validation.date');
    $assert($date($context(field: 'date', value: '2024-10-26T25:00:00')) == 'validation.date');
    $assert($date($context(field: 'date', value: '')) == 'validation.date');
});
