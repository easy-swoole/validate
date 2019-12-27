<?php

namespace EasySwoole\Validate;

interface ValidateInterface
{
    /**
     * 返回错误消息
     * @return string
     */
    public function getErrorMsg():string;
}