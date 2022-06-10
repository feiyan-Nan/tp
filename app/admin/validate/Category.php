<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 17:33
 */

namespace app\admin\validate;

use think\Validate;

class Category extends Validate {
    protected $rule = [
        'name'  =>  'require',
        'pid' =>  'require',
    ];

    protected $message = [
        'name'  =>  '分类名称必须',
        'pid' =>  '父类ID必须',
    ];
}