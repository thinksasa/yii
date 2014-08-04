<?php
/**
 +------------------------------------------------------------------------------
 * 树形菜单控制器类 yii CTreeView
 * 公共类方法
 +------------------------------------------------------------------------------
 * @category   Tree.php
 * @author    Li Bo
 * @version   i 
 * @date  2014-6-16  下午12:18:14
 +------------------------------------------------------------------------------
 */
/**
--
-- 表的结构 `coverage`
--
CREATE TABLE IF NOT EXISTS `coverage` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`pid` int(10) unsigned DEFAULT NULL,
`coverageName` varchar(100) DEFAULT NULL,
`coverageDesc` varchar(200) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;
--
-- 转存表中的数据 `coverage`
--
INSERT INTO `coverage` (`id`, `pid`, `coverageName`, `coverageDesc`) VALUES
(16, NULL, '类别', ''),
(17, 16, '类别一', ''),
(18, NULL, '分类', ''),
(19, 17, '类别二', '');
--
-- 限制表 `coverage`
--
ALTER TABLE `coverage`
ADD CONSTRAINT `coverage_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `coverage` (`id`)>
 */

class TreeController extends Controller {
	public function actionIndex(){
		$this->render('index');
	}
	public function actionAjaxFillTree(){
		//echo "<pre>";var_dump(Yii::app()->request->isAjaxRequest);exit();
		if(!Yii::app()->request->isAjaxRequest){
			exit();
		}
		$parentId= null;
		if(isset($_GET['root']) and $_GET['root']=='source'){
			$parentId = 16;
		}elseif(isset($_GET['root']) and $_GET['root']!='source'){
			$parentId = (int)$_GET['root'];
		}
		if(1){
			//$parentId = (int)$_GET['root'];
			$req=Yii::app()->db->createCommand(
					"SELECT m1.id, m1.coveragename AS text, m2.id IS NOT NULL AS hasChildren "
					."FROM tbl_coverage AS m1 LEFT JOIN tbl_coverage AS m2 ON m1.id=m2.pid "
					."WHERE m1.pid <=> $parentId "
					."GROUP BY m1.id ORDER BY m1.coveragename ASC"
			);//<=>叫做安全等于，至于什么情况下使用<=>有知道的告诉哈
			/**
			    id	text	hasChildren
				21	java	0
				20	php	    0
				17	类别一	1
			 */
			$children = $req->queryAll();
			//echo str_replace('"hasChildren":"0"', '"hasChildren":false', CTreeView::saveDataAsJson($children));
			//AAA:如果要在节点处增加链接，在$children=$req->queryAll()后面增加下面的
			$treedata=array();
			foreach ($children as $child)
			{
				$options=array('href'=>'#','id'=>$child['id'],'class'=>'treenode');
				//BBB:如果是只在叶子节点上增加链接
				 	$child['text'] = ($child['hasChildren'] == true ? $child['text'] : CHtml::openTag('a', $options).$child['text'].CHtml::closeTag('a')."\n");
				//--BBB
				/**
				  CCC:如果父节点也要链接
				 	$nodeText = CHtml::openTag('a', $options);
					$nodeText .= $child['text'];
					$nodeText .= CHtml::closeTag('a') . "\n";
					$child['text'] = $nodeText;
				  --CCC
				*/
				$treedata[]=$child;
			}
			//AAA:修改echo部分
			echo str_replace('"hasChildren":"0"','"hasChildren":false',CTreeView::saveDataAsJson($treedata));
			
			exit();
		}
	}
}

?>