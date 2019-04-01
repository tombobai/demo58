<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class CityModel
 * @package App\Model
 */
class CityModel extends CommonModel
{
    //use SoftDeletes;//表中使用deleted_at时，应该放开注释

    /**
     * @var string
     */
    protected $table = 'yn_city';

    /**
     * @var bool
     */
    //public $timestamps = false;//表中使用created_at、updated_at、deleted_at时，应该注释掉该行

    /**
     * @var string
     */
    protected $primaryKey = 'city_id';

    /**
     * @var string
     */
    public $incrementing = false;//当主键不是自增或不是int类型时，必须要加这行，否则view中得不到主键的值

    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * 得到记录列表-连接其它表
     * @param $where
     * @param $where_like
     * @param $page
     * @param $pageSize
     */
    public static function getRecordJoinList($where = [],$where_like = [], $page = 0,$pageSize = 0){
        $query = \DB::table('yn_city as c')
            ->join('yn_province as p', 'c.province_id', '=', 'p.province_id')
            ->select('c.*','p.province_name')
            ->where($where);
        foreach ($where_like as $key=>$value){
            $query->where($key, 'like', "%$value%");
        }
        if($page > 0 && $pageSize > 0){
            $query->forPage($page, $pageSize);
        }
        $query->orderBy('c.display_order', 'asc');
        return $query->get();
    }

    /**
     * 根据省份ID得到所属城市option
     * @param $province_id
     */
    public static function getCityOption($province_id,$select_id = 0){
        $condition = array("c.province_id" => $province_id, "c.delete_flag" => 1);
        $condition_like = array();
        $city_list = self::getRecordJoinList($condition,$condition_like);

        $result_str = '';
        if(empty($city_list)){
            $result_str = '<option value="">--选择市/区--</option>';
            return $result_str;
        }else{
            foreach ($city_list as $value){
                $select_str = '';
                if (! empty($select_id) && $select_id == $value->city_id) $select_str = ' selected="selected"';
                $result_str .= '<option value="' . $value->city_id . '"' . $select_str . '>' . $value->city_name . '</option>';
            }
        }
        return $result_str;
    }
}
