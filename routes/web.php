<?php

return export(default: function (object $router) {
    assert(import('b/http/1.x/router')->type()->assert($router));

    $view = import('b/view/1.x/view');

    $router
        ->add('GET', '/', fn () => $view('home', ['name' => 'chris']))
        ->name('home');

    $router
        ->add('GET', '/libraries/{segment:(.*)}', function (string $segment) {
            $path = __DIR__ . '/../libraries/' . $segment;

            if (file_exists($path)) {
                return import('b/http/1.x/response')(
                    body: file_get_contents($path),
                    headers: [
                        'content-type' => 'text/plain',
                    ],
                );
            }

            import('b/http/1.x/abort')(404);
        })
        ->name('library');

    $router
        ->add('GET', '/projects', function() {
            $token = '...';

            $client = import('b/http/1.x/client')(
                base: 'https://api.github.com',
                headers: [
                    'Accept' => 'application/vnd.github+json',
                    'Authorization' => "Bearer {$token}",
                    'X-GitHub-Api-Version' => '2022-11-28',
                ],
                agent: 'Pheno-Marketing',
            );

            $projects = $client->get("repos/assertchris/pheno/projects");

            print_r($projects->body());
            exit;
        });
});
