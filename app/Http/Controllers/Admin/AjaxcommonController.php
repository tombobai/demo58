<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\CityModel;

class AjaxcommonController extends Controller
{
    /**
     * 得到城市option
     */
    public function getCityOption(Request $request)
    {
        $province_id = trim($request->province_id);
        $option_str = CityModel::getCityOption($province_id, $request->select_id);
        echo $option_str;
    }

    /**
     * 得到权限option
     */
//    public function getPermissionOption(Request $request)
//    {
//        $permission_flag = $request->input('permission_flag');
//        $parent_id = $request->input('parent_id');
//
//        $option_str = PermissionModel::getPermissionOption($permission_flag, $parent_id);
//        echo $option_str;
//    }

    /**
     * 根据经纬度查询地址
     */
//    public function queryAddress(Request $request)
//    {
//        $amap = new Amap();
//        $res = $amap->getAddress($request->lng, $request->lat);
//        if ($res['status'] == 1) {
//            $address = $res['regeocode']['formatted_address'];
//        } else {
//            $address = '位置获取失败, 请稍后重试';
//        }
//
//        return response()->json(['code' => '1', 'msg' => 'Success', 'data' => $address]);
//    }

    /**
     * 查询用户通过手机号
     */
//    public function queryUserByTelephone(Request $request)
//    {
//        $telephone = $request->input('telephone');
//        $user = UserModel::findRecordOneCondition(['telephone' => data_encrypt($telephone)], ['user_id', 'user_name', 'cheng_value']);
//        if ($user) {
//            return Response()->json(['code' => 1, 'msg' => 'success', 'data' => $user]);
//        }
//        return Response()->json(['code' => 0, 'msg' => '会员不存在', 'data' => null]);
//    }
}