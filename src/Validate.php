<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/7/6
 * Time: 上午12:41
 */

namespace EasySwoole\Validate;


use EasySwoole\Spl\SplArray;
use EasySwoole\Validate\Exception\Runtime;
use EasySwoole\Validate\Functions\AbstractValidateFunction;
use EasySwoole\Validate\Functions\ActiveUrl;
use EasySwoole\Validate\Functions\Alpha;
use EasySwoole\Validate\Functions\AlphaDash;
use EasySwoole\Validate\Functions\AlphaNum;
use EasySwoole\Validate\Functions\Between;
use EasySwoole\Validate\Functions\IsBool;
use EasySwoole\Validate\Functions\NotEmpty;
use EasySwoole\Validate\Functions\Optional;
use EasySwoole\Validate\Functions\Required;

/**
 * 数据验证器
 * Class Validate
 * @package EasySwoole\Validate
 */
class Validate
{
    protected $columns = [];

    protected $error;

    protected $verifiedData = [];

    protected $functions = [];

    function __construct()
    {
        $this->addFunction(new ActiveUrl());
        $this->addFunction(new Alpha());
        $this->addFunction(new AlphaNum());
        $this->addFunction(new AlphaDash());
        $this->addFunction(new Between());
        $this->addFunction(new IsBool());
        $this->addFunction(new NotEmpty());
        $this->addFunction(new Optional());
        $this->addFunction(new Required());
    }

    function getError(): ?Error
    {
        return $this->error;
    }

    /**
     * 添加一个待验证字段
     * @param string $name
     * @param null|string $alias
     * @param bool $reset
     * @return Rule
     */
    public function addColumn(string $name, ?string $alias = null, bool $reset = false): Rule
    {
        if (!isset($this->columns[$name]) || $reset) {
            $rule = new Rule();
            $this->columns[$name] = [
                'alias' => $alias,
                'rule' => $rule
            ];
        }
        return $this->columns[$name]['rule'];
    }

    /**
     * 删除一个待验证字段
     * @param string $name
     */
    public function delColumn(string $name)
    {
        if (isset($this->columns[$name])) {
            unset($this->columns[$name]);
        }
    }

    public function getColumn(string $name): array
    {
        return $this->columns[$name] ?? [];
    }

    /**
     * 获取所有要验证的字段
     * @return array
     */
    public function getColumns(): array
    {
        return array_keys($this->columns);
    }

    /**
     * 验证字段是否合法
     * @param array $data
     * @return bool
     */
    function validate(array $data)
    {
        $this->verifiedData = [];
        $spl = new SplArray($data);

        foreach ($this->columns as $column => $item) {
            $columnData = $spl->get($column);
            $ruleMap = $item['rule']->getRuleMap();
            //多维数组
            if(strpos($column,'*') !== false && is_array($columnData)){
                foreach ($columnData as $datum){
                    if($this->runRule($datum,$ruleMap,$column)){
                        return false;
                    }
                }
            }else{
                if($this->runRule($columnData,$ruleMap,$column)){
                    return false;
                }
            }
            $this->verifiedData[$column] = $columnData;
        }
        return true;
    }

    private function runRule($itemData,$rules,$column):?Error
    {
        if (isset($rules['optional']) && ($itemData === null || $itemData === '')) {
            return null;
        }
        foreach ($rules as $rule => $ruleConf){
            $check = strtolower($rule);
            if(isset($this->functions[$check])){
                /** @var AbstractValidateFunction $func */
                $func = $this->functions[$check];
                if($func->validate($itemData,$ruleConf['arg'],$column,$this) == false){
                    $this->error = new Error([
                        $column,
                        $itemData,
                        $this->columns[$column]['alias'],
                        $rule,
                        $ruleConf['msg'],
                        $ruleConf['arg'],
                        $this
                    ]);
                    return $this->error;
                }
            }else{
                throw new Runtime("unsupport rule {$rule}");
            }
        }
        return null;
    }

    /**
     * 获取验证成功后的数据
     * @return array
     */
    public function getVerifiedData(): array
    {
        return $this->verifiedData;
    }

    public function addFunction(AbstractValidateFunction $function):Validate
    {
        $this->functions[strtolower($function->name())] = $function;
        return $this;
    }
}
