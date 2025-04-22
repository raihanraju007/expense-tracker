<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return $this->jsonResponse(422, 'Validation failed', $e->errors());
        }

        if ($e instanceof ModelNotFoundException) {
            return $this->jsonResponse(404, 'Resource not found');
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->jsonResponse(404, 'Route not found');
        }

        if ($e instanceof AuthenticationException) {
            return $this->jsonResponse(401, 'Unauthenticated');
        }

        if ($e instanceof HttpException) {
            return $this->jsonResponse($e->getStatusCode(), $e->getMessage() ?: 'HTTP error occurred');
        }

        if ($e instanceof QueryException) {
            return $this->jsonResponse(500, 'Database error', [
                'error' => $e->getMessage()
            ]);
        }

        return $this->jsonResponse(500, 'Something went wrong', [
            'error' => config('app.debug') ? $e->getMessage() : null
        ]);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->jsonResponse(401, 'Unauthenticated');
    }

    private function jsonResponse(int $statusCode, string $message, $errors = null)
    {
        return response()->json([
            'status' => $statusCode < 400,
            'status_code' => $statusCode,
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}
