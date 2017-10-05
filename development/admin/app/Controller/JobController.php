<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	職種リスト管理画面						*/
/*	JobController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class JobController extends DblistController {

	public $uses=array(
		"Jobcategory",
		"Job",
		"Dblist",
	);

	public $components=array(
		"Db",
		"Csv",
	);

	//モデル名を設定
	public $Model_c="Jobcategory";
	public $Model_m="Job";
	public $Model_cid="jobcategory_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"職種カテゴリー",
			"subtitle2"=>"職種",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("職種カテゴリー名","登録件数"));
		parent::index($page);
	}
	public function view($id,$page=1){
		$this->set("tab",array("職種カテゴリー名","登録件数","職種名"));
		parent::view($id,$page);
	}
	public function inputedit($sid,$id=""){
		$this->set("tab",array("職種カテゴリー名","登録件数","職種名"));
		parent::inputedit($sid,$id);
	}
}
