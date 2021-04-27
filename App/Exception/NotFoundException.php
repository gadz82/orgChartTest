<?php

namespace App\Exception;

class NotFoundException extends \Exception implements RestApiExceptionCastable
{

    public function getResponseCode(): int
    {
        return 404;
    }

}
