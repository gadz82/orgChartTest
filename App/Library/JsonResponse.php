<?php

namespace App\Library;

/**
 * Class Request - Basic Request Wrapper for JSON responses
 * @package App\Library
 */
class JsonResponse implements ResponseInterface
{

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var mixed
     */
    private $content;

    /**
     * Response constructor.
     * @param null $content
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct($content = null, int $statusCode = 200, array $headers = [])
    {
        $this->setContent($content);
        $this->setStatusCode($statusCode);
        $this->setHeaders($headers);
    }

    /**
     * @param $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers = []): void
    {
        $this->headers = $headers;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * @param callable|string $transformation
     * @return bool
     */
    public function sendResponse(callable $transformation = null): bool
    {
        $content = is_null($transformation) ? json_encode($this->content, JSON_PRETTY_PRINT) : call_user_func($transformation, $this->content);

        header('Status: ' . $this->statusCode);
        header('Content-Type: application/json; charset=utf8');
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }

        echo $content;
        return true;
    }
}
