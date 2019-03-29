<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModel extends CommonModel
{
    //use SoftDeletes;//表中使用deleted_at时，应该放开注释

    /**
     * @var string
     */
    protected $table = 'yn_role';

    /**
     * @var bool
     */
    //public $timestamps = false;//表中使用created_at、updated_at、deleted_at时，应该注释掉该行

    /**
     * @var string
     */
    protected $primaryKey = 'role_id';

    /**
     * @var string
     */
    public $incrementing = false;//当主键不是自增或不是int类型时，必须要加这行，否则view中得不到主键的值

    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * 根据角色id得到相应的权限
     * @param $role_id
     * @return
     */
    public static function getPermissionArr($role_id)
    {
        $result = array();
        if (!empty($role_id))
        {
            $data = self::where('role_id',$role_id)->first();
            $result = explode("|", $data['permission_ids']);
        }
        return $result;
    }
}
