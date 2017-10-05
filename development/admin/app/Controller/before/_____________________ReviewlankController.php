<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	レビューランク項目リスト管理画面				*/
/*	ReviewlankController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class ReviewlankController extends AppController {

	public $uses=array(
		"Reviewlankindex",
	);

	public $components=array(
		"Db",
	);

	public function beforeFilter(){
		parent::beforeFilter();
		
	}
	public function index(){

	}
}
