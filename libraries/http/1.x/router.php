<?php

$type = import('../../support/1.x/type');

return export(
    default: fn () => new class () {
        /**
         * @var object[]
         */
        private array $routes = [];

        /**
         * @var array<int, Closure>
         */
        private array $errors = [];

        private ?object $current = null;

        public function add(string $method, string $path, callable $handler): object
        {
            $route = import('route')($method, $path, $handler);
            $this->routes[] = $route;

            return $route;
        }

        public function dispatch(object $request): mixed
        {
            assert(import('request')->type()->assert($request));

            $matching = $this->match($request);

            if ($matching) {
                $this->current = $matching;

                [$error, $result] = import('../../support/1.x/attempt')($matching->dispatch(...));

                if ($error) {
                    return $this->dispatchError();
                }

                return $result;
            }

            if (in_array($request->path(), $this->paths())) {
                return $this->dispatchNotAllowed();
            }

            return $this->dispatchNotFound();
        }

        /**
         * @return string[]
         */
        private function paths(): array
        {
            return array_map(fn ($route) => $route->path(), $this->routes);
        }

        private function match(object $request): ?object
        {
            assert(import('request')->type()->assert($request));

            foreach ($this->routes as $route) {
                if ($route->matches($request->method(), $request->path())) {
                    return $route;
                }
            }

            return null;
        }

        public function errorHandler(int $code, callable $handler): object
        {
            $this->errors[$code] = $handler;

            return $this;
        }

        private function dispatchError(): Closure
        {
            $this->errors[500] ??= fn () => 'server error';

            return $this->errors[500];
        }

        private function dispatchNotAllowed(): Closure
        {
            $this->errors[400] ??= fn () => 'not allowed';

            return $this->errors[400];
        }

        private function dispatchNotFound(): Closure
        {
            $this->errors[404] ??= fn () => 'not found';

            return $this->errors[404];
        }

        public function current(): ?object
        {
            return $this->current;
        }

        /**
         * @param array<string, mixed> $parameters
         */
        public function route(
            string $name,
            array $parameters = [],
        ): string {
            foreach ($this->routes as $route) {
                if ($route->name() === $name) {
                    $finds = [];
                    $replaces = [];

                    foreach ($parameters as $key => $value) {
                        $finds[] = "{{$key}}";
                        $replaces[] = $value;

                        $finds[] = "{{$key}?}";
                        $replaces[] = $value;
                    }

                    $path = $route->path();
                    $path = str_replace($finds, $replaces, $path);

                    return preg_replace('#{[^}]+}#', '', $path);
                }
            }

            throw import('exceptions/missing-named-route')($name);
        }
    },
    named: [
        'type' => fn () => $type->map([
            'add' => $type->function(),
        ]),
    ],
);
