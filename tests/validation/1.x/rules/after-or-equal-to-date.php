<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $afterOrEqualToDate = import('b/validation/1.x/rules/after-or-equal-to-date');

    // 1. valid cases: date is after the comparison date
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2024-01-01'), compare: '2023-12-31') == null);
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2023-06-02'), compare: '2023-06-01') == null);

    // 2. valid case: date is equal to the comparison date
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2023-12-31'), compare: '2023-12-31') == null);

    // 3. invalid cases: date is before the comparison date
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2023-12-30'), compare: '2023-12-31') == 'validation.after-or-equal-to-date');
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2023-01-01'), compare: '2023-12-31') == 'validation.after-or-equal-to-date');

    // 4. valid cases with context values array (date after and equal)
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2024-01-01', values: ['before-date' => '2023-12-31']), compare: 'before-date') == null);
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2023-12-31', values: ['before-date' => '2023-12-31']), compare: 'before-date') == null);

    // 5. invalid case with context values array (date before)
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2023-12-30', values: ['before-date' => '2023-12-31']), compare: 'before-date') == 'validation.after-or-equal-to-date');

    // 6. invalid cases: invalid date formats
    $assert($afterOrEqualToDate($context(field: 'after-date', value: 'not a date'), compare: '2023-12-31') == 'validation.after-or-equal-to-date');
    $assert($afterOrEqualToDate($context(field: 'after-date', value: '2024-01-01'), compare: 'not a date') == 'validation.after-or-equal-to-date');
});
