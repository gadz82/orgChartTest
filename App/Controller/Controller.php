<?php
namespace App\Controller;

use App\Library\Request;
use App\Library\RequestInterface;
use App\Library\JsonResponse;
use App\Library\ResponseInterface;

abstract class Controller{

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    protected ResponseInterface $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new JsonResponse();
    }

    public function handle() : JsonResponse
    {
        return $this->response;
    }

}
