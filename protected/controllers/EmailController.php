<?php
/**
 +------------------------------------------------------------------------------
 * 控制器类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   EmailController.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  上午11:27:32
 +------------------------------------------------------------------------------
 */
class EmailController extends Controller {
	public function actions(){
		return array(
			'captcha'=>array(
				//'class'=>'CCaptchaAction',
			'class'=>'MathCaptchaAction',
			'minLength'=>1,
			'maxLength'=>10,
			),
		);
	}
	public function actionIndex(){
		$success = false;
		$model = new EmailForm();
		//echo "<pre>";var_dump($_POST);exit();
		/**
		 * $_POST['EmailForm']：这里的EmailForm要和模型类名一致？
		 */
		if(!empty($_POST['EmailForm'])){
			$model->setAttributes($_POST['EmailForm']);
			if($model->validate()){
				$success = true;
				Yii::log("邮箱正确！");
			}
		}
		/* if(!empty($_POST['EmailForm']['verifyCode'])){
			//$model->setAttributes($_POST['EmailForm']['verifyCode']);
			$validator = CCaptchaValidator::createValidator('CCaptcha', $model, 'verifyCode');
			echo "<pre>";var_dump($validator);exit();
			
		} */
		
		$this->render('index',array(
				'model'=>$model,
				'success'=>$success,
		));
	}
}

?>