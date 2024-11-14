<?php

return export(default: fn () => new class () {
    private ?object $current = null;

    public function __get(string $name)
    {
        return $this->current?->$name;
    }

    public function __call(string $name, array $params)
    {
        return $this->current?->$name(...$params);
    }

    public function render(object $view): string
    {
        assert(import('view')->type()->assert($view));

        // TODO: better logic
        $path = __DIR__ . '/../../../resources/views/' . $view->path() . '.php';

        $nested = $this->wire($view, $path);

        $extend = $view->extend();

        if (count($extend) > 0) {
            return $this->render(import('view')($extend[0], [
                ...$extend[1],
                'slot' => $nested,
            ]));
        }

        return $nested;
    }

    private function wire(object $view, string $path): string
    {
        $this->current = $view;

        ob_start();

        extract($view->data(), flags: EXTR_SKIP);
        include $path;

        $this->current = null;

        return trim(ob_get_clean());
    }
});
