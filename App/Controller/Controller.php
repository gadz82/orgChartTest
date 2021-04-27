<?php

namespace App\Controller;

use App\Library\JsonResponse;
use App\Library\Request;
use App\Library\RequestInterface;
use App\Library\ResponseInterface;

/**
 * Class Controller
 * @package App\Controller
 * A basic abstract class to handle our app
 */
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

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new JsonResponse();
    }

    /**
     * Handle final Output
     */
    final public function handle(): void
    {
        $this->response->sendResponse();
    }

}
