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

    public function test()
    {
        dump(getMd5Password('admin123'));
    }

    /**
     * 登录
     * @return \think\response\Json
     */
    public function login()
    {
        if (!$this->request->isPost()) {
            return $this->error('请求方式错误');
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
        if (!$validate->check($data)) {
            return $this->error($validate->getError());
        }

        try {
            $result = (new \app\admin\business\AdminUser())->login($data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        if ($result) {
            return $this->success($result, '登录成功');
        } else {
            return $this->error('登录失败');
        }
    }
}