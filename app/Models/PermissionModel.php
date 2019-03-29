<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModel extends CommonModel
{
    //use SoftDeletes;//表中使用deleted_at时，应该放开注释

    /**
     * @var string
     */
    protected $table = 'yn_permission';

    /**
     * @var bool
     */
    //public $timestamps = false;//表中使用created_at、updated_at、deleted_at时，应该注释掉该行

    /**
     * @var string
     */
    protected $primaryKey = 'permission_id';

    /**
     * @var string
     */
    public $incrementing = false;//当主键不是自增或不是int类型时，必须要加这行，否则view中得不到主键的值

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * 得到父子级列表
     * @param $role_id 角色id
     * @return
     */
    public static function getPermissionParentChildrenList($role_id)
    {
        $permission_arr = array();
        $child_permission_arr = array();
        $ids_arr = array();
        if ($role_id != 'admin') {
            $ids_arr = RoleModel::getPermissionArr($role_id);
            if (empty($ids_arr)) {//非admin用户，若无权限，直接返回
                return $permission_arr;
            }
        }

        $permission_list = $operate_permission_list = [];
        $all_permission_list = self::where('permission_flag', 1)->orderBy('parent_id', 'asc')->orderBy('display_order', 'asc')->get()->toArray();
        foreach($all_permission_list as $key=>$value){
            if($value['permission_type'] == 1){
                $permission_list[] = $value;
            }
            if($value['permission_type'] == 2){
                $operate_permission_list[] = $value;
            }
        }

        //记入一级菜单
        foreach ($permission_list as $row) {
            if (empty($row['parent_id'])) {
                if (in_array($row['permission_id'], $ids_arr) || $role_id == 'admin') {
                    $permission_arr[$row['permission_id']]['parent'] = $row;
                    $permission_arr[$row['permission_id']]['first_url'] = '';
                }
            }
        }

        //记入二级菜单
        foreach ($permission_list as $row) {
            if (!empty($row['parent_id'])) {
                if (in_array($row['permission_id'], $ids_arr) || $role_id == 'admin') {
                    if (!empty($permission_arr[$row['parent_id']])) {
                        if (empty($permission_arr[$row['parent_id']]['first_url'])) {
                            $permission_arr[$row['parent_id']]['first_url'] = $row['permission_url'];
                        }
                        $child_permission_arr[$row['permission_id']] = $row['parent_id'];
                        $permission_arr[$row['parent_id']]['son'][$row['permission_id']] = $row;
                    }
                }
            }
        }

        //记入三级权限
        foreach ($operate_permission_list as $row) {
            if (!empty($row['parent_id'])) {
                if (in_array($row['permission_id'], $ids_arr) || $role_id == 'admin') {
                    if(!empty($child_permission_arr[$row['parent_id']])){
                        $permission_arr[$child_permission_arr[$row['parent_id']]]['son'][$row['parent_id']]['son'][$row['permission_id']] = $row;
                    }
                }
            }
        }

        return $permission_arr;
    }

    /**
     * 得到树列表
     * @param $permission_flag
     * @return array
     */
    public static function getPermissionTreeList($permission_flag)
    {
        $permission_list = self::where('permission_flag', $permission_flag)->orderBy('display_order', 'asc')->get()->toArray();

        $permission_arr = array();
        self::createTreeList($permission_arr, $permission_list, '', 0);

        return $permission_arr;
    }

    /**
     * 产生树列表
     * @param $record_arr 最终返回的树状列表
     * @param $record_list
     * @param $parent_id
     * @param $level
     */
    public static function createTreeList(&$record_arr, &$record_list, $parent_id, $level)//注意：$record_arr、$record_list是引用传递
    {
        foreach ($record_list as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                $value['level'] = $level + 1;
                $record_arr[] = $value;
                self::createTreeList($record_arr, $record_list, $value['permission_id'], $value['level']);
            }
        }
    }

    /**
     * 得到权限option
     * @param $permission_flag
     * @param string $permission_id
     * @return string
     */
    public static function getPermissionOption($permission_flag, $permission_id = '')
    {
        $permission_list = self::getPermissionTreeList($permission_flag);

        $result_str = '<option value="">--顶级--</option>';
        if (empty($permission_list)) {
            return $result_str;
        } else {
            foreach ($permission_list as $key => $value) {
                $str = '';
                if ($value['level'] > 1) {
                    $str .= '|';
                }

                for ($i = 2; $i <= $value['level']; $i++) {
                    $str .= '--';
                }


                $select_str = '';
                if (!empty($permission_id) && $permission_id == $value['parent_id']) $select_str = ' selected="selected"';
                $result_str .= '<option value="' . $value['permission_id'] . '"' . $select_str . '>' . $str . $value['permission_name'] . '</option>';
            }
        }
        return $result_str;
    }
}
