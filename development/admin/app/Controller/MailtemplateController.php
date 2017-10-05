<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	メールテンプレート管理画面					*/
/*	MailtemplateController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class MailtemplateController extends AppController {

	public $uses=array(
		"Mailtemplate",
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
	//★メールテンプレート一覧画面
	public function index($page=1){
		$limit=100;
		$this->set("limit",$limit);
		$this->set("page",$page);

		//テンプレート情報を抽出(paginate)
		$result=$this->Mailtemplate->find("all",array(
			"order"=>array("Mailtemplate.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$this->Mailtemplate->find("count");

		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

	}
	//★メールテンプレート編集画面
	public function edit($id=null){

		//POSTがあるとき
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション
			$this->Mailtemplate->set($data);
			if($this->Mailtemplate->validates())
			{
				//DBに登録・更新
				$this->Mailtemplate->save($data,false);

				//メッセージ送信後、リダイレクト
				$this->Session->write("alert","メールテンプレート情報を更新しました");
				$this->redirect(array("controller"=>"mailtemplate","action"=>"index"));
			}
		}

		//idがあるとき
		if($id)
		{
			
			//テンプレート情報を抽出してPOST
			$post=$this->Mailtemplate->find("first",array(
				"conditions"=>array("Mailtemplate.id"=>$id),
			));
			$this->request->data=$post;
		}
	}
	//★メールテンプレート詳細画面
	public function view($id)
	{
		//テンプレート情報を抽出
		$result=$this->Mailtemplate->find("first",array(
			"conditions"=>array("Mailtemplate.id"=>$id),
		));
		$this->set("result",$result);
	}
	//★一覧情報をcsv出力
	public function dataexport(){
		$this->layout=false;

		$result=$this->Mailtemplate->find("all");
		$result_key=array_keys($result[0]["Mailtemplate"]);
		$dat=$this->Csv->makecsv($result_key,$result,"Mailtemplate");
		
		$this->set("filename","Mailtemplate_data.csv");
		$this->set("html",$dat);

		$this->Render("../Csv/dataexport");
	}
}
