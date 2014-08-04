<?php
class MyCportlet extends CPortlet {
	public $title;
	public $hidenOnEmpty = FALSE;
	private $_openTag;
	
	protected function renderDecoration(){
		if($this->title){
			$this->title = $this->title . "hahah";
		}else {
			var_dump($this->title);
		}
	}
}

?>