<?php

namespace App\Library;

interface ResponseInterface
{

    public function __construct(
        $content = null,
        int $statusCode = 200,
        array $headers = []
    );

    public function setStatusCode(int $statusCode): void;

    public function setContent($content): void;

    public function setHeader(string $key, string $value): void;

    public function setHeaders(array $headers): void;

    public function sendResponse(callable $transformation = null): bool;

}
