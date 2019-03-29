<?php

namespace App\Http\Controllers\Admin;

use App\Common\CustomOrder;
use App\Model\OrganizationModel;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\AdminModel;
use App\Common\CustomPage;
use App\Models\RoleModel;

class AdminuserController extends Controller
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
        $condition_like = array();
        
        if($flag=='list'){
            $page_title = '管理员列表';
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
        if(!empty($input['admin_name'])){
            self::$view_data['admin_name'] = $input['admin_name'];
            $page_param['admin_name'] = $input['admin_name'];
            $condition_like['a.admin_name'] = $input['admin_name'];
        }
        
        if(!empty($input['telephone'])){
            self::$view_data['telephone'] = $input['telephone'];
            $page_param['telephone'] = $input['telephone'];
            $condition_like['a.telephone'] = $input['telephone'];
        }

        //组织分页
        $recordCount = AdminModel::getRecordJoinCount($condition,$condition_like);//总记录数
        $countPage = ceil($recordCount / $pageSize);//总页数
        $pageView = CustomPage::getSelfPageView($page, $countPage, 'admincp/adminuser/list', $page_param);//分页视图
        self::$view_data['page_view'] = $pageView;

        $recordList = AdminModel::getRecordJoinList($condition,$condition_like,$page,$pageSize);
        self::$view_data['record_count'] = $recordCount;
        self::$view_data['admin_list'] = $recordList;

        return view('admin.admin.show', self::$view_data);
    }

    /**
     * 增加/编辑
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($admin_id,Request $request)
    {
        if(empty($admin_id)){
            abort(404);
        }

        self::$view_data['page_title'] = ($admin_id == -1) ? '添加管理员' : '编辑管理员';
        self::$view_data['url'] = (($admin_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/adminuser/list'):$_SERVER['HTTP_REFERER'];

        if($admin_id!=-1){//编辑
            $admin_data = AdminModel::find($admin_id);
            if(empty($admin_data)){
                abort(404);
            }
            self::$view_data['admin_data'] = $admin_data;
        }

        $order_by = ['role_id'=>'asc'];
        self::$view_data['role_list'] = RoleModel::getRecordListCondition(["role_id" => ['!='=>'']],['*'],$order_by,0,0);//角色列表

        return view('admin.admin.edit',self::$view_data);
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
        $rules = [
            'telephone' => 'required',
            'true_name' => 'required',
        ];
        $messages = ['required' => '管理员名称不能为空'];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $admin_id = $input['admin_id'];

        $current_pwd = '';
        if($admin_id!=-1) {//编辑保存
            $admin_current  = AdminModel::find($admin_id);
            if(empty($admin_current)){
                abort(404);
            }
            $current_pwd = $admin_current['password'];
        }

        $admin_data = array(
            'telephone' => $input['telephone'],
            'true_name' => $input['admin_name'],
            'role_id' => $input['role_id'],
        );
        
        $admin_password = $input['admin_password'];
        if ($current_pwd != $admin_password){
            $salt = ynf_random(6);
            $admin_data['password'] = md5($admin_password);
            $admin_data['salt'] = $salt;//以上产生6位随机数;
            $admin_data['true_password'] = md5(md5($admin_password).$salt);
        }

        if($admin_id==-1){//编辑
            $admin_data['admin_id'] = getUuid();
            $result = AdminModel::create($admin_data);
        }else{
            $result = AdminModel::updateRecordORM($admin_id,$admin_data);
        }
        if($result){
            $refer = $input['url'];
            $refer = urlsafe_b64encode($refer);
            $msg = ($admin_id==-1) ? 'msg_add' : 'msg_edit';
            return redirect("admincp/message/$msg/1/$refer");
            
        }else{
            return back()->withErrors("操作失败");
        }
    }
    
    /**
     * 删除
     */
    public function delete($admin_id = -1){
        if(empty($admin_id)) abort(404);

        AdminModel::deleteRecordORM($admin_id);
        $msg = 'msg_delete';
        $time = 1;

        $referer =  empty($_SERVER['HTTP_REFERER'])?url('admincp/adminuser/list'):$_SERVER['HTTP_REFERER'];
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
    
        $admin_id = $input['admin_id'];
        $where = [
            'admin_id' => ['!='=>$admin_id],
            'admin_name' => $input['admin_name']
        ];
        $nameCount = AdminModel::getRecordCountCondition($where);

        if($nameCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }
}