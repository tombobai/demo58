<?php
namespace App\Common\Excel;

use Maatwebsite\Excel\Concerns\ToArray;

/**
 * 自定义Excel导入类
 * @package App\Library
 */
class CustomImportExcel implements ToArray
{
    /**
     * 读取上传的excel转化为数组-重新父类实现
     * @param array $array
     * @return array
     */
    public function array(array $array)
    {
        return $array;
    }
}