<?php

return export(default: fn (object $that, ?array $value): null|array|object => (function () use ($value) {
    if (is_null($value)) {
        return $this->options;
    }

    $this->options = $value;

    return $this;
})->call($that));
