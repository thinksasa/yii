<?php
class upload extends CFormModel {
	public $zip;
	public function rules(){
		return array(
			array('zip','file','types'=>'zip','maxSize'=>100),
		);
	}
}

?>