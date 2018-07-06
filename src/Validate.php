<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/7/6
 * Time: 上午12:41
 */

namespace EasySwoole\Validate;


use EasySwoole\Spl\SplArray;

class Validate
{
    protected $columns = [];

    protected $error;

    public function addColumn(string $name,?string $alias = null,?string $errorMsg = null):Rule
    {
        $rule = new Rule();
        $this->columns[$name] = [
            'alias'=>$alias,
            'errorMsg'=>$errorMsg,
            'rule'=>$rule
        ];
        return $rule;
    }

    function validate(array $data)
    {
        $spl = new SplArray($data);
        foreach ($this->columns as $column => $item){
            $rules = $item['rule']->getRuleMap();
            /*
             * 优先检测是否带有optional选项
             * 如果设置了optional又不存在对应字段，则跳过该字段检测
             */
            if(isset($rules['optional']) && !isset($data[$column])){
                continue;
            }
            foreach ($rules as $rule => $ruleInfo){
                if(!call_user_func([$this,$rule],$spl,$column,$ruleInfo['arg'])){
                    $this->error = new Error($column,$spl->get($column),$item['alias'],$item['errorMsg'],$rule,$ruleInfo['msg']);
                    return false;
                }
            }
        }
        return true;
    }

    private function optional()
    {
        return true;
    }

    private function min(SplArray $splArray,string $column,$arg):bool
    {
        if(!$this->numeric( $splArray,$column,$arg)){
            return false;
        }
        $data = $splArray->get($column);
        if($data < intval($arg)){
            return false;
        }
        return true;
    }

    private function max(SplArray $splArray,string $column,$arg):bool
    {
        if(!$this->numeric( $splArray,$column,$arg)){
            return false;
        }
        $data = $splArray->get($column);
        if($data > intval($arg)){
            return false;
        }
        return true;
    }

    private function numeric(SplArray $splArray,string $column,$arg):bool
    {
        return is_numeric($splArray->get($column));
    }

    function getError():?Error
    {
        return $this->error;
    }
}