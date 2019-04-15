<?php

namespace App\Http\Middleware\api;

use App\Business\ApiBusiness;
use App\Http\Controllers\Api\ResponseCode;
use Closure;

class CheckSignMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);//为了测试，暂时不验签

        $result_sign = $this->checkSignature($request->all());
        if($result_sign['code'] == ResponseCode::SUCCESS ){
            //检查token是否过期，是否有效
//            $token = $request->token;
//            if(empty($token)){
//                return apiResponse( '', ResponseCode::TOKEN_LACK, 'token参数缺失');
//            }
            return $next($request);
        }else{
            return ApiBusiness::apiResponse(null, $result_sign['code'], $result_sign['msg']);
        }
    }

    /**
     * 检查签名的合法性
     * @param $data
     * @return int
     */
    private function checkSignature($data)
    {
        $result_arr = [
            'code' => ResponseCode::SYS_ERROR,
            'msg' => ''
        ];

        if (empty($data['signature'])) {
            $result_arr = [
                'code' => ResponseCode::SIGNATURE_LACK,
                'msg' => '缺少签名参数'
            ];
            return $result_arr;
        }
        if (empty($data['time'])) {
            $result_arr = [
                'code' => ResponseCode::TIME_LACK,
                'msg' => '缺少time参数'
            ];
            return $result_arr;
        }

        $time = substr($data['time'], 0, 10);//有可能传的是13位的时间戮
        if ($time < time() - 2 * 60) {//2分钟前的请求，视为不合法
            $result_arr = [
                'code' => ResponseCode::TIME_NO_VALID,
                'msg' => '请求过期'
            ];
            return $result_arr;
        }

        $signature = $data['signature'];
        unset($data['signature']);

        $sign_string = '';
        ksort($data);//排序

        //拼接参数
        foreach ($data as $key => $val) {
            if (!is_object($val) && !is_array($val)) {//不是对象，上传图片或者文件字段，不参与签名
                $sign_string .= $key . $val;
            }
        }

        //加一个相互约定的字符串
        $secret_str = '0f977b6090bc11e89de47ef7fbe91ebc';

        $sign_string = $sign_string . $secret_str;
        //iLog('connection==='.$sign_string);

        //urlencode 暂时不用 duanyangbo
        //$sign_string = rawurlencode($sign_string);

        //转换为小写
        $sign_string = strtolower_extended($sign_string);//strtolower($sign_string);
        //iLog('lower==='.$sign_string);

        //md5加密签名得到signature
        $server_signature = md5($sign_string);
        //iLog('last==='.$server_signature);
        if ($signature != $server_signature) {
            $result_arr = [
                'code' => ResponseCode::SIGNATURE_ERROR,
                'msg' => '签名错误'
            ];
            return $result_arr;
        } else {
            $result_arr = [
                'code' => ResponseCode::SUCCESS,
                'msg' => ''
            ];
            return $result_arr;
        }
    }

}