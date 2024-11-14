<?php

return export(default: fn (object $that, ?bool $value): null|bool|object => (function () use ($value) {
    if (is_null($value)) {
        return $this->required;
    }

    $this->required = $value;

    return $this;
})->call($that));
