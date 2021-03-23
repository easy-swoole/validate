<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class NotEmpty extends AbstractValidateFunction
{

    function name(): string
    {
        return  'NotEmpty';
    }

    function validate($itemData, $arg, $column, Validate $validate): bool
    {
        if ($itemData === 0 || $itemData === '0') {
            return true;
        } else {
            return !empty($itemData);
        }
    }
}