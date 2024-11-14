<?php

return export(default: fn ($value) => match (true) {
    is_string($value) => mb_strlen($value),
    is_array($value) => count($value),
    is_numeric($value) => $value,
    default => null,
});
