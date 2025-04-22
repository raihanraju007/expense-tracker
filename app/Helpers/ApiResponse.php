<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function error(string $message = 'Something went wrong', $errors = null, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    public static function created($data = null, string $message = 'Created'): JsonResponse
    {
        return self::success($data, $message, 201);
    }

    public static function deleted(string $message = 'Deleted'): JsonResponse
    {
        return self::success(null, $message, 200);
    }

    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return self::error($message, null, 401);
    }

    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return self::error($message, null, 403);
    }

    public static function notFound(string $message = 'Not Found'): JsonResponse
    {
        return self::error($message, null, 404);
    }

    public static function unprocessableEntity(string $message = 'Validation failed', $errors = []): JsonResponse
    {
        return self::error($message, $errors, 422);
    }

    public static function serverError(string $message = 'Server error'): JsonResponse
    {
        return self::error($message, null, 500);
    }
}
