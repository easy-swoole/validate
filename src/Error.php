<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/7/6
 * Time: 下午12:56
 */

namespace EasySwoole\Validate;


class Error
{
    private $column;
    private $columnData;
    private $columnAlias;
    private $columnErrorMsg;
    private $errorRule;
    private $errorRuleMsg;
    function __construct($column,$columnData,$columnAlias,$columnErrorMsg,$errorRule,$errorRuleMsg)
    {
        $this->column = $column;
        $this->columnData = $columnData;
        $this->columnAlias = $columnAlias;
        $this->columnErrorMsg = $columnErrorMsg;
        $this->errorRule = $errorRule;
        $this->errorRuleMsg = $errorRuleMsg;
    }

    /**
     * @return mixed
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @return mixed
     */
    public function getColumnData()
    {
        return $this->columnData;
    }

    /**
     * @return mixed
     */
    public function getColumnAlias()
    {
        return $this->columnAlias;
    }

    /**
     * @return mixed
     */
    public function getColumnErrorMsg()
    {
        return $this->columnErrorMsg;
    }

    /**
     * @return mixed
     */
    public function getErrorRule()
    {
        return $this->errorRule;
    }

    /**
     * @return mixed
     */
    public function getErrorRuleMsg()
    {
        return $this->errorRuleMsg;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        if(!empty($this->columnAlias)){
            $str = $this->columnAlias;
        }else{
            $str = $this->column;
        }
        if(!empty($this->errorRuleMsg)){
            $str .= $this->errorRuleMsg;
        }else{
            $str .= $this->columnErrorMsg;
        }
        return $str;
    }
}