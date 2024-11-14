<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $prohibits = import('b/validation/1.x/rules/prohibits');
    $countable = import('shared/countable');

    // 1. Valid cases (primary field is empty or another field is also empty)
    $assert($prohibits($context(field: 'prohibits', value: null), compare: 'other') == null);
    $assert($prohibits($context(field: 'prohibits', value: ''), compare: 'other') == null);
    $assert($prohibits($context(field: 'prohibits', value: []), compare: 'other') == null);
    $assert($prohibits($context(field: 'prohibits', value: $countable()), compare: 'other') == null);
    $assert($prohibits($context(field: 'prohibits', value: 'value'), compare: 'other') == null);
    $assert($prohibits($context(field: 'prohibits', value: 'value'), compare: 'other') == null);

    // 2. Invalid cases (primary field is non-empty and another field is non-empty)
    $assert($prohibits($context(field: 'prohibits', value: 'value', values: ['other' => 'value']), compare: 'other') == 'validation.prohibits');
});
