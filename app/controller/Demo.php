<?php

namespace app\controller;

use app\BaseController;

class Demo extends BaseController
{
    public function show()
    {
        $result = [
            'status' => 1,
            'code' => '200',
            'data' => [['name' => 'hangman'], ['name' => 'lisi']]
        ];
        return show(0, '成功', $result);
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
