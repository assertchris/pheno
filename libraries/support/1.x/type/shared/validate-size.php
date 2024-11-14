<?php

return export(default: fn (object $that, $value, float|int $size) => (function () use ($value, $size) {
    if (! is_null($this->min) && $size < $this->min) {
        throw import('../exceptions/too-small')($value, $this->min);
    }

    if (! is_null($this->max) && $size > $this->max) {
        throw import('../exceptions/too-big')($value, $this->max);
    }
})->call($that));
