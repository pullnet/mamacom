<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	サイト基本設定							*/
/*	HpsetController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class HpsetController extends AppController {

	public $uses=array(
		"Sitedefault",
		"Defaultbasic",
		"Defaultopeninfo",
		"Defaultother",
		"Defaulttoppage",
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
	//★サイト基本設定画面
	public function basic(){

		//メッセージあれば受信してset
		if($this->Session->read("alert"))
		{
			$this->set("alert",$this->Session->read("alert"));
			$this->Session->delete("alert");
		}

		//postデータがあるかどうか
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション
			$this->Defaultbasic->set($data);
			if($this->Defaultbasic->validates())
			{
				//DBに保存
				//キー値を設定
				$keys=array_keys($data["Defaultbasic"]);

				$count=0;
				foreach($keys as $k_)
				{
					$outputdata["Sitedefault"]=array();
					//すでに項目があるかどうかチェック
					$append=$this->Sitedefault->find("first",array(
						"conditions"=>array("Sitedefault.name"=>$k_),
					));

					//あればIDを返す
					if($append)
					{
						$outputdata["Sitedefault"]["id"]=$append["Sitedefault"]["id"];
					}
					//なければIDは空
					else
					{
						$outputdata["Sitedefault"]["id"]="";
					}

					$outputdata["Sitedefault"]["name"]=$k_;//項目をセット
					$outputdata["Sitedefault"]["value"]=$data["Defaultbasic"][$k_];//値をセット

					//各レコードごとにセーブ
					$this->Sitedefault->save($outputdata,false);

					$count++;
				}

				//終わったらメッセージ送信してリダイレクト
				$this->Session->write("alert","サイト基本情報を更新しました");
				$this->redirect(array("controller"=>"hpset","action"=>"basic"));
			}
		}
		else
		{
			//postが無ければ、情報をロードしてpost
			$result=$this->Sitedefault->find("list",array(
				"fields"=>array("name","value"),
			));
			$this->request->data["Defaultbasic"]=$result;
		}

	}
	/*
	//★メール送信テスト用メソッド
	public function sendmailtest()
	{
		//postがある場合
		if($this->request->data){
			$data=$this->request->data;

			//送信テスト
			$result=$this->Sendmail->sendmailtest($data["test"]["sendemail"]);

			//リダイレクト
			$this->redirect(array("controller"=>"hpset","action"=>"basic"));
		}

	}
	*/
	/*
	//★公開情報設定画面
	public function openinfo(){
		
		//都道府県リストをset
		$this->set("locationarea",$this->Db->locationarea());

		//メッセージあれば受信してset
		if($this->Session->read("alert"))
		{
			$this->set("alert",$this->Session->read("alert"));
			$this->Session->delete("alert");
		}

		//POSTされているかどうか
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション
			$this->Defaultopeninfo->set($data);
			if($this->Defaultopeninfo->validates())
			{
				//DBに保存
				//キー値を設定
				$keys=array_keys($data["Defaultopeninfo"]);
				debug($keys);

				$count=0;
				foreach($keys as $k_)
				{
					$outputdata["Sitedefault"]=array();
					//すでに項目があるかどうかチェック
					$append=$this->Sitedefault->find("first",array(
						"conditions"=>array("Sitedefault.name"=>$k_),
					));

					//あればIDを返す
					if($append)
					{
						$outputdata["Sitedefault"]["id"]=$append["Sitedefault"]["id"];
					}
					//なければIDは空
					else
					{
						$outputdata["Sitedefault"]["id"]="";
					}

					$outputdata["Sitedefault"]["name"]=$k_;//項目をセット
					$outputdata["Sitedefault"]["value"]=$data["Defaultopeninfo"][$k_];//値をセット

					//各レコードごとにセーブ
					$this->Sitedefault->save($outputdata,false);

					$count++;
				}

				//終わったらメッセージ送信してリダイレクト
				$this->Session->write("alert","公開情報設定を更新しました");
				$this->redirect(array("controller"=>"hpset","action"=>"openinfo"));
			}
		}
		else
		{
			//postが無ければ、情報をロードしてpost
			$result=$this->Sitedefault->find("list",array(
				"fields"=>array("name","value"),
			));
			$this->request->data["Defaultopeninfo"]=$result;
		}

	}
	*/
	
	/*
	//★トップページ設定画面
	public function toppage(){

		if($this->Session->read("alert")){
			$this->set("alert",$this->Session->read("alert"));
			$this->Session->delete("alert");
		}

		//POSTされているかどうか
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション
			$this->Defaulttoppage->set($data);
			if($this->Defaulttoppage->validates())
			{
				//DBに保存
				//キー値を設定
				$keys=array_keys($data["Defaulttoppage"]);
				debug($keys);

				$count=0;
				foreach($keys as $k_)
				{
					$outputdata["Sitedefault"]=array();
					//すでに項目があるかどうかチェック
					$append=$this->Sitedefault->find("first",array(
						"conditions"=>array("Sitedefault.name"=>$k_),
					));

					//あればIDを返す
					if($append)
					{
						$outputdata["Sitedefault"]["id"]=$append["Sitedefault"]["id"];
					}
					//なければIDは空
					else
					{
						$outputdata["Sitedefault"]["id"]="";
					}

					$outputdata["Sitedefault"]["name"]=$k_;//項目をセット
					$outputdata["Sitedefault"]["value"]=$data["Defaulttoppage"][$k_];//値をセット

					//各レコードごとにセーブ
					$this->Sitedefault->save($outputdata,false);

					$count++;
				}

				//終わったらメッセージ送信してリダイレクト
				$this->Session->write("alert","トップページ設定を更新しました");
				$this->redirect(array("controller"=>"hpset","action"=>"toppage"));

			}

		}
		else
		{
			//postが無ければ、情報をロードしてpost
			$result=$this->Sitedefault->find("list",array(
				"fields"=>array("name","value"),
			));
			$this->request->data["Defaulttoppage"]=$result;
		}

	}
	*/
	/*
	//★その他設定画面
	public function other(){

		//メッセージあれば受信してset
		if($this->Session->read("alert"))
		{
			$this->set("alert",$this->Session->read("alert"));
			$this->Session->delete("alert");
		}

		//POSTされているかどうか
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション
			$this->Defaultother->set($data);
			if($this->Defaultother->validates())
			{
				//DBに保存
				//キー値を設定
				$keys=array_keys($data["Defaultother"]);
				debug($keys);

				$count=0;
				foreach($keys as $k_)
				{
					$outputdata["Sitedefault"]=array();
					//すでに項目があるかどうかチェック
					$append=$this->Sitedefault->find("first",array(
						"conditions"=>array("Sitedefault.name"=>$k_),
					));

					//あればIDを返す
					if($append)
					{
						$outputdata["Sitedefault"]["id"]=$append["Sitedefault"]["id"];
					}
					//なければIDは空
					else
					{
						$outputdata["Sitedefault"]["id"]="";
					}

					$outputdata["Sitedefault"]["name"]=$k_;//項目をセット
					$outputdata["Sitedefault"]["value"]=$data["Defaultother"][$k_];//値をセット

					//各レコードごとにセーブ
					$this->Sitedefault->save($outputdata,false);

					$count++;
				}

				//終わったらメッセージ送信してリダイレクト
				$this->Session->write("alert","その他設定情報を更新しました");
				$this->redirect(array("controller"=>"hpset","action"=>"other"));
			}
		}
		else
		{
			//postが無ければ、情報をロードしてpost
			$result=$this->Sitedefault->find("list",array(
				"fields"=>array("name","value"),
			));
			$this->request->data["Defaultother"]=$result;
		}

	}
	public function datacontrol(){
		
	}
	//サイト基本情報のcsvエクスポート
	public function dataexport(){
		$this->layout=false;

		$result=$this->Sitedefault->find("all");
		$result_key=array_keys($result[0]["Sitedefault"]);
		$dat=$this->Csv->makecsv($result_key,$result,"Sitedefault");
		
		$this->set("filename","sitedefault_data.csv");
		$this->set("html",$dat);

	}
	//サイト基本情報のcsvインポート
	public function dataimport(){
		$this->autoRender=false;

		if($this->request->data)
		{

		}
	}
	*/
}
