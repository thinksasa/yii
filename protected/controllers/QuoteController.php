<?php
/**
 +------------------------------------------------------------------------------
 * 模型类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   QuoteController.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  下午4:34:32
 +------------------------------------------------------------------------------
 */

class QuoteController extends \Controller {
	private $quotes = array(
		array('你要相信世界上每一个人都精明，要令人信服并喜欢和你交往,那才最重要。', '李嘉诚'),
		array('该放下时且放下，你宽容别人，其实是给自己留下来一片海阔天空。', '于丹'),
		array('免费，是世界上最贵的东西。', '马云'),
		array('没有捕捉不到的猎物，就看你有没有野心去捕;没有完成不了的事情，就看你有没有野心去做。', '狼图腾'),
		array('君志所向，一往无前，愈挫愈勇，再接再厉。', '孙中山'),
	);
	
	public function filters(){
		return array(
			'ajaxOnly + getQuote',
		);
	}
	
	public function getRandomQuote(){
		return $this->quotes[array_rand($this->quotes,1)];
	}
	
	public function actionIndex(){
		$this->render('index',array(
			'quote'=>$this->getRandomQuote(),
		));
	}
	
	public function actionGetQuote(){
		$this->renderPartial('_quote',array(
			'quote'=>$this->getRandomQuote(),
		));
	}
}

?>