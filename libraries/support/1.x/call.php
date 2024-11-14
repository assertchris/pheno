<?php

return function (callable $handler, array $parameters = []): mixed {
    $reflector = new ReflectionFunction($handler);
    $required = array_map(fn ($next) => $next->getName(), $reflector->getParameters());

    $provided = [];

    foreach ($required as $name) {
        if (isset($parameters[$name])) {
            $provided[$name] = $parameters[$name];
            continue;
        }

        throw import('exceptions/missing-required-parameter')();
    }

    return call_user_func($handler, ...$provided);
};
