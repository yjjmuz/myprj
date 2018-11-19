<?php
namespace app\admin\validate;

use think\Validate;

class Tag extends Validate
{
    protected $rule = [
        'tag_name'  => 'require',
        'tag_sort'  => 'require|number|between:1,9999'
    ];
    
    protected $message = [
        'tag_name.require'  =>'必须输入标签名',
        'tag_sort.require'  =>'必须输入排序值',
        'tag_sort.number'   =>'排序值必须为数字',
        'tag_sort.between'  =>'排序值必须为1-9999之间'
    ];
}