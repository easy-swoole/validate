# validate

## 默认错误信息提示

validate验证器提供了默认错误信息规则，详细如下：

```php
private $defaultErrorMsg = [
    'activeUrl'  => ':fieldName必须是可访问的网址',
    'alpha'      => ':fieldName只能是字母',
    'between'    => ':fieldName只能在 :arg0 - :arg1 之间',
    'bool'       => ':fieldName只能是布尔值',
    'dateBefore' => ':fieldName必须在日期 :arg0 之前',
    'dateAfter'  => ':fieldName必须在日期 :arg0 之后',
    'equal'      => ':fieldName必须等于:arg0',
    'float'      => ':fieldName只能是浮点数',
    'func'       => ':fieldName自定义验证失败',
    'inArray'    => ':fieldName必须在 :arg0 范围内',
    'integer'    => ':fieldName只能是整数',
    'isIp'       => ':fieldName不是有效的IP地址',
    'notEmpty'   => ':fieldName不能为空',
    'numeric'    => ':fieldName只能是数字类型',
    'notInArray' => ':fieldName不能在 :arg0 范围内',
    'length'     => ':fieldName的长度必须是:arg0',
    'lengthMax'  => ':fieldName长度不能超过:arg0',
    'lengthMin'  => ':fieldName长度不能小于:arg0',
    'max'        => ':fieldName的值不能大于:arg0',
    'min'        => ':fieldName的值不能小于:arg0',
    'regex'      => ':fieldName不符合指定规则',
    'required'   => ':fieldName必须填写',
    'timestamp'  => ':fieldName必须是一个有效的时间戳',
    'url'        => ':fieldName必须是合法的网址',
];
```

默认错误例子

```php
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-11-19
 * Time: 上午10:47
 */

require_once "./vendor/autoload.php";

$data = ['name' => 'blank', 'age' => 25];   // 验证数据
$validate = new \EasySwoole\Validate\Validate();
$validate->addColumn('name')->required();   // 给字段加上验证规则
$validate->addColumn('age')->required()->max(18);
$bool = $validate->validate($data); // 验证结果
if ($bool) {
    var_dump("验证通过");
} else {
    var_dump($validate->getError()->__toString());
}
/*
 * 输出结果： string(23) "age的值不能大于18"
 */
```

## 自定义错误信息提示

自定义错误例子

```php
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-11-19
 * Time: 上午10:47
 */

require_once "./vendor/autoload.php";

$data = ['name' => 'blank', 'age' => 25];   // 验证数据
$validate = new \EasySwoole\Validate\Validate();
$validate->addColumn('name')->required('名字不为空');   // 给字段加上验证规则
$validate->addColumn('age')->required('年龄不为空')->func(function($params, $key) {
    return $params instanceof \EasySwoole\Spl\SplArray && $key == 'age' && $params[$key] == 18;
}, '只允许18岁的进入');
$bool = $validate->validate($data); // 验证结果
if ($bool) {
    var_dump("验证通过");
} else {
    var_dump($validate->getError()->__toString());
}
/*
 * 输出结果： string(23) "只允许18岁的进入"
 */
```

## 自定义验证器类

自定义验证器类错误例子

```php
<?php
/**
 * Created by PhpStorm.
 * User: Heelie
 * Date: 19-12-27
 * Time: 下午15:52
 */

require_once "./vendor/autoload.php";

class CustomValidator implements \EasySwoole\Validate\ValidateInterface
{
    private $error;
    /**
     * 返回错误消息
     * @return string
     */
    public function getErrorMsg(): string
    {
        return $this->error;
    }

    public function setErrorMsg($msg): object
    {
        $this->error = $msg;
        return $this;
    }

    /**
     * @param $args = [
     *      'columnName'   => string,       // 字段
     *      'columnValue'  => string|array, // 字段值
     *      'columnAlias'  => '',  //alias  // 字段别名
     *      'columnParams' => [],  //params // 参数
     * ];
     * @return \EasySwoole\Validate\ValidateInterface|boolean
     */
    public function equalEighteen($args)
    {
        if ($args['columnValue'] == 18){
            return true;
        }
        $msg = '只允许18岁的进入';
        $msg = $args['columnParams']['name'] ? $args['columnParams']['name'] . $msg : $msg;
        $this->setErrorMsg($msg); // 优先自定义错误消息
        return $this;
    }
}
$data     = ['name' => 'blank', 'age' => 25];   // 验证数据
$validate = new \EasySwoole\Validate\Validate(CustomValidator::class);
$validate->addColumn('name')->required('名字不为空');   // 给字段加上验证规则
// 自定义错误消息示例
// $validate->addColumn('age')->required('年龄不为空')->equalEighteen(['name' => $data['name']], '只有18岁的才能进入');
$validate->addColumn('age')->required('年龄不为空')->equalEighteen(['name' => $data['name']]);
$bool = $validate->validate($data); // 验证结果
if ($bool) {
    var_dump("验证通过");
} else {
    var_dump($validate->getError()->__toString());
}
/*
 * 输出结果：string(28) "blank只允许18岁的进入"
 */
```
