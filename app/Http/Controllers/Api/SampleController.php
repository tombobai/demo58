<?php

namespace App\Http\Controllers\Api;

use App\Models\SampleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SampleController extends ApiController
{
    /**
     * 得到样例列表
     * @param Request $request
     * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
     */
    public function getSampleList(Request $request)
    {
        $rule = [
            'page' => 'required|integer',
            'pageSize' => 'required|integer'
        ];
        $message = $this->_validate($request, $rule);
        if(!empty($message)){
            return $this->_response('', ResponseCode::PARAM_ERROR, $message);
        }

        $result = [];
        $condition['delete_flag'] = 1;
        $order_by = ['display_order'=>'asc'];
        $recordList = SampleModel::getRecordListCondition($condition,['*'],$order_by,$request->page,$request->pageSize);
        foreach($recordList as $key=>$value){
            $result[$key]['sample_id'] = $value['sample_id'];
            $result[$key]['sample_name'] = $value['sample_name'];
            $result[$key]['created_at'] = $value['created_at']->timestamp;
        }

        return $this->_response($result);
    }
}