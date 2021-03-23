<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class IsBool extends AbstractValidateFunction
{

    function name(): string
    {
        return 'bool';
    }

    function validate($itemData, $arg, $column, Validate $validate): bool
    {
        if ($itemData === 1 || $itemData === true || $itemData === 0 || $itemData === false) {
            return true;
        } else {
            return false;
        }
    }
}