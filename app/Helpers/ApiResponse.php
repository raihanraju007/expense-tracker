<?php 
namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function created($data = null, string $message = 'Created'): JsonResponse
    {
        return self::success($data, $message, 201);
    }

    public static function deleted(string $message = 'Resource deleted successfully'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ], 200); 
    }

    public static function accepted($data = null, string $message = 'Accepted'): JsonResponse
    {
        return self::success($data, $message, 202);
    }

    public static function noContent(string $message = 'No Content'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ], 204);
    }
    
    public static function error(string $message = 'Error', int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    public static function badRequest(string $message = 'Bad Request', $errors = null): JsonResponse
    {
        return self::error($message, 400, $errors);
    }

    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return self::error($message, 401);
    }

    public static function paymentRequired(string $message = 'Payment Required'): JsonResponse
    {
        return self::error($message, 402);
    }

    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return self::error($message, 403);
    }

    public static function notFound(string $message = 'Not Found'): JsonResponse
    {
        return self::error($message, 404);
    }

    public static function requestTimeout(string $message = 'Request Timeout'): JsonResponse
    {
        return self::error($message, 408);
    }

    public static function conflict(string $message = 'Conflict'): JsonResponse
    {
        return self::error($message, 409);
    }

    public static function unprocessableEntity(string $message = 'Unprocessable Entity', $errors = null): JsonResponse
    {
        return self::error($message, 422, $errors);
    }

    public static function tooManyRequests(string $message = 'Too Many Requests'): JsonResponse
    {
        return self::error($message, 429);
    }

    public static function serverError(string $message = 'Server Error'): JsonResponse
    {
        return self::error($message, 500);
    }
}
