<?php

namespace App\Library;

/**
 * Class Request - Basic Request Wrapper
 * @package App\Library
 */
class Request implements RequestInterface
{

    /**
     * @var string
     */
    private $requestMethod;

    /**
     * @var array
     */
    private $params;

    /**
     * @var false|string
     */
    private $payload;

    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->params = $_REQUEST;
        $this->payload = file_get_contents('php://input');
    }

    /**
     * @param string $var
     * @return mixed|null
     */
    public function __get(string $var): ?string
    {
        return $this->getParam($var);
    }

    /**
     * @param string $paramName
     * @return string|null
     */
    public function getParam(string $paramName): ?string
    {
        return $this->hasParam($paramName) ? $this->params[$paramName] : null;
    }

    /**
     * @param string $paramName
     * @return bool
     */
    public function hasParam(string $paramName): bool
    {
        return isset($this->params[$paramName]) && !empty($this->params[$paramName]);
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     * @return null|array
     */
    public function getParams(): ?array
    {
        return $this->params;
    }

    /**
     * Get request payload
     * @return null|string
     */
    public function getPayload(): ?string
    {
        return $this->payload;
    }

    /**
     * Check if a request is a specific request method
     * @param string $requestMethod
     * @return bool
     */
    public function is(string $requestMethod): bool
    {
        return $this->requestMethod == strtoupper($requestMethod);
    }

    /**
     * Check an array of params
     * @param array $params
     * @return bool
     */
    public function hasParams(array $params): bool
    {
        return !!array_diff($params, array_keys($this->params));
    }
}
