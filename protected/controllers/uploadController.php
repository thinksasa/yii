<?php
class uploadController extends Controller {
	function actionIndex(){
		$dir = Yii::getPathOfAlias('webroot.uploads');
		$uploaded = false;
		$model = new upload();
		//echo "<pre>";var_dump($_FILES);exit();
		if(isset($_FILES['upload'])){
			$model->attributes=$_FILES['upload'];
			$file = CUploadedFile::getInstance($model, 'zip');
			//echo "<pre>";var_dump($model->validate());exit();
			if($model->validate()){
				$file->saveAs($dir.'/'.$file->getName());
				$uploaded = true;
			}
		}
		
		$this->render('index',array(
			'model'=>$model,
			'uploaded'=>$uploaded,
			'dir'=>$dir,
		));
	}
}

?>