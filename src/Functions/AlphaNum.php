<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

class AlphaNum extends AbstractValidateFunction
{

    function name(): string
    {
        return 'AlphaNum';
    }

    function validate($itemData, $arg, $column, Validate $validate):bool
    {
        if (is_string($itemData)) {
            return preg_match('/^[a-zA-Z0-9]+$/', $itemData);
        } else {
            return false;
        }
    }
}