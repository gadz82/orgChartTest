<?php
namespace App\Controller;

use App\Library\RequestInterface;
use App\Library\Response;
use App\Library\ResponseInterface;

abstract class Controller{

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    protected ResponseInterface $response;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
        $this->response = new Response();
    }

    public function handle() : Response
    {
        return $this->response;
    }

}
