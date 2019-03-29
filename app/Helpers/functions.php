<?php

use Illuminate\Support\Str;

/**
 * 产生随机字符
 * @param $length 长度
 * @param $numeric 标识    0:字母和数字     1:只有数字
 */
function ynf_random($length, $numeric = 0)
{
    PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
    $seed = base_convert(md5(print_r($_SERVER, 1) . microtime()), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $seed[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 生成uuid
 * @return string
 */
function getUuid()
{
    return (string) Str::uuid();
}

/**
 * 安全的64编码
 * 解决出现左斜杠“/”问题
 * @param $string
 * @return mixed|string
 */
function urlsafe_b64encode($string)
{
    $data = base64_encode($string);
    $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
    return $data;
}

/**
 * 安全的64解码
 * 解决出现左斜杠“/”问题
 * @param $string
 * @return string
 */
function urlsafe_b64decode($string)
{
    $data = str_replace(array('-', '_'), array('+', '/'), $string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

/**
 * 加密
 * @param $str
 * @return string
 */
function ynf_encrypt($str)
{
    $key = '1yangnan20190327';   //16字节
    $iv = '1234561234567890';    //16字节
    $encrypted = openssl_encrypt($str, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $result_str = base64_encode($encrypted);
    return $result_str;
}

/**
 * 解密
 * @param $str
 * @return string
 */
function ynf_decrypt($str)
{
    $key = '1yangnan20190327';   //16字节
    $iv = '1234561234567890';    //16字节
    $result_str = openssl_decrypt(base64_decode($str), 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $result_str;
}