<?php

namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

abstract class AbstractValidateFunction
{
    abstract function name():string;

    abstract function validate($itemData,$arg,$column,Validate $validate):bool;
}