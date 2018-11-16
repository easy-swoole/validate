<?php
/**
 * Created by PhpStorm.
 * User: eValor
 * Date: 2018/11/16
 * Time: 上午9:28
 */

namespace EasySwoole\Validate\test;

require_once 'BaseTestCase.php';

/**
 * 在给定的数组中
 * Class ActiveUrlTest
 * @package EasySwoole\Validate\test
 */
class InArrayTest extends BaseTestCase
{
    // 合法断言
    function testValidCase()
    {
        // 符合条件
        $this->freeValidate();
        $this->validate->addColumn('number')->inArray([ 1, 2, 3, 4, 5 ]);
        $validateResult = $this->validate->validate([ 'number' => 5 ]);
        $this->assertTrue($validateResult);
    }

    // 非法断言
    function testInvalidCase()
    {
        // 条件不符
        $this->freeValidate();
        $this->validate->addColumn('number')->inArray([ 1, 2, 3, 4, 5 ]);
        $validateResult = $this->validate->validate([ 'number' => 6 ]);
        $this->assertFalse($validateResult);
        echo $this->validate->getError();
    }
}