<?php

namespace App\Controller;

use App\Library\JsonResponse;
use App\Library\Request;
use App\Library\RequestInterface;
use App\Library\ResponseInterface;

abstract class Controller
{

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface|JsonResponse
     */
    protected $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new JsonResponse();
    }

    public function handle(): void
    {
        $this->response->sendResponse();
    }

}
