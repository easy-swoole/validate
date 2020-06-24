<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace EasySwoole\Validate\test;

use EasySwoole\Http\Message\UploadFile;

require_once 'BaseTestCase.php';

class AllowFileTest extends BaseTestCase
{
    function testValidCase()
    {
        $this->freeValidate();
        $this->validate->addColumn('file')->allowFile('image/png');
        $bool = $this->validate->validate(['file' => (new UploadFile(__DIR__ . '/../res/easyswoole.png', 1, 200, null, 'image/png'))]);
        $this->assertTrue($bool);


        $this->freeValidate();
        $this->validate->addColumn('file')->allowFile('image/png');
        $bool = $this->validate->validate(['file' => (new UploadFile(__DIR__ . '/../res/easyswoole.png', 1, 200, null, 'image/jpg'))]);
        $this->assertFalse($bool);
    }
}