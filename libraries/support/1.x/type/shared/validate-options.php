<?php

return export(default: fn (object $that, $value) => (function () use ($value) {
    if (! is_null($this->options) && count($this->options) > 0 && ! in_array($value, $this->options)) {
        throw import('../exceptions/invalid-option')($value, $this->options);
    }
})->call($that));
