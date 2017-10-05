<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	テーマレイアウトリスト管理画面					*/
/*	ThemalayoutController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class ThemalayoutController extends DblistController {

	public $uses=array(
		"Thamelayoutcategory",
		"Thamelayout",
		"Dblist",
	);

	public $components=array(
		"Db",
		"Csv",
	);

	//モデル名を設定
	public $Model_c="Thamelayoutcategory";
	public $Model_m="Thamelayout";
	public $Model_cid="thamelayoutcategory_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"テーマレイアウトカテゴリー",
			"subtitle2"=>"テーマレイアウト",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("テーマレイアウトカテゴリー名","登録件数"));
		parent::index($page);
	}
	public function view($id,$page=1){
		$this->set("tab",array("テーマレイアウトカテゴリー名","登録件数","テーマレイアウト名"));
		parent::view($id,$page);
	}
	public function inputedit($sid,$id=""){
		$this->set("tab",array("テーマレイアウトカテゴリー名","登録件数","テーマレイアウト名"));
		parent::inputedit($sid,$id);

	}
}
