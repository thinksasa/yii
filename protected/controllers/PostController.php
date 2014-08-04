<?php

class PostController extends Controller
{
	/**
	 * 如果子类重写方法的参数和基类不一样，只要给参数个默认值，
	 * 使得编译器认为参数可以为空，保持重写方法与基类方法的函数签名相同就可以了
	 * @see CController::beforeAction()
	 */
	 /* public function beforeAction($a=null){
		parent::beforeAction('actionCreate');
		echo "ddddddddddddd";exit();
	}  */
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function onClick(){
		echo "ddddddd";
		$event =new CEvent();
		$this->raiseEvent('onClick',$event);
	}
	
	public function handlerClick(){
		echo "事件被触发了.......";
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$com = $this->attachEventHandler('onClick',$this->handlerClick());
		/**
			行为类绑定
			CComponent可以将一个或者多个CBehavior的成员变量或成员函数添加到自己身上
		 */
		$ccom = new CComponent();
		//添加calculator功能
		$ccom->attachBehavior('Calculator', new Calculator());
		//使用calculator功能
		echo $ccom->cadd(2,3);
		$model=new Post;
		/* $model->title ='hello 你好';
		$model->content = "这些内容你觉得好吗？";
		$model->tags = 'hh';
		$model->status = 1;
		//$model->create_time = $model->update_time = time();
		$model->create_time = 111;
		$model->author_id= 1;
		$model->save();
		exit(); */
		// Uncomment the following line if AJAX validation is needed
	    $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			//echo "<pre>";var_dump($model);exit();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Post();
		
		$criteria = new CDbCriteria(array(
			'condition'=>'status='.Post::STATUS_PUBLISHED,
			'order'=>'update_time DESC',
			'with'=>'commentCount'
		));
		//http://yii.vs/index.php?r=post%2Findex&Post_sort=id.desc&ajax=yw2
		if(isset($_GET['Post_sort']) && $_GET['Post_sort']){
			$clause = str_replace('.', ' ', $_GET['Post_sort']);
			$criteria->order=$clause;	
		}
		if(isset($_GET['tag']) && $_GET['tag']){
			$criteria->addSearchCondition('tags', $_GET['tag']);
		}
		$dataProvider=new CActiveDataProvider('Post',array(
			'pagination'=>array('pageSize'=>5),
			'criteria'=>$criteria,
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Post the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Post $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function captchaCode(){
		return array(
			'captcha'=>array(
					'class'=>'CaptchaAction',
					'backColor'=>0xFFFFFF,  //背景颜色
					'minLength'=>4,  //最短为4位
					'maxLength'=>4,   //是长为4位
					'transparent'=>true,  //显示为透明
			)
		);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}
