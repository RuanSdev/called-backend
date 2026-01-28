<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success(string $message, array $data = [], int $code = 200)
    {
        return response()->json([
            "success" => true,
            "message" => $message,
            'data' => $data
        ], $code);
    }

    public static function error(string $message, array $errors = null, int $code = 500)
    {
        return response()->json([
            "success" => false,
            "message" => $message,
            'errors' => $errors
        ], $code);
    }
}