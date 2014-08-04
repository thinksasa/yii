<?php
/**
 +------------------------------------------------------------------------------
 * 组件类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   MathCaptchaAction.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  下午2:11:26
 +------------------------------------------------------------------------------
 */
class MathCaptchaAction extends CCaptchaAction {
	protected function generateVerifyCode(){
		return mt_rand((int)$this->minLength, (int)$this->maxLength);
	}
	
	public function renderImage($code){
		parent::renderImage($this->getText($code));
	}
	
	protected function getText($code){
		$code = (int)$code;
		$rand = mt_rand(1, $code);
		$op = mt_rand(0, 1);
		if($op){
			return $code-$rand."+".$rand;
		}else {
			return $code+$rand."-".$rand;
		}
	}
}

?>