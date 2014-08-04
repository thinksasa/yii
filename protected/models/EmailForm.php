<?php
/**
 +------------------------------------------------------------------------------
 * 模型类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   EmailForm.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  上午11:23:33
 +------------------------------------------------------------------------------
 */
class EmailForm extends CFormModel {
	public $email;
	public $verifyCode;
	function rules(){
		return array(
			array('email','email','message'=>'邮箱地址格式不对'),
			array('verifyCode','captcha','allowEmpty'=>!CCaptcha::checkRequirements(),'message'=>'验证码错误！'),
		);
	}
}

?>