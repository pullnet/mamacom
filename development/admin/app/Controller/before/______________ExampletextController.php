<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/30							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	各種例文リスト管理画面						*/
/*	ExampletextController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class ExampletextController extends DblistController {

	public $uses=array(
		"Exampletextcategory",
		"Exampletext",
		"Dblist",
	);

	public $components=array(
		"Db",
	);

	//モデル名を設定
	public $Model_c="Exampletextcategory";//親カテゴリーはこっち
	public $Model_m="Exampletext";
	public $Model_cid="exampletextcategory_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"入力例文カテゴリー",
			"subtitle2"=>"入力例文",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("入力例文カテゴリー名","登録件数"));
		parent::index($page);
	}
	public function view($id,$page=1){
		$this->set("tab",array("入力例文カテゴリー名","登録件数","入力例文名"));
		parent::view($id,$page);
	}
	public function inputedit($sid,$id=""){
		$this->set("tab",array("入力例文カテゴリー名","登録件数","入力例文名"));
		parent::inputedit($sid,$id);
	}
}
