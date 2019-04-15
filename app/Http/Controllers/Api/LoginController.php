<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class LoginController extends ApiController
{
    /**
     * 登录页
     * @param Request $request
     * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
     */
    public function index(Request $request)
    {
        $rule = [
            'telephone' => 'required|size:11',
            'smsCode' => 'required|size:6'
        ];
        $message = $this->_validate($request, $rule);
        if(!empty($message)){
            return $this->_response('', ResponseCode::PARAM_ERROR, $message);
        }

        $result = [];
        $result['token'] = getUuid();
        //保存token
        return $this->_response($result);
    }
}