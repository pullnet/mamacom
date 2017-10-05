<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	地域リスト管理画面						*/
/*	LocationController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class LocationController extends DblistController {

	public $uses=array(
		"Locationcategory",
		"Locationarea",
		"Dblist",
	);

	public $components=array(
		"Db",
		"Csv",
	);

	//モデル名を設定
	public $Model_c="Locationcategory";
	public $Model_m="Locationarea";
	public $Model_cid="locationcategory_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"地域カテゴリー",
			"subtitle"=>"地域",
			"subtitle2"=>"都道府県",
			"addtitle"=>"新規地域追加",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("地区名","登録件数"));
		parent::index($page);

	}
	public function view($id,$page=1){
		$this->set("tab",array("地区名","登録件数","都道府県名"));
		parent::view($id,$page);
	}
	public function inputedit($sid,$id=""){
		$this->set("tab",array("地区名","登録件数","都道府県名"));
		parent::inputedit($sid,$id);
	}
}
