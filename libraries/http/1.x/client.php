<?php

$type = import('../../support/1.x/type');

return export(
    default: fn (...$params) => new class (...$params) {
        private string $base = '';

        public function __construct(
            string $base = '',
            private array $headers = [],
            private string $agent = 'Pheno HTTP Client',
        ) {
            $this->base($base);
        }

        public function base(?string $value = null): string|self
        {
            if (is_null($value)) {
                return $this->base;
            }

            $this->base = rtrim($value, '/');
            return $this;
        }

        public function headers(?array $value = null): array|self
        {
            if (is_null($value)) {
                return $this->headers;
            }

            $this->headers = $value;
            return $this;
        }

        public function agent(?string $value = null): string|self
        {
            if (is_null($value)) {
                return $this->agent;
            }

            $this->agent = $value;
            return $this;
        }

        private function request(string $method, string $url, bool $json = false, array|object $data = [], array|object $headers = []): object
        {
            $curl = curl_init();

            $fullUrl = $this->base . '/' . ltrim($url, '/');

            curl_setopt($curl, CURLOPT_URL, $fullUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, $this->agent);

            if (!empty($this->headers)) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, array_filter([
                    ...$this->headers,
                    ...$headers,
                    $json ? 'Content-Type: application/json' : null,
                ]));
            }

            if (in_array($method, ['POST', 'PUT', 'PATCH']) && count($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }

            $response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $error = curl_error($curl);

            curl_close($curl);

            if ($error) {
                throw import('exceptions/request-failure')();
            }

            $rawHeaders = substr($response, 0, $headerSize);
            $rawBody = substr($response, $headerSize);

            $headers = [];

            foreach (explode("\r\n", $rawHeaders) as $line) {
                if (str_contains($line, ': ')) {
                    list($key, $value) = explode(': ', $line, 2);
                    $headers[$key] = $value;
                }
            }

            $body = json_decode($rawBody, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $body = $rawBody;
            }

            return import('response')(
                body: $body,
                status: $status,
                headers: $headers,
            );
        }

        public function get(string $url, array|object $headers = [], bool $json = false): object
        {
            return $this->request(method: 'GET', url: $url, json: $json, headers: $headers);
        }

        public function post(string $url, array|object $data = [], array|object $headers = [], bool $json = false): object
        {
            return $this->request(method: 'POST', url: $url, json: $json, data: $data, headers: $headers);
        }

        public function put(string $url, array|object $data = [], array|object $headers = [], bool $json = false): object
        {
            return $this->request(method: 'PUT', url: $url, json: $json, data: $data, headers: $headers);
        }

        public function patch(string $url, array|object $data = [], array|object $headers = [], bool $json = false): object
        {
            return $this->request(method: 'PATCH', url: $url, json: $json, data: $data, headers: $headers);
        }

        public function delete(string $url, array|object $headers = [], bool $json = false): object
        {
            return $this->request(method: 'DELETE', url: $url, json: $json, headers: $headers);
        }
    },
    named: [
        'type' => fn () => $type->map([
            'request' => $type->function()->returns('object'),
            'get' => $type->function()->returns('object'),
            'post' => $type->function()->returns('object'),
            'put' => $type->function()->returns('object'),
            'patch' => $type->function()->returns('object'),
            'delete' => $type->function()->returns('object'),
        ]),
    ],
);
