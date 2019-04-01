<?php

namespace App\Common;

class CustomUpload
{
    //产生随机字符
    public function random($length, $numeric = 0) {
        PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
        $seed = base_convert(md5(print_r($_SERVER, 1).microtime()), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
        $hash = '';
        $max = strlen($seed) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $seed[mt_rand(0, $max)];
        }
        return $hash;
    }
    
    /**
     * 获取文件名后缀
     * @param $filename
     * @return string
     */
    public function fileext($filename) {
        return strtolower(trim(substr(strrchr($filename, '.'), 1)));
    }
    
    /**
     * 功能：循环检测并创建文件夹
     * 参数：$path 文件夹路径
     * 返回：
     */
    function createDir($path){
        if (!file_exists($path)){
            $this->createDir(dirname($path));
            @mkdir($path, 0777);
        }
    }
    
    //获取上传路径
    function getfilepath($custom_path, $mkdir=false) {
        $name1 = gmdate('Ym');
        $name2 = gmdate('j');
    
        if($custom_path){
            $newfilename = './uploads/'.$custom_path;
            $this->createDir($newfilename);
            return $custom_path;
        }else{
            if($mkdir) {
                $newfilename = './uploads/'.$name1;
                if(!is_dir($newfilename)) {
                    if(!@mkdir($newfilename,0777)) {
                        return 'error';
                    }
                }
                $newfilename .= '/'.$name2;
                if(!is_dir($newfilename)) {
                    if(!@mkdir($newfilename,0777)) {
                        return 'error';
                    }
                }
            }
            return $name1.'/'.$name2;
        }
    }
    
    /**
     * 返回可读性更好的文件尺寸
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);
    
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
    }
    
    /**
     * 上传文件
     * @param $FILE
     * @param $allowpictype 允许上传的文件类型
     * @param $resize_flag 是否缩放标记
     * @param $width 缩放的宽
     * @param $height 缩放的高
     * @return array
     */
    public function file_save($file,$allowpictype = array(),$custom_path=''){
        //检查文件大小
        $file_size = $file->getClientSize();
        if($file_size<=0){
            return array('status'=>'error','path'=>'无法获取上传文件大小');
        }
        
        //判断后缀
        $fileext = $file->getClientOriginalExtension();
        if(!in_array($fileext, $allowpictype)) {
            return array('status'=>'error','path'=>'不允许上传该格式的文件');
        }
    
        //获取目录
        $date_filepath = $this->getfilepath($custom_path, true);
        if($date_filepath=='error') {
            return array('status'=>'error','path'=>'创建目录失败');
        }
    
        //上传目录
        $filepath="./uploads/".$date_filepath;
        $filepath = rtrim($filepath, '/').'/';
        if (function_exists('realpath') AND @realpath($filepath) !== FALSE){
            $filepath = str_replace("\\", "/", realpath($filepath));
        }
        $filepath = preg_replace("/(.+?)\/*$/", "\\1/",  $filepath);
    
        //本地上传
        $mtime = explode(' ', microtime());
        $new_filename = "$mtime[1]".$this->random(4);
        $new_filename_all = "/".$new_filename.".$fileext";
        $result_path = "/uploads/".$date_filepath.$new_filename_all;
        $new_name = $filepath.$new_filename_all;
        $tmp_name = $file->getRealPath();
        if(@copy($tmp_name, $new_name)) {
            @unlink($tmp_name);
        } elseif((function_exists('move_uploaded_file') && @move_uploaded_file($tmp_name, $new_name))) {
        } elseif(@rename($tmp_name, $new_name)) {
        } else {
            return array('status'=>'error','path'=>'无法转移临时图片到服务器指定目录');
        }
    
        return array('status'=>'success','path'=>$result_path,'size'=>$file_size,'ext'=>$fileext,'name'=>$new_filename);
    }
}