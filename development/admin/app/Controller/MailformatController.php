<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	メールフォーマット(定型文)管理画面				*/
/*	MailformatController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class MailformatController extends AppController {

	public $uses=array(
		"Mailformat",
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
	//★メールフォーマット一覧画面
	public function index($page=1,$category=null){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);
		$this->set("category",$category);
		//メールフォーマットのカテゴリー
		$this->set("format_category",$this->Db->mailformat_category());

		//フォーマット情報を抽出
		if(@$this->request->query){
			$query=$this->request->query;

			if($query["keyword"]){
				$cond_keyword=array(
					"Or"=>array(
						"Mailformat.name LIKE"=>"%".$query["keyword"]."%",
						"Mailformat.code LIKE"=>"%".$query["keyword"]."%",
					),
				);
			}
		}

		if($category){
			$cond_category=array(
				"Mailformat.category"=>$category,
			);
		}
		$result=$this->Mailformat->find("all",array(
			"conditions"=>array(
				@$cond_keyword,
				@$cond_category,
			),
			"order"=>array("Mailformat.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$this->Mailformat->find("count",array(
			"conditions"=>array(
				@$cond_keyword,
				@$cond_category,
			),
		));

		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);
		
	}
	//★メールフォーマット編集画面
	public function edit($id=null){
		//メールフォーマット形式
		$this->set("format_status",array(0=>"テキスト",1=>"html"));
		//メールテンプレートリスト
		$this->set("mailtemplate",$this->Db->mailtemplate());
		//メールフォーマットのカテゴリー
		$this->set("format_category",$this->Db->mailformat_category());

		//POSTがあるとき
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション
			$this->Mailformat->set($data);
			if($this->Mailformat->validates())
			{
				//DBに登録・更新
				$this->Mailformat->save($data,false);

				//メッセージ送信後、リダイレクト
				$this->Session->write("alert","メールフォーマット情報を更新しました");
				$this->redirect(array("controller"=>"mailformat","action"=>"index"));
			}
		}
		//idがあるとき
		if($id)
		{
			
			//フォーマット情報を抽出してPOST
			$post=$this->Mailformat->find("first",array(
				"conditions"=>array("Mailformat.id"=>$id),
			));
			$this->request->data=$post;
		}
	}
	//★メールフォーマット詳細画面
	public function view($id){
		//メールフォーマットのカテゴリー
		$this->set("format_category",$this->Db->mailformat_category());

		//メールフォーマット形式
		$this->set("format_status",array(0=>"テキスト",1=>"html"));

		//フォーマット情報を抽出
		$this->Mailformat->bindModel(array(
			"belongsTo"=>array(
				"Mailtemplate",
			),
		));
		$result=$this->Mailformat->find("first",array(
			"conditions"=>array("Mailformat.id"=>$id),
			"recursive"=>2,
		));
		$this->set("result",$result);
	}
	//★メールフォーマットの削除
	public function delete($id,$page=1,$category=null){
		$this->autoRender=false;

		$this->Mailformat->delete($id);

		$this->Session->write("alert","メールフォーマットを１件削除しました。");
		$this->redirect(array("controller"=>"mailformat","action"=>"index",$page,$category));

	}
	//★一覧情報をcsv出力
	public function dataexport(){
		$this->layout=false;

		$result=$this->Mailformat->find("all");
		$result_key=array_keys($result[0]["Mailformat"]);
		$dat=$this->Csv->makecsv($result_key,$result,"Mailformat");
		
		$this->set("filename","Mailformat_data.csv");
		$this->set("html",$dat);

		$this->Render("../Csv/dataexport");
	}

}
