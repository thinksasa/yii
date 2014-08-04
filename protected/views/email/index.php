<?php
/**
  *Author : Li Bo
  *Date : 2014-6-13
  *File :index.php
*/
?>
<?php if($success):?>
<p>success!</p>
<?php endif;?>

<?php echo CHtml::beginForm('','POST')?>
<p>
<?php echo CHtml::activeLabel($model, 'email').' ： '?>
<?php echo CHtml::activeTextField($model, 'email')?>
<?php echo CHtml::error($model, 'email')?>
</p>

<?php if(CCaptcha::checkRequirements()&&Yii::app()->user->isGuest):?>
<p>
	<?php echo CHtml::activeLabelEx($model, 'verifyCode')?>
	<?php $this->widget('CCaptcha',array(
		//'captchaAction' => '/site/captcha',
		'showRefreshButton' => true,
		'clickableImage' => true,
		'imageOptions' => array('align'=>'top', 'title'=>'重新获取'),
	))?>
</p>
<p>
	<?php echo CHtml::activeTextField($model, 'verifyCode')?>
	<?php echo CHtml::error($model, 'verifyCode')?>
</p>
<?php endif;?>

<p>
	<?php echo CHtml::submitButton('提交')?>
</p>
<?php echo CHtml::endForm()?>