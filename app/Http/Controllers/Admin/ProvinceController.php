<?php

namespace App\Http\Controllers\Admin;

use App\Models\CityModel;
use App\Models\ProvinceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Common\CustomPage;

class ProvinceController extends Controller
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
            $page_title = '省份列表';
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
        if(!empty($input['province_name'])){
            self::$view_data['province_name'] = $input['province_name'];
            $page_param['province_name'] = $input['province_name'];
            $condition['province_name'] = ['like'=> $input['province_name']];
        }

        //组织分页
        $recordCount = ProvinceModel::getRecordCountCondition($condition);//总记录数
        $countPage = ceil($recordCount / $pageSize);//总页数
        $pageView = CustomPage::getSelfPageView($page, $countPage, 'admincp/province/list', $page_param);//分页视图
        self::$view_data['page_view'] = $pageView;

        $order_by = ['display_order'=>'asc'];
        $recordList = ProvinceModel::getRecordListCondition($condition,['*'],$order_by,$page,$pageSize);
        self::$view_data['record_count'] = $recordCount;
        self::$view_data['province_list'] = $recordList;
 
        return view('admin.province.show', self::$view_data);
    }
    
    /**
     * 增加/编辑
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($province_id,Request $request)
    {
        if(empty($province_id)){
            abort(404);
        }
        
        self::$view_data['page_title'] = ($province_id == -1) ? '添加省份' : '编辑省份';
        self::$view_data['url'] = (($province_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/province/list'):$_SERVER['HTTP_REFERER'];
        
        if($province_id!=-1){//编辑
            $province_data = ProvinceModel::find($province_id);
            if(empty($province_data)){
                abort(404);
            }
            self::$view_data['province_data'] = $province_data;
        }

        return view('admin.province.edit',self::$view_data);
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
        $rules = ['province_name' => 'required'];
        $messages = ['required' => '省份名称不能为空'];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
    
        $province_id = $input['province_id'];
        
        $province_data = array(
            'province_name' => $input['province_name'],
            'display_order' => intval($input['display_order'])
        );

        if($province_id==-1){//编辑
            $province_data['province_id'] = getUuid();
            $result = ProvinceModel::create($province_data);
        }else{
            $result = ProvinceModel::updateRecordORM($province_id,$province_data);
        }
    
        if($result){
            $refer = $input['url'];
            $refer = urlsafe_b64encode($refer);
            $msg = ($province_id==-1) ? 'msg_add' : 'msg_edit';
            return redirect("admincp/message/$msg/1/$refer");
            
        }else{
            return back()->withErrors("操作失败");
        }
    }
    
    /**
     * 删除
     */
    public function delete($province_id=-1){
        if(empty($province_id)) abort(404);
    
        $condition = array("p.province_id" => $province_id);
        $join_query = CityModel::organizeProvinceJoin();
        $num = CityModel::getDataJoinCount($join_query,$condition);//总记录数
        if ($num > 0){
            $msg = 'province_delete';
            $time = -1;
        } else {
            ProvinceModel::deleteRecordORM($province_id);
            $msg = 'msg_delete';
            $time = 1;
        }
    
        $referer =  empty($_SERVER['HTTP_REFERER'])?url('admincp/province/list'):$_SERVER['HTTP_REFERER'];
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

        $province_id = $input['province_id'];
        $where = [
            'province_id' => ['!='=>$province_id],
            'province_name' => $input['province_name']
        ];
        $nameCount = ProvinceModel::getRecordCountCondition($where);

        if($nameCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }
}