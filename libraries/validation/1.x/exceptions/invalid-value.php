<?php

return export(
    default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
        public const string name = 'support/validation/exceptions/invalid-value';

        /**
         * @param array<string, array<object>> $rules
         * @param array<string, mixed> $values
         * @param array<string, string[]> $errors
         */
        public function __construct(
            string $message,
            public array $rules,
            public array $values,
            public array $errors = [],
        ) {
            parent::__construct($message);
        }
    }
);
