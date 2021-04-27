<?php

namespace App\Exception;

/**
 * Interface RestApiExceptionCastable
 * Casts response status code, usefull to handle error messages in a REST context
 * @package App\Exception
 */
interface RestApiExceptionCastable
{

    public function getResponseCode(): int;

}
