<?php

return export(default: fn (object $that, $value, ?string $key = null) => (function () use ($value, $key) {
    if (is_null($value)) {
        if (! $this->required) {
            return $this->default;
        }

        throw import('../exceptions/missing-value')($key ?? '');
    }
})->call($that));
