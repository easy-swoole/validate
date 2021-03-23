<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class Required extends AbstractValidateFunction
{

    function name(): string
    {
        return 'Required';
    }

    function validate($itemData, $arg, $column, Validate $validate): bool
    {
        if($itemData === null){
            return false;
        }
        return true;
    }
}