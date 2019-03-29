<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\PermissionModel;

class PermissionController extends Controller
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
        if($flag=='list'){
            $page_title = '权限列表';
        }else{
            abort(404);
        }
        
        self::$view_data['page_title'] = $page_title;
        self::$view_data['flag'] = $flag;

        $permission_flag = $request->input('permission_flag', 1);
        if(!empty($permission_flag)){
            self::$view_data['permission_flag'] = $permission_flag;
        }
        
        self::$view_data['permission_list'] = PermissionModel::getPermissionTreeList($permission_flag);//权限菜单
        
        return view('admin.permission.show', self::$view_data);
    }
    
    /**
     * 增加/编辑
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($permission_id,Request $request)
    {
        if(empty($permission_id)){
            abort(404);
        }
        
        self::$view_data['page_title'] = ($permission_id == -1) ? '添加权限' : '编辑权限';
        self::$view_data['url'] = (($permission_id==-1) || empty($_SERVER['HTTP_REFERER'])) ? url('admincp/permission/list'):$_SERVER['HTTP_REFERER'];

        $permission_flag = -1;

        if($permission_id!=-1){//编辑
            $permission_data = PermissionModel::find($permission_id);
            if(empty($permission_data)){
                abort(404);
            }
            $permission_flag = $permission_data['permission_flag'];
            self::$view_data['permission_data'] = $permission_data;
        }

        self::$view_data['permission_list'] = PermissionModel::getPermissionTreeList($permission_flag);//权限菜单
        return view('admin.permission.edit',self::$view_data);
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
        $rules = ['permission_name' => 'required'];
        $messages = ['required' => '权限名称不能为空'];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
    
        $permission_id = $input['permission_id'];
        
        $parent_id = $input['parent_id'];
        /*
        if(!empty($parent_id)){
            $parent_data = PermissionModel::findRecordOneCondition(['permission_id' => $parent_id]);
            if($parent_data['parent_id']){
                $refer = urlsafe_b64encode($input['url']);
                $msg = 'msg_permission_parent';
                $time = -1;
                return redirect("admincp/message/$msg/$time/$refer");
            }
        }
        */
        
        $permission_data = array(
            'permission_name' => $input['permission_name'],
            'parent_id' => (empty($parent_id)) ? '' : $parent_id,
            'permission_url' => $input['permission_url'],
            'permission_flag' => $input['permission_flag'],
            'permission_type' => $input['permission_type'],
            'permission_key' => $input['permission_key'],
            'display_order' => intval($input['display_order'])
        );
        if($permission_id==-1){
            $permission_data['permission_id'] = getUuid();
            $result = PermissionModel::create($permission_data);
        }else{
            $result = PermissionModel::updateRecordORM($permission_id,$permission_data);
        }
    
        if($result){
            $refer = $input['url'];
            $refer = urlsafe_b64encode($refer);
            $msg = ($permission_id==-1) ? 'msg_add' : 'msg_edit';
            return redirect("admincp/message/$msg/1/$refer");
            
        }else{
            return back()->withErrors("操作失败");
        }
    }
    
    /**
     * 删除
     */
    public function delete($permission_id=-1){
        if(empty($permission_id)) abort(404);
    
        $condition = ["parent_id" => $permission_id];
        $num = PermissionModel::getRecordCountCondition($condition);
        if ($num > 0){
            $msg = 'permission_delete';
            $time = -1;
        } else {
            PermissionModel::deleteRecordORM($permission_id);
            $msg = 'msg_delete';
            $time = 1;
        }
    
        $referer =  empty($_SERVER['HTTP_REFERER'])?url('admincp/permission/list'):$_SERVER['HTTP_REFERER'];
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

        $permission_id = $input['permission_id'];
        $where = [
            'permission_id' => ['!='=>$permission_id],
            'permission_name' => $input['permission_name']
        ];
        $nameCount = PermissionModel::getRecordCountCondition($where);

        if($nameCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }
    
    /**
     * ajax检查关键字是否存在
     * @param Request $request
     */
    public function checkKey(Request $request)
    {
        $input = $request->all();
        foreach ($input as $k=>$v){
            $input[$k] = trim($v);
        }

        $permission_id = $input['permission_id'];
        $where = [
            'permission_id' => ['!='=>$permission_id],
            'permission_key' => $input['permission_key'],
            'permission_type' => 1
        ];
        $keyCount = PermissionModel::getRecordCountCondition($where);

        if($keyCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }
}