<?php

$type = import('../../support/1.x/type');

return export(
    default: fn (...$params) => new readonly class (...$params) {
        /**
         * @param array<string, array<object>> $rules
         * @param array<string, mixed> $values
         */
        public function __construct(
            public string $field,
            public mixed $value = null,
            public array $rules = [],
            public array $values = [],
        ) {
        }
    },
    named: [
        'type' => fn () => $type->map([
            'field' => $type->string(),
            'value' => $type->mixed()
                ->required(false),
            'rules' => $type->list(
                key: $type->string(),
                value: $type->list(
                    key: $type->number(),
                    value: $type->object(),
                ),
            ),
            'values' => $type->list(
                key: $type->string(),
                value: $type->mixed()->required(false),
            ),
        ]),
    ],
);
