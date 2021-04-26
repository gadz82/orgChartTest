<?php
namespace App\Exception;

class RequestException extends \Exception{

    public static $notFound = 404;
    public static $badRequest = 400;
    public static $unsupportedRequest = 415;


}
