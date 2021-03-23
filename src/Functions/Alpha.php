<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class Alpha extends AbstractValidateFunction
{

    function name(): string
    {
        return 'Alpha';
    }

    function validate($itemData, $arg, $column, Validate $validate):bool
    {
        if (is_string($itemData)) {
            return preg_match('/^[a-zA-Z]+$/', $itemData);
        } else {
            return false;
        }
    }
}