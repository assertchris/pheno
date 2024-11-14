<?php

return function (?string $evaluate = null, ?string $from = null, ?string $to = null) {
    static $aliases = [];

    if (! is_null($from) && ! is_null($to)) {
        $aliases[$from] = $to;
    }

    if (! is_null($evaluate)) {
        foreach ($aliases as $from => $to) {
            if (str_starts_with($evaluate, "{$from}/")) {
                $evaluate = str_replace("{$from}/", "{$to}/", $evaluate);
            }
        }

        return $evaluate;
    }

    return null;
};
