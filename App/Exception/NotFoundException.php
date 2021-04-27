<?php

namespace App\Exception;

/**
 * Class NotFoundException
 * @package App\Exception
 */
class NotFoundException extends \Exception implements RestApiExceptionCastable
{

    public function getResponseCode() : int
    {
        return 404;
    }

}
