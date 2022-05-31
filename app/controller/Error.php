<?php

namespace app\controller;

class Error
{
    public function __call($method, $args)
    {
        return show(config("status.controller_not_found"), '找不到该控制器', null );
    }
}