<?php

namespace EasySwoole\Validate\Functions;


use EasySwoole\Validate\Validate;

abstract class AbstractValidateFunction
{
    protected $validate;

    function __construct(Validate $validate)
    {
        $this->validate = $validate;
    }

    abstract function name():string;

    abstract function validate($itemData,$arg,$column);
}