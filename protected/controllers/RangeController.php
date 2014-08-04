<?php
/**
 +------------------------------------------------------------------------------
 * 类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   RangeController.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  下午3:53:59
 +------------------------------------------------------------------------------
 */
class RangeController extends Controller {
	function actionIndex(){
		$success = false;
		$model = new RangeForm();
		//echo "<pre>";var_dump($_POST['RangeForm']);exit();
		if(!empty($_POST['RangeForm'])){
			$model->setAttributes($_POST['RangeForm']);
			if($model->validate()){
				$success = true;
			}
		}
		
		$this->render('index',array(
			'model'=>$model,
			'success'=>$success,
		));
	}
}

?>