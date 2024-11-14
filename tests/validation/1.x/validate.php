<?php

return export(default: function (Closure $assert) {
    $attempt = import('b/support/1.x/attempt');
    $validate = import('b/validation/1.x/validate');

    $result = $validate([
        'name' => [$validate->required],
        'age' => [$validate->numeric],
    ], [
        'name' => 'Christopher Pitt',
        'age' => 36,
    ]);

    $assert($result['name'], 'Christopher Pitt');
    $assert($result['age'], 36);

    [$exception] = $attempt(fn () => $validate(['name' => [$validate->required]], []));

    $assert($exception->errors['name'][0] === 'validation.required');
});
