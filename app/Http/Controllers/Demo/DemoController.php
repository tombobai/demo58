<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;

use ZipArchive;

use App\Services\OSS;

use iscms\Alisms\SendsmsPusher as Sms;

class DemoController extends Controller
{
    private $_sms;
    function __construct()
    {
        $this->_sms = \App::make(Sms::class);
    }

    /**
     * 图片加水印
     */
    public function watermark()
    {
        //参考URL: http://blog.csdn.net/beyond__devil/article/details/62230610

        //画出一张图片
//        $img = Image::canvas(800, 600, '#ff0000');
//        return $img->response();//直接做为http响应

        //加水印
        $img = Image::make(public_path('uploads/default/watermark_sample.png'))
            ->resize(480, 400);//调整图像尺寸

        $img->text('姓名', 191, 148, function ($font) {
            $font->file('fonts/MSYH.TTF');//fonts/MSYH.TTF字体在public目录中必须存在
            $font->size(19);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
            $font->angle(0);
        });

        $img->save(public_path().'/uploads/watermark_demo.jpg');//保存图像到指定路径
        $img->destroy();//销毁图像

        echo 'Print watermakr success!';
    }

    /**
     * 压缩目录
     */
    public function zipdir()
    {
        $zip = new ZipArchive();
        $filePath = public_path('uploads/sample_zip');
        $zipBasePath = public_path('uploads/');
        $zipName = 'demozip';
        if ($zip->open($zipBasePath . $zipName . '.zip', ZipArchive::CREATE) === TRUE) {
            $this->addFileToZip($filePath, $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
            $zip->close(); //关闭处理的zip文件
        }

        echo 'Zip file success!';
    }

    //将目录下的文件加入压缩包
    private function addFileToZip($path, $zip)
    {
        $handler = opendir($path); //打开当前文件夹由$path指定。
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                if (is_dir($path . "/" . $filename)) {// 如果读取的某个对象是文件夹，则递归
                    $this->addFileToZip($path . "/" . $filename, $zip);
                } else { //将文件加入zip对象
                    $zip->addFile($path . "/" . $filename, $filename);
                }
            }
        }
        @closedir($path);
    }


    //生成pdf
    public function pdf()
    {
        //html生成pdf文件
        $data = [];
        $pdf = \PDF::loadView('welcome', $data);//直接加载welcome.blade.php文件
        return $pdf->download('welcome.pdf');//直接下载

//        $html = '<html><head><meta charset="utf-8"></head><h1>订单id</h1><h2>12346546</h2></html>';
//        $pdf = \PDF::loadHTML($html);
//        return $pdf->inline();//渲染页面(在浏览器中打开)

        /***********************************/

        //html生成图片
//        $data = [];
//        $img = \SnappyImage::loadView('welcome', $data);//直接加载welcome.blade.php文件
//        return $img->download('welcome.png');//直接下载

//        $html = '<html><head><meta charset="utf-8"></head><h1>订单id</h1><h2>12346546</h2></html>';
//        $img = \SnappyImage::loadHTML($html);
//        return $img->inline();//渲染页面(在浏览器中打开)

        echo 'Create pdf success!';
    }

    //阿里oss上传文件
    public function oss()
    {
        //上传文件
        $bucketName = env('ALIOSS_BUCKETNAME');
        $ossFileName = 'osetschina/machine/demo1.xlsx';
        $realFilePath = public_path('uploads/sample_import.xlsx');
        OSS::publicUpload($bucketName,$ossFileName, $realFilePath);

        echo 'Upload OSS file success!';
    }

    //发短信：阿里大于
    public function sms()
    {
        //****************
        //注意：构造函数中还有内容,不能直接new()
        //****************

        $num = '123456';
        // 短息内容
        $smsParams = [
            'code' => "{$num}",
            'product' => '【英语学习平台】'
        ];

        $phone = '15810169640';
        $name = '注册验证';//短信签名
        $content = json_encode($smsParams);
        $code = 'SMS_14721505';//短信模板编号

        $this->_sms->send($phone,$name, $content, $code);

        echo 'Send sms success!';
    }

    //redis demo
    public function redis()
    {
        $key = 'user:name:6';
        $user_name = "demo58";
        \Redis::set($key,$user_name);

        //判断指定键是否存在
        if(\Redis::exists($key)){
            //根据键名获取键值
            dd(\Redis::get($key));
            \Redis::del($key);
        }

        $key = 'key_ex';
        //\Redis::setex($key, 600, $value);//为指定的 key 设置值及其过期时间

        //各种操作参考https://www.cnblogs.com/wesky/p/10445780.html

        //集合操作
//        $key = 'key_set';
//        Redis::sAdd($key,'test');//存放到集合中
//        $nums = Redis::sCard($key);//获取集合元素总数(如果指定键不存在返回0)
//        edis::sRandMember($key,3);//从指定集合中随机获取三个

        //哈希
//        $key = 'key_hash';
//        \Redis::hmSet($key, $routeList);//用于设置指定字段各自的值，在存储于键的散列。
//        \Redis::hSet($key, $field);//设置散列中的单个键
//        \Redis::hGet($key, $field);
//        \Redis::hExists($key, $field);

//        $key = 'key_bit';
//        $offset = 5;//偏移量
//        \Redis::setBit($key,$offset,1);
//        \Redis::getBit($key,$offset);

        //\Redis::lPush($key,$value);//将一个或多个值插入到列表头部
        //\Redis::lRange($key,0,-1);//返回列表中指定区间内的元素，区间以偏移量 START 和 END 指定。
        //\Redis::lRem($key, 0, $value);//根据参数 COUNT 的值，移除列表中与参数 VALUE 相等的元素。
    }

    //生成二维码
    public function qrcode()
    {
        //参考URL：http://laravelacademy.org/post/2605.html
        //view中使用方法：{!! \QrCode::size(100)->generate(Request::url()) !!}
        echo \QrCode::size(200)->generate('http://www.baidu.com');
    }
}