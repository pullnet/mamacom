<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/30							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	？？？管理画面							*/
/*	TestController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class TestController extends DblistController {

	public $layout=false;
	public $autoRender=false;
	
	public $components=array(
		"Loadbasic",
	);

	public function index(){


		$itemurl=$this->Loadbasic->load("itemurl");

		//ディレクトリ検索テスト...
		debug(glob($itemurl."data/*.data"));
	}
}
