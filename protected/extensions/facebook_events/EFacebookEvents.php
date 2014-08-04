<?php
/**
 +------------------------------------------------------------------------------
 * 模型类
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   EFacebookEvents.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-13  下午5:22:01
 +------------------------------------------------------------------------------
 */

class EFacebookEvents extends CWidget {
	public $keyword;
	private $loadingImageUrl;
	//protected $url = "https://graph.facebook.com/search?q=%s&type=event&callback=?";
	protected $url = "http://www.baidu.com/#wd=%s";
	
	protected function getUrl()
	{
		return sprintf($this->url, urlencode($this->keyword));
	}
	
	public function init()
	{
		$assetsDir = dirname(__FILE__).'/assets';
		$cs = Yii::app()->getClientScript();
	
		$cs->registerCoreScript("jquery");
	
		// 发布并注册js文件
		$cs->registerScriptFile(
				Yii::app()->assetManager->publish(
						$assetsDir.'/facebook_events.js'
				),
				CClientScript::POS_END
		);
	
		// 发布并注册css文件
		$cs->registerCssFile(
				Yii::app()->assetManager->publish(
						$assetsDir.'/facebook_events.css'
				)
		);
	
		// 发布图片。返回可访问资源实际的URL
		$this->loadingImageUrl = Yii::app()->assetManager->publish(
				$assetsDir.'/ajax-loader.gif'
		);
	}
	
	public function run()
	{
		$this->render("body", array(
				'url' => $this->getUrl(),
				'loadingImageUrl' => $this->loadingImageUrl,
				'keyword' => $this->keyword,
		));
	}
}

?>