<?php
declare(strict_types=1);

namespace app\admin\controller;

use app\BaseController;

class Login extends BaseController
{
    public function verify()
    {
        return captcha();
    }
}