<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	グループカテゴリーリスト管理画面				*/
/*	GroupcategoryController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class GroupcategoryController extends DblistController {

	public $uses=array(
		"Groupcategoryparent",
		"Groupcategory",
		"Dblist",
	);

	public $components=array(
		"Db",
		"Csv",
	);

	//モデル名を設定
	public $Model_c="Groupcategoryparent";
	public $Model_m="Groupcategory";
	public $Model_cid="groupcategoryparent_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"グループカテゴリー(親)",
			"subtitle2"=>"子カテゴリー",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("グループカテゴリー名","登録件数"));
		parent::index($page);

	}
	public function view($id,$page=1){
		$this->set("tab",array("グループカテゴリー名","登録件数","カテゴリー名"));
		parent::view($id,$page);
	}
	public function inputedit($sid,$id=""){
		$this->set("tab",array("グループカテゴリー名","登録件数","カテゴリー名"));
		parent::inputedit($sid,$id);
	}
}
