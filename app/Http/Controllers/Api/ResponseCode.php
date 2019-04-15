<?php
namespace App\Http\Controllers\Api;

/**
 * 返回码定义
 */
class ResponseCode{
    // 成功
    const SUCCESS               = 1;
    const SYS_ERROR             = 0;

    // 系统级别错误 1001-1999
    const HTTP_ERROR            = 1000;
    const INVALID_URI           = 1001;  # 无效的请求地址
    const PARAM_ERROR           = 1002;  # 参数错误
    const MYSQL_INSERT_ERROR    = 1003;  # 数据库插入失败
    const MYSQL_UPDATE_ERROR    = 1004;  # 数据库更新失败
    const HEADER_ERROR          = 1005;  # header验证失败
    const SIGNATURE_LACK        = 1006;  # 签名参数缺失
    const SIGNATURE_ERROR       = 1007;  # 签名错误
    const TOKEN_LACK            = 1008;  # token参数缺失
    const TIME_LACK             = 1009;  # time参数缺失
    const STAFF_ERROR           = 1010;  # 用户不存在
    const HEADER_VERSION_ERROR  = 1012;  # 版本错误
    const TIME_NO_VALID          = 1013;  # 请求时间不合法
    const HEADER_LACK           = 1016;  # header参数缺失

    const BUSINESS_ERROR        = 2000;  #业务级错误
}
