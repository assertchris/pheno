<?php

return export(default: fn (object $that, ?string $value): null|string|object => (function () use ($value) {
    if (is_null($value)) {
        return $this->returns;
    }

    $this->returns = $value;

    return $this;
})->call($that));
