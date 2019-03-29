<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CommonController extends Controller
{

    /**
     * home页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $admin_permission = session('admin_permission');
        return view('admin.common.home', ['menu' => $admin_permission]);
    }

    /**
     * 欢迎页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        $page_title = '欢迎页';
        return view('admin.common.welcome', ['page_title' => $page_title]);
    }

    /**
     * 提示跳转页
     * @param $message 提示信息
     * @param $second 停留秒数
     * @param $url_forward 跳转链接
     * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
     */
    public function message($message, $second = 1, $url_forward = '')
    {
        $msg_array = array(
            'msg_ok' => '操作成功！',
            'msg_add' => '添加成功！',
            'msg_edit' => '编辑成功！',
            'msg_delete' => '删除成功！',
            'msg_delete_driver_failed' => '正在使用不能被删除！',
            'msg_recovery' => '恢复成功！',
            'msg_true_delete' => '彻底删除成功！',
            'msg_import' => '导入成功！',
            'msg_submit' => '提交成功！',
            'msg_login' => '您还没有登录或登录已过期，请登录！',
            'msg_no_permission' => '您没有该操作的权限，请联系管理员！',
            'msg_none_left' => '该菜单下无左侧菜单，请联系管理员！',
            'msg_updatepassword' => '密码修改成功！',
            'msg_no_data' => '数据不存在！',
            'login_success' => '登录成功！',
            'no_permission' => '没有操作该功能的权限，请联系管理员！',
            'role_delete' => '请先删除该角色下的所有管理员，再进行此操作！',
            'permission_delete' => '请先删除该权限下的所有子权限，再进行此操作！',
            'msg_permission_parent' => '所属权限只能选择顶级或一级权限！',
            'province_delete' => '请先删除该省份下的所有城市，再进行此操作！',
            'order_permission' => '非法操作，您无权操作该订单！',
            'transaction_error' => '事务异常！',
        );

        $page_title = '操作提示';
        $msg = isset($msg_array[$message]) ? $msg_array[$message] : $message;
        $url = urlsafe_b64decode($url_forward);
        $wait_time = intval($second) * 1000;

        return view('admin.common.message', ['page_title' => $page_title, 'msg' => $msg, 'url' => $url, 'wait_time' => $wait_time]);
    }
}