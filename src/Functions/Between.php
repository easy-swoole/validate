<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class Between extends AbstractValidateFunction
{

    function name(): string
    {
        return 'Between';
    }

    function validate($itemData, $arg, $column, Validate $validate): bool
    {
        $min = array_shift($arg);
        $max = array_shift($arg);
        if (is_numeric($itemData) || is_string($itemData)) {
            if ($itemData <= $max && $itemData >= $min) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}