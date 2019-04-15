<?php
namespace App\Common\Excel;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
 * 自定义Excel导出类
 * @package App\Library
 */
class CustomExportExcel implements FromArray,WithHeadings
{
    private $data = [];
    private $headings = [];

    public function __construct($data, $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    /**
     * 导出逻辑数据(数组格式)
     * @return Collection
     */
    public function array(): array
    {
        return $this->data;
    }

    /**
     * 首行标题
     * @return array
     */
    public function headings(): array
    {
        return $this->headings;
    }


    /**
     * 设置列格式
     * @return array
     */
//    public function columnFormats(): array
//    {
//        return [
//            'A' => NumberFormat::FORMAT_TEXT,
//        ];
//    }
}