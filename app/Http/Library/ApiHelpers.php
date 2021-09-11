<?php

namespace App\Http\Library;
use Illuminate\Http\JsonResponse;

trait ApiHelpers{

    protected function onSuccess($data,string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' =>$data
        ],$code);
    }

    protected function onError(string $message= '', int $code = 0): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message
        ],$code);
    }
}