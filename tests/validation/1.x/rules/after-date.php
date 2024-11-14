<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $afterDate = import('b/validation/1.x/rules/after-date');

    // 1. valid cases: date is after the comparison date
    $assert($afterDate($context(field: 'after-date', value: '2024-01-01'), compare: '2023-12-31') == null);
    $assert($afterDate($context(field: 'after-date', value: '2023-06-02'), compare: '2023-06-01') == null);

    // 2. valid case with context values array
    $assert($afterDate($context(field: 'after-date', value: '2024-01-01', values: ['before-date' => '2023-12-31']), compare: 'before-date') == null);

    // 3. invalid cases: date is the same or before the comparison date
    $assert($afterDate($context(field: 'after-date', value: '2023-12-31'), compare: '2023-12-31') == 'validation.after-date');
    $assert($afterDate($context(field: 'after-date', value: '2023-01-01'), compare: '2023-12-31') == 'validation.after-date');

    // 4. invalid cases with context values array
    $assert($afterDate($context(field: 'after-date', value: '2023-12-31', values: ['before-date' => '2023-12-31']), compare: 'before-date') == 'validation.after-date');
    $assert($afterDate($context(field: 'after-date', value: '2023-01-01', values: ['before-date' => '2023-12-31']), compare: 'before-date') == 'validation.after-date');

    // 5. invalid cases: invalid date formats
    $assert($afterDate($context(field: 'after-date', value: 'not a date'), compare: '2023-12-31') == 'validation.after-date');
    $assert($afterDate($context(field: 'after-date', value: '2024-01-01'), compare: 'not a date') == 'validation.after-date');
});
