<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\AdminModel;

class UpdatepasswordController extends Controller
{
    private static $view_data;
    
    /**
     * 修改密码
     * @param string $flag
     * @param Request $request
     * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
     */
    public function index(Request $request)
    {
        self::$view_data['page_title'] = '修改密码';
        
        return view('admin.updatepassword', self::$view_data);
    }
    
    /**
     * 保存
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //新旧密码提示判断
        if ($request->old_password == $request->new_password ){
            return back()->withErrors("新密码不能与旧密码相同");
        }

        $admin_data = AdminModel::find(session('admin_id'));

        if ($admin_data['admin_password'] == md5($request->old_password) && md5(md5($request->old_password).$admin_data['salt']) == $admin_data['my_password'])
        {
            $salt = ynf_random(6);//产生6位随机数
            $update_data = array(
                'admin_password' => md5($request->new_password),
                'salt' => $salt,
                'my_password' => md5(md5($request->new_password).$salt)
            );

            $admin_id = session('admin_id');
            $result = AdminModel::updateRecordDB($admin_id,$update_data);

            if($result){
                $refer = $request->url;
                $refer = urlsafe_b64encode($refer);
                $msg = 'msg_updatepassword';
                return redirect("admincp/message/$msg/1/$refer");
            }else{
                return back()->withErrors("操作失败");
            }
        } else {
            return back()->withErrors("旧密码错误");
        }

    }
}