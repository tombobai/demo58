<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigModel extends CommonModel
{
    //use SoftDeletes;//表中使用deleted_at时，应该放开注释

    /**
     * @var string
     */
    protected $table = 'yn_config';

    /**
     * @var bool
     */
    //public $timestamps = false;//表中使用created_at、updated_at、deleted_at时，应该注释掉该行

    /**
     * @var string
     */
    protected $primaryKey = 'config_id';

    /**
     * @var string
     */
    public $incrementing = false;//当主键不是自增或不是int类型时，必须要加这行，否则view中得不到主键的值

    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * 得到所有的配置信息
     */
    public static function getConfig(){
        $return_array = array();
        $configList = self::get()->toArray();
        foreach ($configList as $row){
            $return_array[$row['config_param']] = $row['config_value'];
        }
        return $return_array;
    }

    /**
     * 更新配置信息。若存在，则更新；不存在，则插入。
     */
    public static function setConfig($param,$value){
        $data = array('config_value'=>$value);
        $condition = array('config_param' => $param);

        $configData = self::where('config_param',$param)->first();
        if (empty($configData)){
            $insert_data = array_merge($condition,$data);
            $insert_data['config_id'] =  getUuid();
            self::create($insert_data);
        }else{
            self::where('config_id',$configData['config_id'])->update($data);
        }
    }
}
