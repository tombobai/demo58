<?php

namespace App\Http\Controllers;

use App\Business\ApiBusiness;
use Validator;
use App\Http\Controllers\Api\ResponseCode;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function _response( $data=null, $code = ResponseCode::SUCCESS, $message = 'success' ){
        return ApiBusiness::apiResponse( $data, $code, $message );
    }

    /**
     * 检测参数合法性
     * @param $request
     * @param $rules
     * @param array $messages
     * @return mixed
     */
    protected function _validate( $request, $rules=[], $messages=array() ){
        $param_data = $request->all();
        $error = Validator::make($param_data, $rules, $messages)->errors()->first();
        return $error;
    }

    /**
     * 检测参数合法性
     * @param $request
     * @param $rules
     * @param array $messages
     * @return mixed
     */
    protected function _validateParam( $param_data, $rules=[], $messages=array() ){
        $error = Validator::make($param_data, $rules, $messages)->errors()->first();
        return $error;
    }
}
