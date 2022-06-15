<?php

declare(strict_types=1);
namespace app\admin\controller;

use app\admin\controller\AuthBase;

class User extends AuthBase
{
    public function list()
    {
        return $this->success(['name' => 'zhangsan']);
    }
}