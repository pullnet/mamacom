<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	ユーザー管理用コントローラ					*/
/*	UsersController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');//サニタイズ用

class UsersController extends AppController {
	public $uses=array(
		"User",
		"Useroption",
		"Content",
		"Friend",

	);

	public $components=array(
		"Loadbasic",
		"Db",
		"Numbering",
		"Csv",
		"Other",
	);

	//★前処理
	public function beforeFilter(){
		parent::beforeFilter();
	}
	//★ユーザー一覧画面
	public function index($page=1){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);
		
		if(@$this->request->query){
			$query=$this->request->query;

			if(@$query["keyword"]){
				$cond_keyword=array(
					"Or"=>array(
						"User.username LIKE"=>"%".$query["keyword"]."%",
						"User.nickname LIKE"=>"%".$query["keyword"]."%",
						"User.mailaddress LIKE"=>"%".$query["keyword"]."%",
					),
				);
			}
		}

		$result=$this->User->find("all",array(
			"conditions"=>array(
				@$cond_keyword,
			),
			"order"=>array("User.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$this->User->find("count",array(
			"conditions"=>array(
				@$cond_keyword,
			),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

	}
	//★ユーザー詳細画面
	public function view($id){
		//メッセージ受信
		if($this->Session->read("alert"))
		{
			$this->set("alert",$this->Session->read("alert"));
			$this->Session->delete("alert");
		}

		//itemurlをset
		$this->set("itemurl",$this->Loadbasic->load("itemurl"));
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));

		$result=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$id,
			),
		));

		$useroption=$this->Useroption->find("list",array(
			"conditions"=>array(
				"Useroption.user_id"=>$result["User"]["id"],
			),
			"fields"=>array("name","value"),
		));
		$result["Useroption"]=$useroption;
		$this->set("result",$result);

		//性別リストをset
		$this->set("gender",$this->Db->gender());
		//都道府県リストをset
		$this->set("locationarea",$this->Db->locationarea(1));
		//公開設定リスト
		$this->set("openstatus",$this->Db->openstatus());
		//職種
		$this->set("job",$this->Db->job(1));
		//支払い振込方法
		$this->set("payment",$this->Db->payment());
		//クレジット決済会社
		$this->set("credit_company",$this->Db->credit_company());
	}
	//★一覧情報をcsv出力
	public function dataexport(){
		$this->layout=false;

		$result=$this->User->find("all");
		$result_key=array_keys($result[0]["User"]);
		$dat=$this->Csv->makecsv($result_key,$result,"User");
		
		$this->set("filename","User_data.csv");
		$this->set("html",$dat);

		$this->Render("../Csv/dataexport");
	}
	//★登録コラボ・ライブラリ一覧
	public function content($id){
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));

		$result=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$id,
			),
		));
		$this->set("result",$result);

		$content=$this->Content->find("all",array(
			"conditions"=>array(
				"Content.user_id"=>$id,
			),
		));
		$this->set("content",$content);
	}
	//★仲間一覧
	public function friend($id){
		$this->set("friend_status",$this->Db->friendstatus());

		$result=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$id,
			),
		));
		$this->set("result",$result);

		$result_friend=$this->Friend->find("all",array(
			"conditions"=>array(
				"OR"=>array(
					"Friend.to_user_id"=>$id,
					"Friend.from_user_id"=>$id,
				),
			),
		));
		$ind=0;
		foreach($result_friend as $rf_){
			if($rf_["Friend"]["to_user_id"]==$id){
				$userdata=$this->User->find("first",array(
					"conditions"=>array(
						"User.id"=>$rf_["Friend"]["from_user_id"],
					),
				));
				$result_friend[$ind]["User"]=$userdata["User"];
			}
			$ind++;
		}
		$this->set("result_friend",$result_friend);

	}
	//★ユーザー情報の削除
	public function delete($id){
		$this->autoRender=false;

		$this->User->delete($id);
		
		$this->Session->write("alert","ユーザー情報を削除しました");
		$this->redirect(array("controller"=>"users","action"=>"index"));
	}
}
