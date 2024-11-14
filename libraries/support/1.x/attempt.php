<?php

return export(default: function (Closure $closure): array {
    try {
        return [null, $closure()];
    } catch (Throwable $e) {
        return [$e, null];
    }
});
