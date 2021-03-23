<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class AlphaDash extends AbstractValidateFunction
{

    function name(): string
    {
        return 'AlphaDash';
    }

    function validate($itemData, $arg, $column, Validate $validate): bool
    {
        if (is_string($itemData)) {
            return preg_match('/^[a-zA-Z0-9\-\_]+$/', $itemData);
        } else {
            return false;
        }
    }
}