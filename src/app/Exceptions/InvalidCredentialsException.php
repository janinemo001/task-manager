<?php

namespace App\Exceptions;

class InvalidCredentialsException extends ApiException
{
    protected int $statusCode = 400;

    public function __construct()
    {
        parent::__construct('Invalid credentials provided.');
    }
}
