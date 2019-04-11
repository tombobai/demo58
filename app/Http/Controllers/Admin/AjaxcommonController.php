<?php

namespace App\Http\Controllers\Admin;
use App\Models\PermissionModel;
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
    public function getPermissionOption(Request $request)
    {
        $permission_flag = $request->input('permission_flag');
        $parent_id = $request->input('parent_id');

        $option_str = PermissionModel::getPermissionOption($permission_flag, $parent_id);
        echo $option_str;
    }
}