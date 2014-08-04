<?php
/**
 +------------------------------------------------------------------------------
 * 模型类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   FlashController.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-17  下午4:22:48
 +------------------------------------------------------------------------------
 */
class FlashController extends Controller {
	public function actionOk(){
		Yii::app()->user->setFlash('success','everything go ok!');
		$this->refresh();
		//$this->redirect('index.php?r=flash');
		//echo "<pre>";var_dump(Yii::app()->user);exit();
	}
	
	public function actionNo(){
		Yii::app()->user->setFlash('error','everything go wrong!');
		$this->redirect('index.php?r=flash');
	}
	
	public function actionIndex(){
		$model = new Flash();
		if(isset($_POST['Flash']['username']) && !empty($_POST['Flash']['username'])){
			$this->actionOk();
		}
		if(isset($_POST['Flash']['username']) && empty($_POST['Flash']['username'])){
			$this->actionNo();
		}
		//var_dump($_POST['Flash']['username']);exit();
		$this->render('index',array(
			'model'=>$model,
		));
	}
}

?>