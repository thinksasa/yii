<?php
/**
  *Author : Li Bo
  *Date : 2014-6-17
  *File :index.php
*/
/**
 +----------------------------------------------------------
 * setFlash hasFlash getFlash
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param string $font 
 * @param mixed $content 
 +----------------------------------------------------------
 * @return string $content_edit 
 +----------------------------------------------------------
 */
?>
<?php $form=$this->beginWidget('CActiveForm')?>
	<div class="row">
		<?php echo $form->labelEX($model,'username')?>
		<?php echo $form->textField($model,'username')?>
	</div>
	<div class="row">
		<?php echo $form->labelEX($model,'password')?>
		<?php echo $form->passwordField($model,'password')?>
	</div>
	<div class="row">
		<?php echo CHtml::submitButton('登录')?>
	</div>
<?php $this->endWidget()?>

<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="flash-notice">
	<?php echo Yii::app()->user->getFlash('success')?>
	</div>
<?php endif;?>

<?php if(Yii::app()->user->hasFlash('error')):?>
	<div class="flash-error">
	<?php echo Yii::app()->user->getFLash('error')?>
	</div>
<?php endif;?>