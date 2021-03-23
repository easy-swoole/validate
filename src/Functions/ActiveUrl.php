<?php


namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;


class ActiveUrl extends AbstractValidateFunction
{

    function name(): string
    {
        return 'ActiveUrl';
    }

    function validate($itemData, $arg, $column, Validate $validate):bool
    {
        if (is_string($itemData)) {
            if (!filter_var($itemData, FILTER_VALIDATE_URL)) {
                return false;
            }
            return checkdnsrr(parse_url($itemData, PHP_URL_HOST));
        } else {
            return false;
        }
    }
}