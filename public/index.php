<?php

require __DIR__ . '/../vendor/autoload.php';

path(from: 'b', to: __DIR__ . '/../libraries');

$router = import('b/http/1.x/router')();
$routes = import('../routes/web')($router);

$result = $router->dispatch(import('b/http/1.x/request')->capture());
$response = import('b/http/1.x/response');

if ($response->type()->is($result)) {
    $result->respond();
    exit;
}

if (is_object($result) || is_array($result)) {
    if (import('b/view/1.x/view')->type()->is($result)) {
        $result = import('b/view/1.x/renderer')()->render($result);
    } else {
        $result = json_encode($result);
    }
}

$response(body: $result)->respond();
exit;
