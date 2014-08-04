<?php
/**
 +------------------------------------------------------------------------------
 * 模型类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   RangeInputField.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  下午3:38:47
 +------------------------------------------------------------------------------
 */
class RangeInputField extends CInputWidget {
	public $attributeFrom;
    public $attributeTo;
    
    public $nameFrom;
    public $nameTo;
    
    public $valueFrom;
    public $valueTo;
    
    function run()
    {
    	//echo "<pre>";var_dump($this->hasModel());exit();
        if($this->hasModel())
        {
            echo CHtml::activeTextField($this->model, $this->attributeFrom);
            echo ' &rarr; ';
            echo CHtml::activeTextField($this->model, $this->attributeTo);
        }
        else {
            echo CHtml::textField($this->nameFrom, $this->valueFrom);
            echo ' &rarr; ';
            echo CHtml::textField($this->nameTo, $this->valueTo);
        }
    }
}

?>