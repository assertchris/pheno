<?php

$type = import('../../support/1.x/type');

return export(
    default: fn (...$params) => new class (...$params) {
        public function __construct(
            private string|array $body = '',
            private int $status = 200,
            private array $headers = [],
        ) {
        }

        public function status(?string $value = null): int|self
        {
            if (is_null($value)) {
                return $this->status;
            }

            $this->status = $value;
            return $this;
        }

        public function body(?string $value = null): string|array|self
        {
            if (is_null($value)) {
                return $this->body;
            }

            $this->body = $value;
            return $this;
        }

        public function headers(?array $value = null): array|self
        {
            if (is_null($value)) {
                return $this->headers;
            }

            $this->headers = [...$this->headers, ...$value];
            return $this;
        }

        public function setHeader(string $name, mixed $value): self
        {
            $this->headers[$name] = $value;
            return $this;
        }

        public function removeHeader(string $name): self
        {
            unset($this->headers[$name]);
            return $this;
        }

        public function respond(): void
        {
            http_response_code($this->status);

            foreach ($this->headers as $k => $v) {
                header("{$k}: {$v}");
            }

            print $this->body;
        }
    },
    named: [
        'type' => fn () => $type->map([
            'respond' => $type->function(),
        ]),
    ],
);
