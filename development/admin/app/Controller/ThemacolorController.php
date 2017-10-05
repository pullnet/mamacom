<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	テーマカラーリスト管理画面					*/
/*	ThemacolorController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class ThemacolorController extends DblistController {

	public $uses=array(
		"Thamecolorcategory",
		"Thamecolor",
		"Dblist",
	);

	public $components=array(
		"Db",
		"Csv",
	);

	//モデル名を設定
	public $Model_c="Thamecolorcategory";
	public $Model_m="Thamecolor";
	public $Model_cid="thamecolorcategory_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"テーマカラーカテゴリー",
			"subtitle2"=>"テーマカラー",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("テーマカラーカテゴリー名","登録件数"));
		parent::index($page);
	}
	public function view($id,$page=1){
		$this->set("tab",array("テーマカラーカテゴリー名","登録件数","テーマカラー名"));
		parent::view($id,$page);
	}
	public function inputedit($sid,$id=""){
		$this->set("tab",array("テーマカラーカテゴリー名","登録件数","テーマカラー名"));
		parent::inputedit($sid,$id);
	}
}
