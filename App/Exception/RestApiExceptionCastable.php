<?php

namespace App\Exception;

interface RestApiExceptionCastable
{

    public function getResponseCode(): int;

}
