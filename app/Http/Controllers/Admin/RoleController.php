<?php

namespace App\Http\Controllers\Admin;

use App\Business\AuthenticateBusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\RoleModel;
use App\Common\CustomPage;
use App\Models\PermissionModel;
use App\Models\AdminModel;

class RoleController extends Controller
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
            $page_title = '角色列表';
            $condition['role_id'] = ['!='=>''];
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
        if(!empty($input['role_name'])){
            self::$view_data['role_name'] = $input['role_name'];
            $page_param['role_name'] = $input['role_name'];
            $condition['role_name'] = ['like'=> $input['role_name']];
        }
    
        //组织分页
        $recordCount = RoleModel::getRecordCountCondition($condition);//总记录数
        $countPage = ceil($recordCount / $pageSize);//总页数
        $pageView = CustomPage::getSelfPageView($page, $countPage, 'admincp/role/list', $page_param);//分页视图
        self::$view_data['page_view'] = $pageView;

        $order_by = ['created_at'=>'asc'];
        $recordList = RoleModel::getRecordListCondition($condition,['*'],$order_by,$page,$pageSize);
        self::$view_data['record_count'] = $recordCount;
        self::$view_data['role_list'] = $recordList;

        self::$view_data['can'] = AuthenticateBusiness::hasPermission('add|edit|delete');
 
        return view('admin.role.show', self::$view_data);
    }
    
    /**
     * 增加/编辑
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role_id,Request $request)
    {
        if(empty($role_id)){
            abort(404);
        }
        
        self::$view_data['page_title'] = ($role_id == -1) ? '添加角色' : '编辑角色';
        self::$view_data['url'] = (($role_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/role/list'):$_SERVER['HTTP_REFERER'];
        
        self::$view_data['role_data']['permission_ids'] = array();
        
        $role_data = [];
        if($role_id!=-1){//编辑
            $role_data = RoleModel::find($role_id);
            if(empty($role_data)){
                abort(404);
            }
            self::$view_data['role_data'] = $role_data;
            self::$view_data['role_data']['permission_ids'] = explode('|', $role_data['permission_ids']);
        }

        self::$view_data['permission_list'] = PermissionModel::getPermissionParentChildrenList('admin');//权限菜单
        self::$view_data['admin_permission_list'] = PermissionModel::getPermissionTreeList(1);//后台权限菜单
        return view('admin.role.edit',self::$view_data);
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
        $rules = ['role_name' => 'required'];
        $messages = ['required' => '角色名称不能为空'];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
    
        $role_id = $input['role_id'];
        
        $permission_ids = ($input['permission_ids'] == '') ? array() : $input['permission_ids'];
        $permission_ids = '|'.implode("|", $permission_ids).'|';
        $role_data = array(
            'role_name' => $input['role_name'],
            'role_brief' => empty($input['role_brief'])?'':$input['role_brief'],
            'permission_ids' => $permission_ids
        );

        if($role_id==-1){//编辑
            $role_data['role_id'] = getUuid();
            $result = RoleModel::create($role_data);
        }else{
            $result = RoleModel::updateRecordORM($role_id,$role_data);
        }
    
        if($result){
            $refer = $input['url'];
            $refer = urlsafe_b64encode($refer);
            $msg = ($role_id==-1) ? 'msg_add' : 'msg_edit';
            return redirect("admincp/message/$msg/1/$refer");
            
        }else{
            return back()->withErrors("操作失败");
        }
    }
    
    /**
     * 删除
     */
    public function delete($role_id=-1){
        if(empty($role_id)) abort(404);
    
        $condition = array("a.role_id" => $role_id);
        $condition_like = array();
        $num = AdminModel::getRecordJoinCount($condition,$condition_like);
        if ($num > 0){
            $msg = 'role_delete';
            $time = -1;
        } else {
            RoleModel::deleteRecordORM($role_id);
            $msg = 'msg_delete';
            $time = 1;
        }
    
        $referer =  empty($_SERVER['HTTP_REFERER'])?url('admincp/role/list'):$_SERVER['HTTP_REFERER'];
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
    
        $role_id = $input['role_id'];
        $where = [
            'role_id' => ['!='=>$role_id],
            'role_name' => $input['role_name']
        ];
        $nameCount = RoleModel::getRecordCountCondition($where);

        if($nameCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }
}