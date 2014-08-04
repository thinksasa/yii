<?php
/**
  *Author : Li Bo
  *Date : 2014-6-12
  *File :index.php
*/
?>
<?php if($uploaded):?>
<p>File has been uploaded,please check <?php echo $dir;?></p>
<?php endif;?>

<?php echo CHtml::beginForm('','POST',array('enctype'=>'multipart/form-data'))?>
	<?php echo CHtml::error($model, 'zip')?>
	<?php echo CHtml::activeFileField($model, 'zip')?>
	<?php echo CHtml::submitButton('Upload')?>
<?php echo CHtml::endForm();?>