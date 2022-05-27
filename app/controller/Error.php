<?php
namespace app\controller;

class Error
{
    public function __call($method, $args)
    {
        return '全局error request!';
    }
}