<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected int $statusCode = 400;

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}
