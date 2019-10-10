<?php
/**
 * Created by Dung Nguyen on 12/25/18.
 * Copyright © 2018-2019 Beeknights Co., Ltd. All rights reserved.
 */

namespace App\Http\Responses;
class APIResponse
{
    const DEFAULT_ERROR_MESSAGE = 'Server error';
    const DEFAULT_FAIL_MESSAGE = 'Failed!';
    const DEFAULT_SUCCESS_MESSAGE = 'Successful!';

    public static function response($status, $code, $message, $data = [], $developerMessage = '')
    {
        $result = [
            'message' => $message,
            'data' => $data,
            'code' => $code
        ];

        if (config('app.env') != 'production') {
            $result['developer_message'] = $developerMessage;
        }

        return response()->json($result, $status);
    }

    public static function error(\Exception $error)
    {
        return self::response(
            500,
            ResponseCode::ERROR,
            self::DEFAULT_ERROR_MESSAGE,
            $error->getTrace(),
            $error->getMessage()
        );
    }

    // Success
    public static function success(
        $data = [],
        $message = self::DEFAULT_SUCCESS_MESSAGE,
        $code = ResponseCode::SUCCESS,
        $developerMessage = '')
    {
        return self::response(200, $code, $message, $data, $developerMessage);
    }

    // Fail
    public static function fail(
        $data = [],
        $message = self::DEFAULT_FAIL_MESSAGE,
        $code = ResponseCode::ERROR,
        $developerMessage = '')
    {
        return self::response(200, $code, $message, $data, $developerMessage);
    }

    // Bad request
    public static function error400($message, $data = [], $developerMessage = '')
    {
        return self::response(400, ResponseCode::ERROR, $message, $data, $developerMessage);
    }

    // Unauthorized
    public static function error401($message, $data = [], $developerMessage = '')
    {
        return self::response(401, ResponseCode::ERROR, $message, $data, $developerMessage);
    }

    // Not found
    public static function error404($message, $data = [], $developerMessage = '')
    {
        return self::response(404, ResponseCode::ERROR, $message, $data, $developerMessage);
    }

    // Server internal error
    public static function error500($message, $data = [], $developerMessage = '')
    {
        return self::response(500, ResponseCode::ERROR, $message, $data, $developerMessage);
    }
}