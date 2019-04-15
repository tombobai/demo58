<?php
namespace App\Business;


use App\Http\Controllers\Api\ResponseCode;

class ApiBusiness
{
    /**
     * api响应
     * @param string $data
     * @param int $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function apiResponse($data = null, $code = ResponseCode::SUCCESS, $message = 'success')
    {
        $response = array(
            'code' => $code,
            'msg' => $message,
            'time' => date('Y-m-d H:i:s'),
            'data' => $data,
        );

        return response()->json($response);
    }
}