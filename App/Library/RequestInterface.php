<?php

namespace App\Library;

interface RequestInterface
{

    /**
     * @param string $requestType
     * @return bool
     */
    public function is(string $requestMethod): bool;

    public function hasParam(string $paramName): bool;

    public function getParam(string $paramName): ?string;

    public function hasParams(array $paramName): bool;

}
