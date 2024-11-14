<?php

return export(default: function (Closure $assert) {
    $context = import('b/validation/1.x/context');
    $endsWithout = import('b/validation/1.x/rules/ends-without');

    // 1. valid cases: values that do not end with the specified endings
    $assert($endsWithout($context(field: 'filename', value: 'file.txt'), endings: ['.pdf', '.docx']) == null);
    $assert($endsWithout($context(field: 'filename', value: 'archive.tar'), endings: ['.zip', '.rar']) == null);
    $assert($endsWithout($context(field: 'filename', value: 'report'), endings: ['.pdf', '.docx']) == null);
    $assert($endsWithout($context(field: 'filename', value: 'data.csv'), endings: ['.json', '.xml']) == null);

    // 2. invalid cases: values that end with the specified endings
    $assert($endsWithout($context(field: 'filename', value: 'document.pdf'), endings: ['.pdf', '.docx']) == 'validation.ends-without');
    $assert($endsWithout($context(field: 'filename', value: 'notes.docx'), endings: ['.pdf', '.docx']) == 'validation.ends-without');
    $assert($endsWithout($context(field: 'filename', value: 'image.jpeg'), endings: ['.jpeg']) == 'validation.ends-without');

    // 3. edge case: empty value
    $assert($endsWithout($context(field: 'filename', value: ''), endings: ['.pdf']) == null);

    // 4. edge case: no endings provided
    $assert($endsWithout($context(field: 'filename', value: 'file.txt'), endings: []) == null);
});
