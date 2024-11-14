<?php

return export(default: function (Closure $assert) {
    $type = import('b/support/1.x/type');

    $arrayTypeWithFunction = $type->map([
        'greet' => $type->function(),
    ]);

    $arrayWithFunction = [
        'greet' => fn (): string => 'hello world',
    ];

    $assert($arrayTypeWithFunction->assert($arrayWithFunction));

    $objectTypeWithFunction = $type->map([
        'greet' => $type->function(),
    ]);

    $classWithFunction = new class () {
        public function greet(): string
        {
            return 'hello world';
        }
    };

    $assert($objectTypeWithFunction->assert((object) $arrayWithFunction));
    $assert($objectTypeWithFunction->assert($classWithFunction));
});
