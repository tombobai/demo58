<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Common\CustomUpload;
//use Intervention\Image\Image;
use App\Common\Image_lib;

class AjaxuploadController extends Controller
{
    private static $view_data;
    
    /**
	 * 弹出图片上传裁切页面
	 */
	public function popup_mage(Request $request)
	{
	    $input = $request->all();
	    foreach ($input as $k=>$v){
	        $input[$k] = trim($v);
	    }
	    
	    self::$view_data['input'] = $input['id'];
	    self::$view_data['message'] = $input['message'];

	    return view('admin.upload.upload_popup_image',self::$view_data);
	}
	
	/**
	 * 保存图片
	 */
	public function save_image(Request $request)
	{
	    $input = $request->all();
	    foreach ($input as $k=>$v){
	        $input[$k] = trim($v);
	    }
	    
	    $x_axis = intval($input['selectorX']);
	    $y_axis = intval($input['selectorY']);
	    $width = intval($input['selectorW']);
	    $height = intval($input['selectorH']);
	    $len = strlen(url(''));
	    $source_image = substr($input['imageSource'], $len, -14);//去年结尾的?xxx
	    $del_path = $input['del_path'];

	    if (($width != 0) && ($height != 0))
	    {

	        //\Image::make(url($source_image))->resize($width, $height);
	        //\Image::make(url($source_image))->resize(50, 50);
	        

            $image_lib = new Image_lib();
	        $config_image['image_library'] = 'gd2';
	        $config_image['source_image'] = '.'.$source_image;
	
	        //裁切图片
	        $config_image['width'] = $width;
	        $config_image['height'] = $height;
	        $config_image['x_axis'] = $x_axis;
	        $config_image['y_axis'] = $y_axis;
	        $config_image['maintain_ratio'] = FALSE;
	        $image_lib->initialize($config_image);
	        $image_lib->crop();

	    }
	
	    @unlink('.'.$del_path);
	
	    echo 1;
	}
	
	/**
	 * 上传图片
	 */
	public function upload_image(Request $request)
	{
	    $file = $request->file('file');
	    $allowpictype = array('jpg','gif','png');
	    $yn_upload =  new CustomUpload();
	    $image_path_array = $yn_upload->file_save($file,$allowpictype);
	    if ($image_path_array['status'] == 'success')
	    {
	        $img_info = getimagesize('.'.$image_path_array['path']);
	        $w_h_array = explode('"', $img_info[3]);
	
	        $width = $w_h_array[1];
	        $height = $w_h_array[3];
	        $image_path_array['primitive_width'] = $width;
	        $image_path_array['primitive_height'] = $height;
	
	        $array = $this->_compute_size($width, $height, 400);
	
	        $image_path_array = array_merge($image_path_array, $array);
	    }
	    echo  json_encode($image_path_array);
	}
	
	/**
	 * 缩放图片
	 */
	public function zoom_image(Request $request)
	{
	    $input = $request->all();
	    foreach ($input as $k=>$v){
	        $input[$k] = trim($v);
	    }
	    
	    $width = $input['width'];
	    $height = $input['height'];
	    $src = $input['src'];
	    $new_path = substr($src, 0, stripos($src, "."))."_thumb.png";
	
	    //Image::make($new_path)->resize($width, $height);
	    
	    $image_lib = new Image_lib();
 	    $config_image['image_library'] = 'gd2';
 	    $config_image['source_image'] = '.'.$src;
 	    $config_image['new_image'] = '.'.$new_path;//缩略图路径
 	    $config_image['width'] = $width;
 	    $config_image['height'] = $height;
 	    $config_image['maintain_ratio'] = TRUE;
 	    $config_image['master_dim'] = 'auto';;
 	    $image_lib->initialize($config_image);
        $image_lib->resize();
	
	    $array = $this->_compute_size($width, $height, 500);
	    $array['path'] = $new_path;
	
	    echo json_encode($array);
	}
	
	/**
	 * 删除已上传图片
	 */
	public function delete_image(Request $request)
	{
	    $len = strlen(url(''));
	    $post_path = substr($request->input('imageSource'), $len, -14);//去年结尾的?xxx
	    @unlink('.'.$post_path);
	}
	
	/**
	 * 计算图片尺寸
	 * @param $width 图片实际宽
	 * @param $height 图片实际高
	 * @param $size 显示图片宽高最大值
	 */
	protected function _compute_size($width, $height, $size)
	{
	    if (($width < $size) && ($height < $size))
	    {
	        $proportion = 1;
	    } elseif ($width > $height){
	        $proportion = $width / $size;
	        $height = round($height / $proportion);
	        $width = $size;
	    } elseif ($width < $height){
	        $proportion = $height / $size;
	        $width = round($width / $proportion);
	        $height = $size;
	    } else {
	        $proportion = $width / $size;
	        $width = $size;
	        $height = $size;
	    }
	    return array('width' => $width, 'height' => $height, 'proportion' => $proportion);
	}
}