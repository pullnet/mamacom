<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	スキルリスト管理画面						*/
/*	SkillController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class SkillController extends DblistController {

	public $uses=array(
		"Skillcategory",
		"Skill",
		"Dblist",
	);

	public $components=array(
		"Db",
		"Csv",
	);

	//モデル名を設定
	public $Model_c="Skillcategory";
	public $Model_m="Skill";
	public $Model_cid="skillcategory_id";

	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
		$this->set("view",array(
			"title"=>"スキルカテゴリー",
			"subtitle2"=>"スキル",
			"model_parent"=>$this->Model_c,
			"models"=>$this->Model_m,
			"models_parentid"=>$this->Model_cid,
		));
	}
	public function index($page=1){
		$this->set("tab",array("スキルカテゴリー名","登録件数"));
		parent::index($page);
	}
	public function view($id,$page=1){
		$this->set("tab",array("スキルカテゴリー名","登録件数","スキル名"));
		parent::view($id,$page=1);
	}
	public function inputedit($sid,$id=""){
		$this->set("tab",array("スキルカテゴリー名","登録件数","スキル名"));
		parent::inputedit($sid,$id);
	}

}
