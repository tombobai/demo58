<?php

namespace App\Http\Middleware\admin;

use App\Models\ConfigModel;
use Closure;

class CheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //检测是否登录
        $admin_id = session('admin_id');
        if (empty($admin_id)) {
            return redirect('admincp/login');
        }

        // if(session('admin_name')=='系统管理员')return $next($request);
        //检测是否有权限
        $admin_permission = session('admin_permission');
        $route = $request->getRequestUri();//获取路由
        $route_arr = explode('/', $route);
        if (empty($admin_permission)) {
            $refer = urlsafe_b64encode(url('admincp/login'));
            $msg = 'msg_no_permission';
            return redirect("admincp/message/$msg/1/$refer");
        } else {

            $has_permission_flag = 0;
            foreach ($admin_permission as $key => $value) {
                if ($has_permission_flag == 1) {
                    break;
                }
                if (!empty($value['son'])) {
                    foreach ($value['son'] as $key_son => $value_son) {
                        if (in_array($value_son['permission_key'], $route_arr) || $this->_check_permission($value_son['permission_key'], $route_arr)) {
                            $has_permission_flag = 1;
                            break;
                        }
                    }
                }
            }

            if (session('admin_name') != '系统管理员')
                if ($has_permission_flag == 0) {
                    $refer = urlsafe_b64encode(url('admincp/home'));
                    $msg = 'msg_no_permission';
                    return redirect("admincp/message/$msg/-1/$refer");
                }
        }

        //系统设置动态定义为常量
        if (!defined('SYSTEM_SITE_NAME')) {

            $config = ConfigModel::getConfig();
            foreach ($config as $key => $value) {
                define('SYSTEM_' . strtoupper($key), $value);
            }
        }

        return $next($request);
    }

    /**
     * 检查权限-主要用于分页的查询
     * @param $permission_key
     * @param $route_arr
     * @return bool
     */
    private function _check_permission($permission_key, $route_arr)
    {
        $result = false;
        foreach ($route_arr as $key => $value) {
            if (!(strpos('/' . $value, '/' . $permission_key . '?') === false)) {//如果找到
                $result = true;
                return $result;
            }
        }
        return $result;
    }
}