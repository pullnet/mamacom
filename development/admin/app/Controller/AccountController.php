<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	管理アカウント画面						*/
/*	AccountController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class AccountController extends AppController {

	public $uses=array("Admin");

	public $components=array(
		"Csv",
	);

	//★前処理
	public function beforeFilter(){
		parent::beforeFilter();
	}
	//★管理アカウント一覧
	public function index($page=1){
		$limit=100;
		$this->set("page",$page);
		$this->set("limit",$limit);

		//管理アカウント情報をロード(paginate)
		$result=$this->Admin->find("all",array(
			"order"=>array("Admin.refreshdate"=>"desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$result=$this->Admin->find("count",array(
		));
		$this->set("totalcount",$totalcount);
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalpage",$totalpage);


	}
	//★管理アカウント詳細
	public function view(){

	}
	//★管理アカウント編集
	public function edit($id=""){
		//postがある場合
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション(ただしパスワードが入力されていない場合は外す)
			if($data["Admin"]["password_1"]=="" && $data["Admin"]["password_2"]=="")
			{
				unset($this->Admin->validate["password_1"]);
				unset($this->Admin->validate["password_2"]);
			}
			$this->Admin->set($data);
			if($this->Admin->validates())
			{
				//登録処理
				//idが空の場合はunset
				if($data["Admin"]["id"]==""){ unset($data["Admin"]["id"]); }
				
				//パスワードが含まれている場合は、ハッシュ化して保存
				if($data["Admin"]["password_1"])
				{
					$data["Admin"]["password"]=$this->Auth->password($data["Admin"]["password_1"]);
				}

				//コンテンツ管理アプリIDの更新....
				$data["Admin"]["item_app_id"]=md5(uniqId(date("YmdHis")));


				//管理番号の生成(無ければ)
				if(!$data["Admin"]["admin_number"])
				{
					$data["Admin"]["admin_number"]=md5(uniqId(date("YmdHis")).$data["Admin"]["username"]);
				}

				//レコードに保存
				$this->Admin->save($data,false);

				//sessionにメッセージ送信後、リダイレクト
				$this->Session->write("alert","アカウントを一件更新しました");
				$this->redirect(array("controller"=>"account","action"=>"index"));
			}
		}

		//$idがある場合
		if($id)
		{
			//データを抽出して,postさせる
			$post=$this->Admin->find("first",array(
				"conditions"=>array("Admin.id"=>$id),
			));
			$this->request->data=$post;
		}
	}
	//★一覧情報をcsv出力
	public function dataexport(){
		$this->layout=false;

		$result=$this->Admin->find("all");
		$result_key=array_keys($result[0]["Admin"]);
		$dat=$this->Csv->makecsv($result_key,$result,"Admin");
		
		$this->set("filename","Admin_data.csv");
		$this->set("html",$dat);

		$this->Render("../Csv/dataexport");
	}
	
	//★地区・削除
	public function delete($id){
		
		$this->autoRender=false;
		
		//idでItemcategoryテーブルデータ取得
		$result=$this->Admin->find("first",array(
			'conditions' => array(
				'Admin.id' => $id,
			)
		));
		//idでItemcategoryテーブルデータ削除
		$this->Admin->delete($id);
		
		//テキスト表示とリダイレクト
		$this->Session->write("alert", "地区を削除いたしました。");
		$this->redirect(array("controller"=>"account","action"=>"index"));

	}	
	
}
