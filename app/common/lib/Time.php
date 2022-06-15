<?php
namespace app\common\lib;

class Time {
    public static function userLoginExpiresTime($day = 2) {
        return $day * 24 * 3600;
    }
}