<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/test', 'Admin\TestController@index');

Route::resource('/admincp/login', 'Admin\LoginController');
Route::get('/admincp/get_captcha', 'Admin\LoginController@getCaptcha');
Route::get('/admincp/logout', 'Admin\LoginController@logout');
Route::get('/admincp/message/{message}/{second}/{url_forward}', 'Admin\CommonController@message');
Route::get('/admincp/home', 'Admin\CommonController@home');
Route::get('/admincp/welcome', 'Admin\CommonController@welcome');
Route::get('/admincp', function () {
    return redirect('admincp/login');
});

//ajaxcommon
Route::post('/admincp/ajaxcommon/get_city_option', 'Admin\AjaxcommonController@getCityOption');

//ajax上传图片
Route::get('/admincp/ajaxupload/popup_image', 'Admin\AjaxuploadController@popup_mage');
Route::post('/admincp/ajaxupload/upload_image', 'Admin\AjaxuploadController@upload_image');
Route::post('/admincp/ajaxupload/delete_image', 'Admin\AjaxuploadController@delete_image');
Route::post('/admincp/ajaxupload/save_image', 'Admin\AjaxuploadController@save_image');
Route::post('/admincp/ajaxupload/zoom_image', 'Admin\AjaxuploadController@zoom_image');

Route::group(['middleware' => 'CheckMiddleware'], function () {
    //修改密码
    Route::resource('/admincp/updatepassword', 'Admin\UpdatepasswordController');

    //用户
    Route::get('/admincp/adminuser/delete/{admin_id}', 'Admin\AdminuserController@delete');
    Route::post('/admincp/adminuser/check_name', 'Admin\AdminuserController@checkName');
    Route::resource('/admincp/adminuser', 'Admin\AdminuserController');

    //角色
    Route::get('/admincp/role/delete/{role_id}', 'Admin\RoleController@delete');
    Route::post('/admincp/role/check_name', 'Admin\RoleController@checkName');
    Route::resource('/admincp/role', 'Admin\RoleController');

    //权限
    Route::get('/admincp/permission/delete/{permission_id}', 'Admin\PermissionController@delete');
    Route::post('/admincp/permission/check_name', 'Admin\PermissionController@checkName');
    Route::post('/admincp/permission/check_key', 'Admin\PermissionController@checkKey');
    Route::resource('/admincp/permission', 'Admin\PermissionController');

    //网站设置
    Route::resource('/admincp/configsite', 'Admin\ConfigsiteController');

    //样例
    Route::get('/admincp/sample/delete/{sample_id}', 'Admin\SampleController@delete');
    Route::get('/admincp/sample/view/{sample_id}', 'Admin\SampleController@view');
    Route::post('/admincp/sample/check_name', 'Admin\SampleController@checkName');
    Route::get('/admincp/sample/import', 'Admin\SampleController@import');
    Route::get('/admincp/sample/export', 'Admin\SampleController@export');
    Route::post('/admincp/sample/export_save', 'Admin\SampleController@exportSave');
    Route::post('/admincp/sample/upload_doc', 'Admin\SampleController@uploadDoc');
    Route::post('/admincp/sample/remove_doc', 'Admin\SampleController@removeDoc');
    Route::get('/admincp/sample/common', 'Admin\SampleController@common');
    Route::resource('/admincp/sample', 'Admin\SampleController');
    Route::get('/admincp/sample/set/{sample_id}', 'Admin\SampleController@set');
    Route::post('/admincp/sample/set_save', 'Admin\SampleController@setSave');
    Route::get('/admincp/sample/pop_list/{sample_id}', 'Admin\SampleController@popList');
    Route::get('/admincp/sample/view_detail/{sample_id}', 'Admin\SampleController@viewDetail');
    Route::get('/admincp/sample/view_detail_01/{sample_id}', 'Admin\SampleController@viewDetail01');
});

