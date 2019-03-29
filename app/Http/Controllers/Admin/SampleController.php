<?php

namespace App\Http\Controllers\Admin;

use App\Business\CommonBusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Model\SampleModel;
use App\Common\CustomPage;
use App\Model\CityModel;
use App\Model\ProvinceModel;
use App\Common\CustomUpload;

class SampleController extends Controller
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
        /******************连接查询语句********************/
 /*
        $join_condition = [
            'c.province_id' => '7b982ce6059911e895b3080027de0e0e'
        ];
        $join_query = SampleModel::organizeCityJoin();
        $recordCount = SampleModel::getDataJoinCount($join_query, $join_condition);//总记录数
        //dd($recordCount);

        $select = ['p.province_name','c.city_name'];//['*']
        $order_by = ['c.city_name' => 'desc'];
        $page = 1;
        $pageSize = 10;
        $recordList = SampleModel:: getDataJoinList($join_query,$join_condition,$select,$order_by,$page,$pageSize);
        dd($recordList);
 */
        /**************************************/

        $condition = array();

        if($flag=='list'){
            $page_title = '样例列表';
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

        //获取查询条件和列表
        list($page_param, $recordList) = $this->getParamAndList($input,$condition,$page,$pageSize);

        //组织分页
        $recordCount = SampleModel::getRecordCountCondition($condition);//总记录数
        $countPage = ceil($recordCount / $pageSize);//总页数
        $pageView = CustomPage::getSelfPageView($page, $countPage, 'admincp/sample/list', $page_param);//分页视图
        self::$view_data['page_view'] = $pageView;

        self::$view_data['record_count'] = $recordCount;
        self::$view_data['sample_list'] = $recordList;

        return view('admin.sample.show', self::$view_data);
    }

    /**
     * 增加/编辑
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sample_id,Request $request)
    {
        if(empty($sample_id)){
            abort(404);
        }

        self::$view_data['page_title'] = ($sample_id == -1) ? '添加样例' : '编辑样例';
        self::$view_data['url'] = (($sample_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/sample/list'):$_SERVER['HTTP_REFERER'];

        $sample_data = array();
        if($sample_id!=-1){//编辑
            $sample_data = SampleModel::find($sample_id);
            if(empty($sample_data)){
                abort(404);
            }
            self::$view_data['sample_data'] = $sample_data;
            self::$view_data['sample_data']['sample_tags'] = explode('|', $sample_data['sample_tags']);
            self::$view_data['city_options'] = CityModel::getCityOption($sample_data['province_id'],$sample_data['city_id']);
        }
        self::$view_data['province_list'] = [];
        return view('admin.sample.edit',self::$view_data);
    }

    /**
     * 保存
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        //验证信息
        $rules = ['sample_name' => 'required'];
        $messages = ['required' => '样例名称不能为空'];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $sample_id = $input['sample_id'];

        //复选框
        $sample_tags_arr = ($input['sample_tags'] == '') ? array() : $input['sample_tags'];
        $sample_tags = '|'.implode("|", $sample_tags_arr).'|';

        $sample_data = array(
            'sample_name' => trim($input['sample_name']),
            'display_order' => intval($input['display_order']),
            'sample_brief' => trim($input['sample_brief']),
            'sample_content' => trim($input['sample_content']),
            'publish_time' => strtotime($input['publish_time']),
            'status' => intval($input['status']),
            'sample_type' => intval($input['sample_type']),
            'province_id' => $input['province_id'],
            'city_id' => $input['city_id'],
            'sample_tags' => $sample_tags,

            'doc_name' => trim($input['doc_name']),
            'doc_size' => trim($input['doc_size']),
            'doc_ext' => trim($input['doc_ext']),
            'doc_path' => trim($input['doc_path']),
        );

        //图片
        $image_path = $input['image_path'];
        if(!empty($image_path)){
            $sample_data = array_merge($sample_data,array('image_path'=>$image_path));
        }

        if($sample_id==-1){
            $sample_data = array_merge($sample_data,array('create_time' => time()));
        }

        if($sample_id==-1){//编辑
            $sample_data['sample_id'] = getUuid();
            $result = SampleModel::create($sample_data);
        }else{
            $result = SampleModel::updateRecordORM($sample_id,$sample_data);
        }

        if($result){
            $refer = $input['url'];
            $refer = urlsafe_b64encode($refer);
            $msg = ($sample_id==-1) ? 'msg_add' : 'msg_edit';
            return redirect("admincp/message/$msg/1/$refer");

        }else{
            return back()->withErrors("操作失败");
        }
    }

    /**
     * 删除
     */
    public function delete($sample_id=-1){
        if(empty($sample_id)) abort(404);

        SampleModel::deleteRecordORM($sample_id);
        $msg = 'msg_delete';
        $time = 1;

        $referer =  empty($_SERVER['HTTP_REFERER'])?url('admincp/sample/list'):$_SERVER['HTTP_REFERER'];
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

        $sample_id = $input['sample_id'];
        $where = [
            'sample_id' => ['!='=>$sample_id],
            'sample_name' => $input['sample_name']
        ];
        $nameCount = SampleModel::getRecordCountCondition($where);

        if($nameCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }

    /**
     * 查看
     */
    public function view($sample_id = -1){
  		self::$view_data['page_title'] = "查看样例";
  		self::$view_data['url'] = (($sample_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/sample/list'):$_SERVER['HTTP_REFERER'];

  		$sample_data = SampleModel::find($sample_id);
  		if(empty($sample_data)){
  		    abort(404);
  		}
  		self::$view_data['sample_data'] = $sample_data;

  		return view('admin.sample.view',self::$view_data);
    }

    /**
     * 导出excel
     */
    public function export(Request $request){
        $input = $request->all();
        foreach ($input as $k=>$v){
            $input[$k] = trim($v);
        }

        $condition = array();

        $result_data = $this->getParamAndList($input,$condition,0,0);
        $sample_list = $result_data['record_list'];

  		$data = array(array('ID', '样例名称','创建时间'));
  		foreach ($sample_list as $value){
  		    $temp = array($value['sample_id'],$value['sample_name'],date("Y-m-d H:i:s",$value['create_time']));
  		    $data[] = $temp;
  		}

  		\Excel::create('sample_list',function($excel) use ($data){
  		    $excel->sheet('sheet1', function($sheet) use ($data){
  		        $sheet->rows($data);
  		    });
  		})->export('xls');
    }

    /**
     * 导入excel
     */
    public function import(){
        self::$view_data['page_title'] = "导入数据";
        self::$view_data['url'] = (empty($_SERVER['HTTP_REFERER'])) ? url('admincp/sample/import'):$_SERVER['HTTP_REFERER'];
        return view('admin.sample.import',self::$view_data);
    }

    /**
     * 导入excel-存入数据
     */
    public function exportSave(Request $request){
        $excel = $request->file('import_doc');
        $reader = \Excel::load($excel)->get();
        $data_list = $reader->toArray();
        $data_sheet1 = $data_list[0];
        foreach ($data_sheet1 as $k => $v) {
            $sample_data = array(
                'sample_name' => $v[0],
                'sample_brief' => $v[1],
                'sample_content' => $v[2]
            );
            SampleModel::create($sample_data);
        }
        return redirect("admincp/sample/list");
    }

    /**
     * ajax上传文档
     */
    public function uploadDoc(Request $request){
        $file = $request->file('sample_doc');
        $allowtype = array('jpg','gif','png','txt');
        $file_ext = $file->getClientOriginalExtension();
        $origin_file_name = $file->getClientOriginalName();
        $result_content = array();
        if(in_array($file_ext,$allowtype)){
            $yn_upload =  new CustomUpload();
            $doc_array = $yn_upload->file_save($file,$allowtype);
            if ($doc_array['status'] == 'success')
            {
                $result_content['status'] = 'success';
                $result_content['doc_name'] = $origin_file_name;
                $result_content['doc_size'] = $doc_array['size'];
                $result_content['doc_ext'] = $doc_array['ext'];
                $result_content['doc_path'] = $doc_array['path'];
            }else{
                $result_content['status'] = 'failed';
                $result_content['msg'] = $doc_array['path'];
            }
        }else{
            $result_content['status'] = "failed";
            $result_content['msg'] = "不允许上传该格式的文件";
        }
        echo json_encode($result_content);
    }

    /**
     * 删除文档
     */
    public function removeDoc(Request $request){
        $input = $request->all();
        foreach ($input as $k=>$v){
            $input[$k] = trim($v);
        }

        $sample_id = $input['sample_id'];
        $field = $input['field'];

        if(empty($sample_id)){
            return json_encode(['code'=>'no_exist']);
        }
        if($sample_id > 0){
            $clear_data = array();
            if($field=='doc_path'){
                $clear_data['doc_name'] = '';
                $clear_data['doc_size'] = '0';
                $clear_data['doc_ext'] = '';
                $clear_data['doc_path'] = '';
            }

            $sample_data = SampleModel::find($sample_id);
            @unlink('./'.$sample_data[$field]);//删除

            $clear_data[$field] = '';
            $result = SampleModel::updateRecordORM($sample_id,$clear_data);
            return json_encode(['code'=>'success']);
        }else{
            $field_path = $input['field_path'];
            @unlink('./'.$field_path);//删除
            return json_encode(['code'=>'success']);
        }
    }

    /**
     * 设置
     */
    public function set($sample_id = -1){
        self::$view_data['page_title'] = "设置数据";

        $sample_data = SampleModel::find($sample_id);
        if(empty($sample_data)){
            abort(404);
        }
        self::$view_data['sample_data'] = $sample_data;
        self::$view_data['sample_data']['sample_tags'] = explode('|', $sample_data['sample_tags']);

        return view('admin.sample.set',self::$view_data);
    }

    /**
     * 设置-保存
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setSave(Request $request)
    {
        $input = $request->all();

        $sample_id = $input['sample_id'];

        //复选框
        $sample_tags_arr = ($input['sample_tags'] == '') ? array() : $input['sample_tags'];
        $sample_tags = '|'.implode("|", $sample_tags_arr).'|';

        $sample_data = array(
            'sample_name' => trim($input['sample_name']),
            'sample_type' => intval($input['sample_type']),
            'publish_time' => strtotime($input['publish_time']),
            'sample_tags' => $sample_tags,
            'sample_brief' => trim($input['sample_brief']),
            'status' => intval($input['status']),
        );

        $result = SampleModel::updateRecordORM($sample_id,$sample_data);

        $data = ['code'=>1,"msg"=>'操作成功'];
        echo  json_encode($data);die;
    }

    /**
     * 弹出列表
     */
    public function popList($sample_id = -1){
        self::$view_data['page_title'] = "查看样例";
        self::$view_data['url'] = (($sample_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/sample/list'):$_SERVER['HTTP_REFERER'];

        return view('admin.sample.pop_list',self::$view_data);
    }

    /**
     * 查看详情
     */
    public function viewDetail($sample_id = -1){
        self::$view_data['page_title'] = "查看详情";
        self::$view_data['url'] = (($sample_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/sample/list'):$_SERVER['HTTP_REFERER'];

        self::$view_data['solt'] = $this->getSlot($sample_id,'view_detail');

        return view('admin.sample.view_detail',self::$view_data);
    }

    /**
     * 查看详情01
     */
    public function viewDetail01($sample_id = -1){
        self::$view_data['page_title'] = "查看详情";
        self::$view_data['url'] = (($sample_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/sample/list'):$_SERVER['HTTP_REFERER'];

        self::$view_data['solt'] = $this->getSlot($sample_id,'view_detail_01');

        return view('admin.sample.view_detail01',self::$view_data);
    }

    /**
     * 公共用法
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function common(Request $request)
    {
        self::$view_data['page_title'] = "公共样例";

        //获取组织架构列表
        $organization_list =  CommonBusiness::getOrganizationList(session("staff_id"));
        self::$view_data['organization_list'] = $organization_list;

        //获取城市列表
        $city_list =  CommonBusiness::getCityList(session("staff_id"));
        self::$view_data['city_list'] = $city_list;

        //获取员工列表
        $staff_list = CommonBusiness::getStaffList(session('staff_id'));
        self::$view_data['staff_list'] = $staff_list;

        return view('admin.sample.common',self::$view_data);
    }

    /**
     * 获取查询条件和列表
     * @param array $input 请求参数
     * @param array $condition 查询条件
     * @param $page 页码
     * @param $pageSize 每页条数
     * @return array
     */
    public function getParamAndList($input = [],&$condition,$page,$pageSize)
    {
        $record_list = [];

        $page_param = [];
        $page_param['page'] = $page;
        $page_param['page_size'] = $pageSize;

        $condition['delete_flag'] = 1;

        //组织查询条件
        if(!empty($input['sample_name'])){
            self::$view_data['sample_name'] = $input['sample_name'];
            $page_param['sample_name'] = $input['sample_name'];
            $condition['sample_name'] = ['like'=> $input['sample_name']];
        }

        if(isset($input['status']) && $input['status']!=''){
            self::$view_data['status'] = $input['status'];
            $page_param['status'] = $input['status'];
            $condition['status'] = $input['status'];
        }

        $begin_publish_time = 0;
        $end_publish_time = 0;
        if(!empty($input['begin_publish_time'])){
            $begin_publish_time = strtotime($input['begin_publish_time']);
            self::$view_data['begin_publish_time'] = $begin_publish_time;
            $page_param['begin_publish_time'] = $input['begin_publish_time'];
        }
        if(!empty($input['end_publish_time'])){
            $end_publish_time = strtotime($input['end_publish_time']);
            self::$view_data['end_publish_time'] = $end_publish_time;
            $page_param['end_publish_time'] = $input['end_publish_time'];
        }
        if($begin_publish_time > 0 && $end_publish_time ==0){
            $condition['publish_time'] = ['>='=> $begin_publish_time];
        }
        if($end_publish_time > 0 && $begin_publish_time ==0){
            $condition['publish_time'] = ['<='=> $end_publish_time+86400-1];//必须要加86400，否则截止时间当天查不到
        }
        if($begin_publish_time > 0 && $end_publish_time >0){
            $condition['publish_time'] = ['between'=> [$begin_publish_time,$end_publish_time+86400-1]];//必须要加86400，否则截止时间当天查不到
        }

        $order_by = ['display_order'=>'asc'];
        $record_list = SampleModel::getRecordListCondition($condition,['*'],$order_by,$page,$pageSize);

        return [$page_param, $record_list];
    }

    private function getSlot($sample_id,$flag)
    {
        $select = ' class="layui-this" ';
        $slot_html = '<a href="'.url('admincp/sample/view_detail/'.$sample_id).'"><li '.($flag=='view_detail'?$select:'').'>会员信息</li></a>
                            <a href="'.url('admincp/sample/view_detail_01/'.$sample_id).'"><li '.($flag=='view_detail_01'?$select:'').'>订单信息</li></a>
                            <li>实名认证记录</li>
                            <li>押金记录</li>
                            <li>优惠券记录</li>
                            <li>余额明细</li>
                            <li>冻结记录</li>
                            <li>蜜钱儿明细</li>';
        return $slot_html;
    }
}