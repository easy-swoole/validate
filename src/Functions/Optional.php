<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class Optional extends AbstractValidateFunction
{

    function name(): string
    {
        return 'Optional';
    }

    function validate($itemData, $arg, $column, Validate $validate):bool
    {
        return true;
    }
}