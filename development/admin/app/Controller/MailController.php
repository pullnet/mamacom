<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/08							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	メール管理用コントローラ					*/
/*	MailController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class MailController extends AppController {

	public $uses=array(
		"Maillog",
	);
	public $components=array(
		"Sendmail",
		"Db",
		"Csv",
	);

	//★前処理
	public function beforeFilter(){
		parent::beforeFilter();
	}
	//★メールログ一覧
	public function index($page=1){
		$limit=100;
		$this->set("page",$page);
		$this->set("limit",$limit);

		$this->Maillog->bindModel(array(
			"belongsTo"=>array(
				"Fromuser"=>array(
					"className"=>"User",
					"foreignKey"=>"createuserid",
				),
				"Touser"=>array(
					"className"=>"User",
					"foreignKey"=>"user_id",
				),
			),
		));
		$result=$this->Maillog->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
			"order"=>array("Maillog.send_date desc"),
		));
		$this->set("result",$result);

		$totalcount=$this->Maillog->find("count");

		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);
	}
	//★メールログ詳細
	public function detail($id){
		$this->Maillog->bindModel(array(
			"belongsTo"=>array(
				"Fromuser"=>array(
					"className"=>"User",
					"foreignKey"=>"createuserid",
				),
				"Touser"=>array(
					"className"=>"User",
					"foreignKey"=>"user_id",
				),
			),
		));
		$result=$this->Maillog->find("first",array(
			"conditions"=>array(
				"Maillog.id"=>$id,
			),
		));
		$this->set("result",$result);
	}
}
