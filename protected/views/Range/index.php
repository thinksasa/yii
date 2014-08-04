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

<?php echo CHtml::errorSummary($model)?>

<?php echo CHtml::beginForm()?>
	<?php $this->widget('RangeInputField',array(
		'model'=>$model,
		'attributeFrom'=>'from',
		'attributeTo'=>'to',
	))?>
	<?php echo CHtml::submitButton()?>
<?php echo CHtml::endForm()?>

