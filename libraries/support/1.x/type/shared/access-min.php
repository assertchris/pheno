<?php

return export(default: fn (object $that, null|float|int $value): null|float|int|object => (function () use ($value) {
    if (is_null($value)) {
        return $this->min;
    }

    $this->min = $value;

    return $this;
})->call($that));
