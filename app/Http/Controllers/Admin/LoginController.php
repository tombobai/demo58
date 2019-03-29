<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use App\Models\PermissionModel;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{

    /**
     * 登录页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if(!empty(session('admin_id'))){
            return redirect("admincp/home");
        }

        return view('admin.login');
    }

    /**
     * 登录
     * @param Request $request
     */
    public function store(Request $request)
    {
        //检查验证码
        $rules = ['yam' => 'captcha'];
        $messages = ['captcha' => '验证码错误'];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        //检查用户名和密码
        $admin_data = AdminModel::findRecordOneCondition(['telephone' => ynf_encrypt($request->admin_name)]);
        if(empty($admin_data)){
            return back()->withInput()->withErrors('手机号不存在');
        }else{
            $input_password = $request->admin_password;
            $admin_password = $admin_data['admin_password'];
            if($admin_password == md5($input_password) && md5(md5($input_password).$admin_data['salt']) == $admin_data['my_password']){
                $admin_telephone = ynf_decrypt($admin_data['telephone']);
                $admin_id = $admin_data['admin_id'];
                AdminModel::updateRecordORM($admin_id,['admin_last_time'=>time()]);

                //保存session
                $role_id = ($admin_telephone == 'admin') ? 'admin' : $admin_data['role_id'];

                $session_arr = array(
                    'telephone' => $admin_telephone,
                    'admin_id' => $admin_id,
                    'true_name' => $admin_data['true_name'],
                    'admin_permission' => PermissionModel::getPermissionParentChildrenList($role_id)
                );
                session($session_arr);
                return redirect("admincp/home");

            }else{
                return back()->withInput()->withErrors('密码错误');
            }
        }
    }

    /**
     * 生成验证码
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCaptcha(){
        //echo captcha_img();
        return response()->json(['code' => '1', 'msg' => 'success','data' => captcha_src()]);
    }

    /**
     * 退出
     * @param Request $request
     */
    public function logout(Request $request){
        //清session
        $request->session()->pull('telephone');
        $request->session()->pull('admin_id');
        $request->session()->pull('true_name');
        $request->session()->pull('admin_permission');

        return redirect('admincp/login');
    }
}