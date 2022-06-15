<?php

namespace app\admin\business;

use app\common\lib\Str;
use app\common\lib\Time;
use app\common\model\mysql\AdminUser as AdminUserModel;
use think\Exception;

class AdminUser
{
    public $userModelObj = null;

    public function __construct()
    {
        $this->userModelObj = new AdminUserModel();
    }

    public function demo() {
        dump(getMd5Password('admin123'));
    }

    /**
     * @throws Exception
     */
    public function login($data)
    {
        $user = $this->getAdminUserByUsername($data['username']);

        if (!$user) {
            throw new Exception("不存在该用户", config('status.error'));
        }
        if($user['password'] != getMd5Password($data['password'])) {
            throw new Exception("输入的密码错误", config('status.error'));
        }
        $token = Str::getLoginToken($data['username']);

        $redisData = [
            "id" => $user['id'],
            "username" => $user['username'],
        ];

        $res = cache(config("redis.token_pre").$token, $redisData, Time::userLoginExpiresTime(7));

        $updateResult = $this->userModelObj->updateById($user['id'], ["last_login_time" => time(), "last_login_ip" => request()->ip(), 'login_num' => ++$user['login_num']]);
        return $res && $updateResult ? ["token" => $token, "username" => $user['username']] : false;
    }

    public function getAdminUserByUsername($username)
    {
        $user = $this->userModelObj->getAdminUserByUsername($username);

        if (empty($user) || $user->status != config('status.mysql.table_normal')) {
            return [];
        }
        return $user->toArray();

    }
}