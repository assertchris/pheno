<?php

$type = import('../../support/1.x/type');

return export(
    default: fn (...$params) => new class (...$params) {
        private array $extend = [];

        public function __construct(
            private string $path,
            private array $data = [],
        ) {
        }

        public function path(?string $value = null): null|string|self
        {
            if (is_null($value)) {
                return $this->path;
            }

            $this->path = $value;
            return $this;
        }

        public function data(?array $value = null): null|array|self
        {
            if (is_null($value)) {
                return $this->data;
            }

            $this->data = [...$this->data, ...$value];
            return $this;
        }

        public function get(string $key, mixed $default = null): mixed
        {
            if (isset($this->data[$key])) {
                return $this->data[$key];
            }

            return $default;
        }

        public function has(string $key): bool
        {
            return isset($this->data[$key]);
        }

        public function include(string $path): string
        {
            return import('renderer')()->render(new self($path));
        }

        public function extend(?string $path = null, array $parameters = []): array|self
        {
            if (is_null($path)) {
                return $this->extend;
            }

            $this->extend = [$path, $parameters];
            return $this;
        }
    },
    named: [
        'type' => fn () => $type->map([
            'path' => $type->function()->returns('string'),
            'data' => $type->function()->returns('array'),
            'include' => $type->function()->returns('string'),
            'extend' => $type->function(),
        ]),
    ],
);
