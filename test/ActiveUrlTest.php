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
 * 是否一个能连通的URL
 * Class ActiveUrlTest
 * @package EasySwoole\Validate\test
 */
class ActiveUrlTest extends BaseTestCase
{
    // 合法断言
    function testValidCase()
    {
        // 可以连通的网址
        $this->freeValidate();
        $this->validate->addColumn('url')->activeUrl('aaa');
        $validateResult = $this->validate->validate([ 'url' => 'http://baidu.com' ]);
        $this->assertTrue($validateResult, 'activeUrl ValidCase fail!');
    }

    // 非法断言
    function testInvalidCase()
    {
        // 有效网址但不能连通
        $this->freeValidate();
        $this->validate->addColumn('url', '网站')->activeUrl();
        $validateResult = $this->validate->validate([ 'url' => 'http://xxx.cn' ]);
        $this->assertFalse($validateResult);

        // 无效的网址
        $this->freeValidate();
        $this->validate->addColumn('url')->activeUrl();
        $validateResult = $this->validate->validate([ 'url' => 'this is not a url' ]);
        $this->assertFalse($validateResult);
    }
}