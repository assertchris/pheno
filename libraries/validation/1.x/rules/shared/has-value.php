<?php

return export(
    default: fn ($value) => $value !== ''
    && ! is_null($value)
    && (! is_array($value) || count($value) !== 0)
    && (! is_countable($value) || count($value) !== 0)
);
