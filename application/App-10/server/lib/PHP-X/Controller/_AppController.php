<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/06/01
//
//	_AppController
//	_AppController.php
//
//--------------------------------------------------

class _AppController extends Controller{

	public $components=array(
		"Session",
	);

	public function beforeFilter(){
		parent::beforeFilter();

		if(@$this->Session->read("alert")){
			$this->set("alert",@$this->Session->read("alert"));
			$this->Session->delete("alert");
		}

	}

}
?>