<?php

namespace App\Business;

use Illuminate\Support\Facades\URL;

class AuthenticateBusiness
{

    public static function hasPermission($authenticate = '')
    {
        if(!empty($authenticate) && !is_array($authenticate)){
            $authenticate = explode('|', $authenticate);
        }
        $admin_permission = session('admin_permission');

        $has_permission_flag = false;
        $route = URL::getRequest()->getRequestUri();
        $route_arr = explode('/', $route);

        //admin用户拥有所有权限
        if (session('telephone') == 'admin') {
            foreach($authenticate as $item){
                $has_permission_flag[$item] = true;
            }
            return $has_permission_flag;
        }

        if(!empty($authenticate)){
            foreach($authenticate as $item){
                $has_permission_flag[$item] = false;
            }
        }

        self::getChildPermission($admin_permission, $authenticate, $has_permission_flag, [], $route_arr);

        return $has_permission_flag;
    }

    public static function getChildPermission($permissions, $authenticate, &$has_permission_flag, $parent, $route_arr)
    {
        $route = trim(join('/', $route_arr), '/');
//        dd($permissions);

        foreach ($permissions as $key => $value) {
            if ($has_permission_flag === true) break;

            if (!empty($value['son'])) {//判断是否有下级权限
                self::getChildPermission($value['son'], $authenticate, $has_permission_flag, $value, $route_arr);
                $qus_flag = !(strpos('/' . $route, '?') === false) ? 1 : 0;
                if (empty($authenticate) && !empty($value['permission_key'])
                    && !(strpos('/' . $route, '/' . trim($value['permission_url'], '/') . ($qus_flag ? '?' : '')) === false)
                ) {//有第三级操作权限的菜单
                    if (self::_check_permission($value['permission_key'], $route_arr)) {
                        $has_permission_flag = true;
                        break;
                    }
                }
            } else if ($value['permission_type'] == 2) {//判断是否有操作权限
                if (in_array($parent['permission_key'], $route_arr)) {
                    if (empty($authenticate)) {
                        if (self::_check_permission($value['permission_key'], $route_arr)) {
                            $has_permission_flag = true;
                            break;
                        }
                    } else {
                        foreach($authenticate as $auth){
                            if(is_array($has_permission_flag) && !in_array($auth, $has_permission_flag)){
                                $has_permission_flag[$auth] = false;
                            }
                            if ($auth == $value['permission_key']) {
                                $has_permission_flag[$auth] = true;
                                break;
                            }
                        }
                    }
                }
            } else {

                if (!empty($value['permission_key'])) {//无第三级操作权限的菜单
                    if (self::_check_permission($value['permission_key'], $route_arr)) {
                        $has_permission_flag = true;
                        break;
                    }
                }
            }
        }
    }

    /**
     * 分页列表的权限判断
     */
    public static function _check_permission($permission_key, $route_arr)
    {
        $can = false;
        foreach ($route_arr as $key => $value) {
            if (!(strpos('/' . $value, '/' . $permission_key . '?') === false)) {//如果找到
                $can = true;
                return $can;
            }
        }

        return $can || in_array($permission_key, $route_arr);
    }
}