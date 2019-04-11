<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\CityModel;
use App\Common\CustomPage;
use App\Models\ProvinceModel;

class CityController extends Controller
{
    private static $view_data;

    /**
     * 列表
     * @param string $flag
     * @param Request $request
     * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
     */
    public function show($flag='list',Request $request)
    {
        $condition = array();
        
        if($flag=='list'){
            $page_title = '城市列表';
        }else{
            abort(404);
        }
        
        self::$view_data['page_title'] = $page_title;
        self::$view_data['flag'] = $flag;
        
        $input = $request->all();
        foreach ($input as $k=>$v){
            $input[$k] = trim($v);
        }
    
        $page = (empty($input['page'])) ? 1 : $input['page'];//获取当前页
        $pageSize = SYSTEM_ADMIN_PER_PAGE;
        $page_param['page'] = $page;
        $page_param['page_size'] = $pageSize;
    
        //组织查询条件
        if(!empty($input['city_name'])){
            self::$view_data['city_name'] = $input['city_name'];
            $page_param['city_name'] = $input['city_name'];
            $condition['c.city_name'] = ['like'=>$input['city_name']];
        }
        
        $province_id = $request->input('province_id', '');
        if(!empty($province_id)){
            self::$view_data['province_id'] = $province_id;
            $condition['c.province_id'] = $province_id;
            $page_param['province_id'] = $province_id;
        }

        //组织分页
        $join_query = CityModel::organizeProvinceJoin();
        $recordCount = CityModel::getDataJoinCount($join_query,$condition);//总记录数
        $countPage = ceil($recordCount / $pageSize);//总页数
        $pageView = CustomPage::getSelfPageView($page, $countPage, 'admincp/city/list', $page_param);//分页视图
        self::$view_data['page_view'] = $pageView;

        $select = ['*'];
        $order_by = ['c.display_order' => 'asc'];
        $recordList = CityModel::getDataJoinList($join_query,$condition,$select,$order_by,$page,$pageSize);
        self::$view_data['record_count'] = $recordCount;
        self::$view_data['city_list'] = $recordList;
        self::$view_data['province_list'] = ProvinceModel::getRecordListCondition([],['*'],['display_order'=>'asc'],0,0);//得到省份列表
        return view('admin.city.show', self::$view_data);
    }
    
    /**
     * 增加/编辑
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($city_id,Request $request)
    {
        if(empty($city_id)){
            abort(404);
        }
        
        self::$view_data['page_title'] = ($city_id == -1) ? '添加城市' : '编辑城市';
        self::$view_data['url'] = (($city_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/city/list'):$_SERVER['HTTP_REFERER'];
        
        if($city_id!=-1){//编辑
            $city_data = CityModel::find($city_id);
            if(empty($city_data)){
                abort(404);
            }
            self::$view_data['city_data'] = $city_data;
        }
        
        self::$view_data['province_list'] = ProvinceModel::getRecordListCondition([],['*'],['display_order'=>'asc'],0,0);//得到省份列表

        return view('admin.city.edit',self::$view_data);
    }
    
    /**
     * 保存
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        foreach ($input as $k=>$v){
            $input[$k] = trim($v);
        }
        
        //验证信息
        $rules = ['city_name' => 'required'];
        $messages = ['required' => '城市名称不能为空'];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
    
        $city_id = $input['city_id'];
        
        $city_data = array(
            'province_id' => $input['province_id'],
            'city_name' => $input['city_name'],
            'display_order' => intval($input['display_order'])
        );

        if($city_id==-1){
            $city_data['city_id'] = getUuid();
            $result = CityModel::create($city_data);
        }else{
            $result = CityModel::updateRecordORM($city_id,$city_data);
        }
    
        if($result){
            $refer = $input['url'];
            $refer = urlsafe_b64encode($refer);
            $msg = ($city_id==-1) ? 'msg_add' : 'msg_edit';
            return redirect("admincp/message/$msg/1/$refer");
        }else{
            return back()->withErrors("操作失败");
        }
    }
    
    /**
     * 删除
     */
    public function delete($city_id=-1){
        if(empty($city_id)) abort(404);
   
        CityModel::deleteRecordORM($city_id);
        $msg = 'msg_delete';
        $time = 1;
    
        $referer =  empty($_SERVER['HTTP_REFERER'])?url('admincp/city/list'):$_SERVER['HTTP_REFERER'];
        $refer = urlsafe_b64encode($referer);
        return redirect("admincp/message/$msg/$time/$refer");
    }
    
    /**
     * 验证名称重复
     * @param Request $request
     */
    public function checkName(Request $request){
        $input = $request->all();
        foreach ($input as $k=>$v){
            $input[$k] = trim($v);
        }
    
        $city_id = $input['city_id'];
        $where = [
            'city_id' => ['!='=>$city_id],
            'city_name' => $input['city_name']
        ];
        $nameCount = CityModel::getRecordCountCondition($where);

        if($nameCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }
}