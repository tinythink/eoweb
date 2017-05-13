<?php
namespace app\admin\validate;

use think\Validate;

class Hero extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:50',
        'alpha_name'   => 'require|max:50',
        'thumb'   => 'require|max:300',
        'type' => 'require|number|between:1,6',
    ];

    protected $message  =   [
        'name.require' => '名字必须填写',
        'name.max'     => '最多50个字符',
        'alpha_name.max'     => '别称最大50个字符',
        'thumb.max'     => '最多300个字符',
        'type.require'   => '类型必须填写',
        'type.between'   => '[1,6]之间',
        'type.number'  => '必须是数字',
    ];
}