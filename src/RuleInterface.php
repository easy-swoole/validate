<?php


namespace EasySwoole\Validate;


interface RuleInterface
{
    /*
     * 返回当前校验规则的名字
     */
    function name():string ;
    /*
     * 检验失败返回错误信息即可
     */
    function validate(...$args):?string ;
}