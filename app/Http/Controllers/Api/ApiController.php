<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendResponse($result, $message, $statusCode)
    {
        $response = [
            "success" => true,
            "status_code" => $statusCode,
            "message" => $message,
            "data" => $result,
        ];
        return response()->json($response, $statusCode);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendError($error, $errorMessages = [], $statusCode = 404)
    {
        $response = [
            "success" => false,
            "message" => $error,
        ];

        if (!empty($errorMessages)) {
            $response = [
                "success" => false,
                "status_code" => $statusCode,
                "message" => $error,
                "errors" => $errorMessages,
            ];
        }
        return response()->json($response, $statusCode);
    }
}
