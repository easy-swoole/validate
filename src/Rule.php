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

    function getRuleMap():array
    {
        return $this->ruleMap;
    }
    /*
     * 以下检验方法按照首字母排序
     */

    function activeUrl($msg = null)
    {
        $this->ruleMap['activeUrl'] = [
            'arg'=>$msg,
            'msg'=>null
        ];
        return $this;
    }

    function alpha($msg = null)
    {
        $this->ruleMap['alpha'] = [
            'arg'=>$msg,
            'msg'=>null
        ];
        return $this;
    }

    function between($min,$max,$msg = null)
    {
        $this->ruleMap['between'] = [
            'msg'=>$msg,
            'arg'=>[
                $min,$max
            ]
        ];
        return $this;
    }

    function bool($msg = null)
    {
        $this->ruleMap['bool'] = [
            'msg'=>$msg,
            'arg'=>null
        ];
        return $this;
    }

    function dateBefore(?string $date = null,$msg = null)
    {
        $this->ruleMap['dateBefore'] = [
            'msg'=>$msg,
            'arg'=>$date
        ];
        return $this;
    }

    function dateAfter(?string $date = null,$msg = null)
    {
        $this->ruleMap['dateAfter'] = [
            'msg'=>$msg,
            'arg'=>$date
        ];
        return $this;
    }

    function equal($compare,$msg = null)
    {
        $this->ruleMap['equal'] = [
            'msg'=>$msg,
            'arg'=>$compare
        ];
        return $this;
    }

    function float($msg = null)
    {
        $this->ruleMap['func'] = [
            'arg'=>null,
            'msg'=>$msg
        ];
        return $this;
    }

    function func(callable $func,$msg = null)
    {
        $this->ruleMap['func'] = [
            'arg'=>$func,
            'msg'=>$msg
        ];
        return $this;
    }

    function inArray(array $array,$msg = null)
    {
        $this->ruleMap['inArray'] = [
            'arg'=>$array,
            'msg'=>$msg
        ];
        return $this;
    }

    function integer($msg = null)
    {
        $this->ruleMap['integer'] = [
            'arg'=>null,
            'msg'=>$msg
        ];
        return $this;
    }

    function isIp(array $array,$msg = null)
    {
        $this->ruleMap['isIp'] = [
            'arg'=>$array,
            'msg'=>$msg
        ];
        return $this;
    }

    function notEmpty($msg = null)
    {
        $this->ruleMap['notEmpty'] = [
        'arg'=>null,
        'msg'=>$msg
        ];
        return $this;
    }

    function notInArray(array $array,$msg = null)
    {
        $this->ruleMap['notInArray'] = [
            'arg'=>$array,
            'msg'=>$msg
        ];
        return $this;
    }

    function numeric($msg = null)
    {
        $this->ruleMap['numeric'] = [
            'arg'=>$msg,
            'msg'=>null
        ];
        return $this;
    }

    function length(int $len,$msg = null)
    {
        $this->ruleMap['length'] = [
            'msg'=>$msg,
            'arg'=>$len
        ];
        return $this;
    }

    function lengthMax(int $lengthMax,$msg = null)
    {
        $this->ruleMap['lengthMax'] = [
            'msg'=>$msg,
            'arg'=>$lengthMax
        ];
        return $this;
    }

    function lengthMin(int $lengthMin,$msg = null)
    {
        $this->ruleMap['lengthMin'] = [
            'msg'=>$msg,
            'arg'=>$lengthMin
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

    function min(int $min,?string $msg = null):Rule
    {
        $this->ruleMap['min'] = [
            'arg'=>$min,
            'msg'=>$msg
        ];
        return $this;
    }

    function optional()
    {
        $this->ruleMap['optional'] = [
            'arg'=>null,
            'msg'=>null
        ];
        return $this;
    }

    function regex($reg,$msg = null)
    {
        $this->ruleMap['regex'] = [
            'arg'=>$reg,
            'msg'=>$msg
        ];
        return $this;
    }

    function required($msg = null)
    {
        $this->ruleMap['required'] = [
            'arg'=>null,
            'msg'=>$msg
        ];
        return $this;
    }

    function timestamp($msg = null)
    {
        $this->ruleMap['timestamp'] = [
            'arg'=>null,
            'msg'=>$msg
        ];
        return $this;
    }

    function url($msg = null)
    {
        $this->ruleMap['url'] = [
            'arg'=>null,
            'msg'=>$msg
        ];
        return $this;
    }
}