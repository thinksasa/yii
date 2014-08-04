<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>Posts</h1>

<?php if(!empty($_GET['tag'])): ?>
<h1>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    //'template'=>"{items}\n{pager}",
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView',array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
            'header' => 'Parent Name',
            'name' => 'post.title',
        ),
		array(
				'class' => 'CCheckBoxColumn',
				'selectableRows'=>2,//0:只读，1：单选，2：多选
				'value' => $model->id,
		),
		'id',
		'title',
		'content:html',
		array(
			'class'=> 'CButtonColumn',
			'header' =>'操作',  //表头
			'deleteConfirmation' => '确定删除？',
			'deleteButtonLabel' =>'xxx',
		),	
)
))?>
