<?php
declare(strict_types=1);

namespace app\admin\controller;

use app\BaseController;

class Login extends BaseController
{
    /**
     * 生成验证码
     * @return \think\Response
     */
    public function verify()
    {
        return captcha();
    }

    public function test () {
        dump(md5('admin'));
    }

    /**
     * 登录
     * @return \think\response\Json
     */
    public function login()
    {
        if(!$this->request->isPost()) {
            return show(config("status.error"), "请求方式错误");
        }

        $username = $this->request->param("username", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $captcha = $this->request->param("captcha", "", "trim");
        $data = [
            'username' => $username,
            'password' => $password,
            'captcha' => $captcha,
        ];
        $validate = new \app\admin\validate\AdminUser();
        if(!$validate->check($data)) {
            return show(config("status.error"), $validate->getError());
        }

        try {
            $result = (new \app\admin\business\AdminUser())->login($data);
        }catch (\Exception $e) {
            return show(config("status.error"), $e->getMessage());
        }

        if($result) {
            return show(config("status.success"), "登录成功");
        } else {
            return show(config("status.error"), "登录失败");
        }
    }
}