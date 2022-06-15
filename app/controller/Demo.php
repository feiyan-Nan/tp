<?php

namespace app\controller;

use app\BaseController;

class Demo extends BaseController
{
    public function show()
    {
//        define('PI', 3.14);
//        $result = [['name' => 'hangman'], ['name' => PI]];
////        return show(0, '成功', $result);
//        return show(0, '成功', $result);
        echo md5('admin123');
    }

    /**
     * 验证码
     * @return \think\Response
     */
    public function verify()
    {
        return captcha();
    }

    public function databases () {
        $yzm = $this->request->param('yzm');
//        echo captcha_check($yzm);
        dump(captcha_check($yzm));
    }
}
