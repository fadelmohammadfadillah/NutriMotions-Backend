<?php

namespace App\Service;

class ResponseAPIService
{
    private static $response = [
        "statusCode" => 0,
        "responseMessage" => "",
        "responseData" => null
    ];

    public static function createResponse($status, $message = "", $data = null)
    {
        self::$response['statusCode'] = $status;
        self::$response['responseMessage'] = $message;
        self::$response['responseData'] = $data;

        return response()->json(self::$response, $status);
    }
}
