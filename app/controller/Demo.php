<?php

namespace app\controller;

use app\BaseController;
use app\Request;
use think\captcha\facade\Captcha;

class Demo extends BaseController
{
    public function show()
    {
        $result = [
            'status' => 1,
            'code' => '200',
            'data' => [['name' => 'hangman'], ['name' => 'lisi']]
        ];
        return json($result);
    }

    /**
     * 验证码
     * @return \think\Response
     */
    public function verify(Request $request)
    {
        return Captcha::create();
    }
}
