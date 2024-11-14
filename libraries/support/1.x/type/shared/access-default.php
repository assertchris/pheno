<?php

return export(default: fn (object $that, $value) => (function () use ($value) {
    if (is_null($value)) {
        return $this->default;
    }

    $this->default = $value;

    return $this;
})->call($that));
