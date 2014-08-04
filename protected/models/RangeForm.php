<?php
/**
 +------------------------------------------------------------------------------
 * 模型类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   RangeForm.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  下午3:49:18
 +------------------------------------------------------------------------------
 */
class RangeForm extends CFormModel {
	public $from;
	public $to;
	
	function rules(){
		return array(
			array('from,to','numerical','integerOnly'=>true),
			array('from','compare','compareAttribute'=>'to','operator'=>'<=','skipOnError'=>true),
		);
	}
}

?>