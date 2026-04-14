<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        // Unauthenticated
        if ($e instanceof AuthenticationException) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Validation
        if ($e instanceof ValidationException) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Model not found
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Custom handling for InvalidCredentialsException
        if ($e instanceof InvalidCredentialsException) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        // Generic error (e.g., invalid login)
        if ($e instanceof \Exception) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }


        return parent::render($request, $e);
    }
}
