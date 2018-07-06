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

    function getError():?Error
    {
        return $this->error;
    }

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


    /*
    * 以下检验方法按照首字母排序
    */

    private function activeUrl(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(is_string($data)){
            return checkdnsrr(parse_url($data,PHP_URL_HOST));
        }else{
            return false;
        }
    }


    private function alpha(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(is_string($data)){
            return preg_match('/^[a-zA-Z]+$/',$data);
        }else{
            return false;
        }
    }

    private function between(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        $min = array_shift($args);
        $max = array_shift($args);
        if(is_numeric($data) || is_string($data)){
            if($data <= $max && $data >= $min){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function bool(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(($data == 1) || ($data == 0)){
            return true;
        }else{
            return false;
        }
    }

    private function equal(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if($data !== $arg){
            return false;
        }
        return true;
    }

    private function func(SplArray $splArray,string $column,$arg):bool
    {
        return call_user_func($arg, $splArray, $column);
    }

    private function inArray(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        return in_array($data,$arg);
    }

    private function notEmpty(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if($data === 0 || $data === '0'){
            return true;
        }else{
            return !empty($data);
        }
    }

    private function numeric(SplArray $splArray,string $column,$arg):bool
    {
        return is_numeric($splArray->get($column));
    }

    private function notInArray(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        return !in_array($data,$arg);
    }

    private function length(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(is_numeric($data) || is_string($data)){
            if(strlen($data) == $arg){
                return true;
            }else{
                return false;
            }
        }else if(is_array($data)){
            if(count($data) == $arg){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    private function lengthMax(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(is_numeric($data) || is_string($data)){
            if(strlen($data) <= $arg){
                return true;
            }else{
                return false;
            }
        }else if(is_array($data)){
            if(count($data) <= $arg){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    private function lengthMin(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(is_numeric($data) || is_string($data)){
            if(strlen($data) >= $arg){
                return true;
            }else{
                return false;
            }
        }else if(is_array($data)){
            if(count($data) >= $arg){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
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

    private function optional(SplArray $splArray,string $column,$arg)
    {
        return true;
    }

    private function regex(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(is_numeric($data) || is_string($data)){
            return preg_match($arg,$data);
        }else{
            return false;
        }
    }

    private function required(SplArray $splArray,string $column,$arg):bool
    {
        return isset($splArray[$column]);
    }

    private function timestamp(SplArray $splArray,string $column,$arg):bool
    {
        $data = $splArray->get($column);
        if(is_numeric($data)){
            if(strtotime(date("d-m-Y H:i:s",$data)) === (int)$data){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}