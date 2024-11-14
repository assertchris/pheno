<?php

return export(default: fn (...$params) => new class (...$params) extends InvalidArgumentException {
    public const string name = 'support/type/invalid-option';

    /**
     * @param array<mixed, mixed> $options
     */
    public function __construct(mixed $value, array $options)
    {
        $joined = implode("', '", $options);

        parent::__construct("'{$value}' is not in the list ['{$joined}']");
    }
});
