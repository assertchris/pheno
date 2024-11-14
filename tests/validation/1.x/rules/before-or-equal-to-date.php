<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $beforeOrEqualToDate = import('b/validation/1.x/rules/before-or-equal-to-date');

    // 1. valid cases: date is before the comparison date
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2023-01-01'), compare: '2023-12-31') == null);
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2023-05-15'), compare: '2023-06-01') == null);

    // 2. valid case: date is equal to the comparison date
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2023-12-31'), compare: '2023-12-31') == null);

    // 3. invalid cases: date is after the comparison date
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2024-01-01'), compare: '2023-12-31') == 'validation.before-or-equal-to-date');

    // 4. valid cases with context values array (date before and equal)
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2023-01-01', values: ['after-date' => '2023-12-31']), compare: 'after-date') == null);
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2023-12-31', values: ['after-date' => '2023-12-31']), compare: 'after-date') == null);

    // 5. invalid case with context values array (date after)
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2024-01-01', values: ['after-date' => '2023-12-31']), compare: 'after-date') == 'validation.before-or-equal-to-date');

    // 6. invalid cases: invalid date formats
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: 'not a date'), compare: '2023-12-31') == 'validation.before-or-equal-to-date');
    $assert($beforeOrEqualToDate($context(field: 'before-date', value: '2023-01-01'), compare: 'not a date') == 'validation.before-or-equal-to-date');
});
