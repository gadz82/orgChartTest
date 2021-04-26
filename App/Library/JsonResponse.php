<?php
namespace App\Library;

/**
 * Class Request - Basic Request Wrapper
 * @package App\Library
 */
class JsonResponse implements ResponseInterface {

    /**
     * @var int
     */
    private integer $statusCode;

    /**
     * @var array
     */
    private array $headers;

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
     * @param integer $statusCode
     */
    public function setStatusCode(integer $statusCode): void
    {
        $this->statusCode = $statusCode;
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
     * @param array $headers
     */
    public function setHeaders(array $headers = []): void
    {
        $this->headers = $headers;
    }

    /**
     * @param callable|string $transformation
     * @return bool
     */
    public function sendResponse(callable $transformation = null): bool
    {
        $content = is_null($transformation) ? json_encode($this->content) : call_user_func($transformation, $this->content);

        foreach($this->headers as $key => $value) {
            header($key .': ' . $value);
        }
        http_response_code($this->statusCode);

        echo $this->content;
        return true;
    }

    /**
     * @param $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }
}
