<?php
/**
  *Author : Li Bo
  *Date : 2014-6-16
  *File :tree.php
*/
?>
<?php echo CHtml::ajaxLink('ddd', 'index.php?r=tree/ajaxFillTree&root=source')?>
<?php $this->widget('system.web.widgets.CTreeView',array(
			'animated'=>'normal',
			'collapsed'=>true,
			'skin'=>false,
			//'persist'=>'cookie',//记住用户选择的
			'url' => array('ajaxFillTree'),
			'htmlOptions'=>array(
            				'class'=>'treeview-famfamfam',//使用样式/*treeview-black treeview-gray treeview-red treeview-famfamfam filetree */
							'id' => 'coverageTree', 
							'class' => 'coverageTree'
							),
            /* 'data'=>array(
               	array(
                   'text'=>'<span>系统设置</span>',
                   'expanded'=>false,
                   'children'=>array(
                       array('text'=>'<a href="'.$this->createUrl('/site/index').'">首页</a>',),
                  	),
               	),
                array(
                	'id'=>'sed',
                    'text'=>'<span>分类管理</span>',
                    'expanded'=>false,
                    'children'=>array(
                        array('text'=>'<a href="'.$this->createUrl('/admin/postCategory').'">所有分类</a>',),
                        array('text'=>'<a href="'.$this->createUrl('/admin/postCategory/add').'">增加新分类</a>',),
                   	),
               	),
                array(
                	//'text'=>CHtml::ajaxLink('ddd', 'index.php?r=tree/ajaxFillTree'),
                    'text'=>'<span>文章管理</span>',
                    'expanded'=>false,
                    'children'=>array(
                        array('text'=>'所有分类',),
                        array('text'=>'发表新文章',),
                        array('text'=>'审核文章',),
                    ),
               	),
              ), */
            ));

?>