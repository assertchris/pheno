<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $endsWith = import('b/validation/1.x/rules/ends-with');

    // 1. valid cases: values that end with the specified endings
    $assert($endsWith($context(field: 'ends-with', value: 'document.pdf'), endings: ['.pdf', '.docx']) == null);
    $assert($endsWith($context(field: 'ends-with', value: 'archive.zip'), endings: ['.zip', '.rar']) == null);
    $assert($endsWith($context(field: 'ends-with', value: 'image.jpeg'), endings: ['.jpeg', '.png']) == null);
    $assert($endsWith($context(field: 'ends-with', value: 'report.docx'), endings: ['.pdf', '.docx']) == null);

    // 2. invalid cases: values that do not end with the specified endings
    $assert($endsWith($context(field: 'ends-with', value: 'file.txt'), endings: ['.pdf', '.docx']) == 'validation.ends-with');
    $assert($endsWith($context(field: 'ends-with', value: 'notes'), endings: ['.pdf', '.docx']) == 'validation.ends-with');
    $assert($endsWith($context(field: 'ends-with', value: 'data.csv'), endings: ['.json', '.xml']) == 'validation.ends-with');

    // 3. edge case: empty value
    $assert($endsWith($context(field: 'ends-with', value: ''), endings: ['.pdf']) == 'validation.ends-with');

    // 4. edge case: no endings provided
    $assert($endsWith($context(field: 'ends-with', value: 'file.txt'), endings: []) == 'validation.ends-with');
});
