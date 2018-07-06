<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/7/6
 * Time: 上午12:41
 */

namespace EasySwoole\Validate;


class Rule
{
    protected $ruleMap = [];

    function min(int $min,?string $msg = null):Rule
    {
        $this->ruleMap['min'] = [
            'arg'=>$min,
            'msg'=>$msg
        ];
        return $this;
    }

    function max(int $max,?string $msg = null):Rule
    {
        $this->ruleMap['max'] = [
            'arg'=>$max,
            'msg'=>$msg
        ];
        return $this;
    }

    function optional()
    {
        $this->ruleMap['optional'] = [];
        return $this;
    }

    function numeric()
    {
        $this->ruleMap['numeric'] = [];
        return $this;
    }

    function getRuleMap():array
    {
        return $this->ruleMap;
    }
}