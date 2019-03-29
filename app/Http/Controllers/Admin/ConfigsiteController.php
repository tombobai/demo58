<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\ConfigModel;

class ConfigsiteController extends Controller
{
    private static $view_data;
    
    /**
     * 网站设置
     * @param string $flag
     * @param Request $request
     * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
     */
    public function index(Request $request)
    {
        self::$view_data['page_title'] = '网站设置';
        self::$view_data['config_data'] = ConfigModel::getConfig();
        
        return view('admin.configsite', self::$view_data);
    }
    
    /**
     * 保存
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $form_data = $input['form'];
        foreach ($form_data as $key=>$value){
            ConfigModel::setConfig($key,trim($value));
        }
        return redirect('admincp/configsite');
    }
}