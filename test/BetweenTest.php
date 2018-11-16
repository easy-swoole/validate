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
 * 是否在两值之间(包含极端值)
 * Class ActiveUrlTest
 * @package EasySwoole\Validate\test
 */
class BetweenTest extends BaseTestCase
{
    // 合法断言
    function testValidCase()
    {
        // 整数表示
        $this->freeValidate();
        $this->validate->addColumn('number')->between(5, 10);
        $validateResult = $this->validate->validate([ 'number' => 6 ]);
        $this->assertTrue($validateResult, 'activeUrl ValidCase fail!');

        // 小数表示
        $this->freeValidate();
        $this->validate->addColumn('number')->between(5, 10);
        $validateResult = $this->validate->validate([ 'number' => 6.33333 ]);
        $this->assertTrue($validateResult, 'activeUrl ValidCase fail!');

        // 字符串表示
        $this->freeValidate();
        $this->validate->addColumn('number')->between(5, 10);
        $validateResult = $this->validate->validate([ 'number' => '6' ]);
        $this->assertTrue($validateResult, 'activeUrl ValidCase fail!');

        // 等于最小值
        $this->freeValidate();
        $this->validate->addColumn('number')->between(5, 10);
        $validateResult = $this->validate->validate([ 'number' => 5 ]);
        $this->assertTrue($validateResult);

        // 等于最大值
        $this->freeValidate();
        $this->validate->addColumn('number')->between(5, 10);
        $validateResult = $this->validate->validate([ 'number' => 10 ]);
        $this->assertTrue($validateResult);
    }

    // 非法断言
    function testInvalidCase()
    {
        // 不在值之间
        $this->freeValidate();
        $this->validate->addColumn('number')->between(5, 10);
        $validateResult = $this->validate->validate([ 'number' => 20 ]);
        $this->assertFalse($validateResult);

        // 不是合法值
        $this->freeValidate();
        $this->validate->addColumn('number')->between(5, 10);
        $validateResult = $this->validate->validate([ 'number' => 'aaa' ]);
        $this->assertFalse($validateResult);
    }
}