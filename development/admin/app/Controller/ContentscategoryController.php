<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	共通コンテンツカテゴリーリスト管理画面				*/
/*	ContentscategoryController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class ContentscategoryController extends DblistController {

	public $uses=array(
		"Contentscategoryparent",
		"Contentscategory",
		"Dblist",
	);

	public $components=array(
		"Loadbasic",
		"Db",
		"Csv",
	);

	//モデル名を設定
	public $Model_c="Contentscategoryparent";
	public $Model_m="Contentscategory";
	public $Model_cid="contentscategoryparent_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"コンテンツカテゴリー(親)",
			"subtitle2"=>"子カテゴリー",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("親カテゴリー名","登録件数"));
		parent::index($page);

	}
	public function view($id,$page=1){
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
		$this->set("tab",array("親カテゴリー名","登録件数","カテゴリー名"));

		parent::view($id,$page);
	}
	public function inputedit($sid,$id=""){

		$this->set("tab",array("親カテゴリー名","登録件数","カテゴリー名"));

		parent::inputedit($sid,$id);
	}
}
