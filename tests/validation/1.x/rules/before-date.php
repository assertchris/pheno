<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $beforeDate = import('b/validation/1.x/rules/before-date');

    // 1. valid cases: date is before the comparison date
    $assert($beforeDate($context(field: 'before-date', value: '2023-01-01'), compare: '2023-12-31') == null);
    $assert($beforeDate($context(field: 'before-date', value: '2023-05-15'), compare: '2023-06-01') == null);

    // 2. valid case with context values array
    $assert($beforeDate($context(field: 'before-date', value: '2023-01-01', values: ['after-date' => '2023-12-31']), compare: 'after-date') == null);

    // 3. invalid cases: date is the same or after the comparison date
    $assert($beforeDate($context(field: 'before-date', value: '2023-12-31'), compare: '2023-12-31') == 'validation.before-date');
    $assert($beforeDate($context(field: 'before-date', value: '2024-01-01'), compare: '2023-12-31') == 'validation.before-date');

    // 4. invalid cases with context values array
    $assert($beforeDate($context(field: 'before-date', value: '2023-12-31', values: ['after-date' => '2023-12-31']), compare: 'after-date') == 'validation.before-date');
    $assert($beforeDate($context(field: 'before-date', value: '2024-01-01', values: ['after-date' => '2023-12-31']), compare: 'after-date') == 'validation.before-date');

    // 5. invalid cases: invalid date formats
    $assert($beforeDate($context(field: 'before-date', value: 'not a date'), compare: '2023-12-31') == 'validation.before-date');
    $assert($beforeDate($context(field: 'before-date', value: '2023-01-01'), compare: 'not a date') == 'validation.before-date');
});
