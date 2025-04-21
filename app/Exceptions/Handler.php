<?php

namespace App\Exceptions;

use Throwable;
use App\Helpers\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * Inputs never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register exception handling callbacks.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Optional: Log or notify
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Return JSON response for API
        if ($request->expectsJson()) {

            if ($e instanceof ValidationException) {
                return ApiResponse::unprocessableEntity('Validation failed', $e->errors());
            }

            if ($e instanceof ModelNotFoundException) {
                $model = class_basename($e->getModel());
                return ApiResponse::notFound("$model not found.");
            }

            if ($e instanceof NotFoundHttpException) {
                return ApiResponse::notFound('Route not found.');
            }

            if ($e instanceof AuthenticationException) {
                return ApiResponse::unauthorized('Unauthenticated.');
            }

            if ($e instanceof HttpException) {
                return ApiResponse::error(
                    $e->getMessage() ?: 'HTTP error occurred',
                    $e->getStatusCode()
                );
            }

            if ($e instanceof QueryException) {
                return ApiResponse::serverError('Database error: ' . $e->getMessage());
            }

            return ApiResponse::serverError(
                config('app.debug') ? $e->getMessage() : 'Something went wrong.'
            );
        }

        // Non-API fallback
        return parent::render($request, $e);
    }

    /**
     * Handle unauthenticated exception.
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return ApiResponse::unauthorized('Authentication required.');
        }

        return redirect()->guest(route('login'));
    }
}
