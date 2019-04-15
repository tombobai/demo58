<?php

use Ramsey\Uuid\Uuid;

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
    $temp = Uuid::uuid1();
    return $temp->getHex();
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

/**
 * 字符转小写_
 * @param $utf8_string
 * @return mixed|string
 */
function strtolower_extended( $utf8_string )
{
    $additional_replacements    = array
    ( "ǅ"    => "ǆ"        //   453 ->   454
    , "ǈ"    => "ǉ"        //   456 ->   457
    , "ǋ"    => "ǌ"        //   459 ->   460
    , "ǲ"    => "ǳ"        //   498 ->   499
    , "Ϸ"    => "ϸ"        //  1015 ->  1016
    , "Ϲ"    => "ϲ"        //  1017 ->  1010
    , "Ϻ"    => "ϻ"        //  1018 ->  1019
    , "ᾈ"    => "ᾀ"        //  8072 ->  8064
    , "ᾉ"    => "ᾁ"        //  8073 ->  8065
    , "ᾊ"    => "ᾂ"        //  8074 ->  8066
    , "ᾋ"    => "ᾃ"        //  8075 ->  8067
    , "ᾌ"    => "ᾄ"        //  8076 ->  8068
    , "ᾍ"    => "ᾅ"        //  8077 ->  8069
    , "ᾎ"    => "ᾆ"        //  8078 ->  8070
    , "ᾏ"    => "ᾇ"        //  8079 ->  8071
    , "ᾘ"    => "ᾐ"        //  8088 ->  8080
    , "ᾙ"    => "ᾑ"        //  8089 ->  8081
    , "ᾚ"    => "ᾒ"        //  8090 ->  8082
    , "ᾛ"    => "ᾓ"        //  8091 ->  8083
    , "ᾜ"    => "ᾔ"        //  8092 ->  8084
    , "ᾝ"    => "ᾕ"        //  8093 ->  8085
    , "ᾞ"    => "ᾖ"        //  8094 ->  8086
    , "ᾟ"    => "ᾗ"        //  8095 ->  8087
    , "ᾨ"    => "ᾠ"        //  8104 ->  8096
    , "ᾩ"    => "ᾡ"        //  8105 ->  8097
    , "ᾪ"    => "ᾢ"        //  8106 ->  8098
    , "ᾫ"    => "ᾣ"        //  8107 ->  8099
    , "ᾬ"    => "ᾤ"        //  8108 ->  8100
    , "ᾭ"    => "ᾥ"        //  8109 ->  8101
    , "ᾮ"    => "ᾦ"        //  8110 ->  8102
    , "ᾯ"    => "ᾧ"        //  8111 ->  8103
    , "ᾼ"    => "ᾳ"        //  8124 ->  8115
    , "ῌ"    => "ῃ"        //  8140 ->  8131
    , "ῼ"    => "ῳ"        //  8188 ->  8179
    , "Ⅰ"    => "ⅰ"        //  8544 ->  8560
    , "Ⅱ"    => "ⅱ"        //  8545 ->  8561
    , "Ⅲ"    => "ⅲ"        //  8546 ->  8562
    , "Ⅳ"    => "ⅳ"        //  8547 ->  8563
    , "Ⅴ"    => "ⅴ"        //  8548 ->  8564
    , "Ⅵ"    => "ⅵ"        //  8549 ->  8565
    , "Ⅶ"    => "ⅶ"        //  8550 ->  8566
    , "Ⅷ"    => "ⅷ"        //  8551 ->  8567
    , "Ⅸ"    => "ⅸ"        //  8552 ->  8568
    , "Ⅹ"    => "ⅹ"        //  8553 ->  8569
    , "Ⅺ"    => "ⅺ"        //  8554 ->  8570
    , "Ⅻ"    => "ⅻ"        //  8555 ->  8571
    , "Ⅼ"    => "ⅼ"        //  8556 ->  8572
    , "Ⅽ"    => "ⅽ"        //  8557 ->  8573
    , "Ⅾ"    => "ⅾ"        //  8558 ->  8574
    , "Ⅿ"    => "ⅿ"        //  8559 ->  8575
    , "Ⓐ"    => "ⓐ"        //  9398 ->  9424
    , "Ⓑ"    => "ⓑ"        //  9399 ->  9425
    , "Ⓒ"    => "ⓒ"        //  9400 ->  9426
    , "Ⓓ"    => "ⓓ"        //  9401 ->  9427
    , "Ⓔ"    => "ⓔ"        //  9402 ->  9428
    , "Ⓕ"    => "ⓕ"        //  9403 ->  9429
    , "Ⓖ"    => "ⓖ"        //  9404 ->  9430
    , "Ⓗ"    => "ⓗ"        //  9405 ->  9431
    , "Ⓘ"    => "ⓘ"        //  9406 ->  9432
    , "Ⓙ"    => "ⓙ"        //  9407 ->  9433
    , "Ⓚ"    => "ⓚ"        //  9408 ->  9434
    , "Ⓛ"    => "ⓛ"        //  9409 ->  9435
    , "Ⓜ"    => "ⓜ"        //  9410 ->  9436
    , "Ⓝ"    => "ⓝ"        //  9411 ->  9437
    , "Ⓞ"    => "ⓞ"        //  9412 ->  9438
    , "Ⓟ"    => "ⓟ"        //  9413 ->  9439
    , "Ⓠ"    => "ⓠ"        //  9414 ->  9440
    , "Ⓡ"    => "ⓡ"        //  9415 ->  9441
    , "Ⓢ"    => "ⓢ"        //  9416 ->  9442
    , "Ⓣ"    => "ⓣ"        //  9417 ->  9443
    , "Ⓤ"    => "ⓤ"        //  9418 ->  9444
    , "Ⓥ"    => "ⓥ"        //  9419 ->  9445
    , "Ⓦ"    => "ⓦ"        //  9420 ->  9446
    , "Ⓧ"    => "ⓧ"        //  9421 ->  9447
    , "Ⓨ"    => "ⓨ"        //  9422 ->  9448
    , "Ⓩ"    => "ⓩ"        //  9423 ->  9449
        //, "𐐦"    => "𐑎"       // 66598 -> 66638
        //,"𐐧"    => "𐑏"      // 66599 -> 66639
    );

    $utf8_string    = strtolower($utf8_string);//mb_strtolower( $utf8_string, "UTF-8");

    $utf8_string    = strtr( $utf8_string, $additional_replacements );

    return $utf8_string;
}