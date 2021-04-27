<?php

namespace App\Exception;

class BadRequestException extends \Exception implements RestApiExceptionCastable
{

    public function getResponseCode(): int
    {
        return 400;
    }
}
