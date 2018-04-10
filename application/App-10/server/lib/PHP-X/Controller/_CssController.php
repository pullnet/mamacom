<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/06/01
//
//	_CssController
//	_CssController.php
//
//--------------------------------------------------

class _CssController extends Controller{

	public $layout=false;
	public $autoRender=false;

	public function beforeFilter(){
		parent::beforeFilter();
header("Content-Type:text/css; charset=utf-8");
		include("../lib/wdata/css/".$this->params["action"]);
	}


}
?>