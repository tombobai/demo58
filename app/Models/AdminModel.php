<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdminModel extends CommonModel
{
    //use SoftDeletes;//表中使用deleted_at时，应该放开注释

    /**
     * @var string
     */
    protected $table = 'yn_admin';

    /**
     * @var bool
     */
    //public $timestamps = false;//表中使用created_at、updated_at、deleted_at时，应该注释掉该行

    /**
     * @var string
     */
    protected $primaryKey = 'admin_id';

    /**
     * @var string
     */
    public $incrementing = false;//当主键不是自增或不是int类型时，必须要加这行，否则view中得不到主键的值

    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * 得到记录数-连接其它表
     * @param $where
     * @param $where_like
     */
    public static function getRecordJoinCount($where = [],$where_like = []){
        $query = \DB::table('s_admin as a')
            ->join('s_role as r', 'a.role_id', '=', 'r.role_id');
        if(!empty($where)){
            $query->where($where);
        }
        $query->where('a.telephone','!=','admin');
        foreach ($where_like as $key=>$value){
            $query->where($key, 'like', "%$value%");
        }
        return $query->count();
    }

    /**
     * 得到记录列表-连接其它表
     * @param $where
     * @param $where_like
     * @param $page
     * @param $pageSize
     */
    public static function getRecordJoinList($where = [],$where_like = [], $page = 0,$pageSize = 0){
        $query = \DB::table('s_admin as a')
            ->join('s_role as r', 'a.role_id', '=', 'r.role_id')
            ->leftjoin('s_user as u', 'u.user_id', '=', 'a.user_id')
            ->select('a.*','r.role_name','u.user_name','u.telephone as user_phone');
        if(!empty($where)){
            $query->where($where);
        }
        $query->where('a.telephone','!=','admin');
        foreach ($where_like as $key=>$value){
            $query->where($key, 'like', "%$value%");
        }
        if($page > 0 && $pageSize > 0){
            $query->forPage($page, $pageSize);
        }
        $query->orderBy('a.created_at', 'DESC');
        return $query->get();
    }
}
