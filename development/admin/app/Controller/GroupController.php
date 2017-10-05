<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/16							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	グループ管理画面						*/
/*	GroupController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class GroupController extends AppController {

	public $uses=array(
		"User",
		"Group",
		"Groupuser",
	);

	public $components=array(
		"Db",
		"Loadbasic",
	);

	public function beforeFilter(){
		parent::beforeFilter();
		
	}
	//★全グループ一覧画面
	public function index($page=1){
		$limit=100;
		$this->set("limit",$limit);
		$this->set("page",$page);
		$this->set("leader_status",array(0=>"通常メンバー",1=>"グループリーダー"));

		//すべてのグループユーザー情報を取得
		$this->Group->bindModel(array(
			"hasMany"=>array(
				"Groupuser"=>array(
					"conditions"=>array(
						"Groupuser.leader_status"=>0,
					),
					"fields"=>array("id","user_id","leader_status","group_id","group_status"),
				),
			),
			"hasOne"=>array(
				"Groupleader"=>array(
					"className"=>"Groupuser",
					"conditions"=>array(
						"Groupleader.leader_status"=>1,
					),
					"fields"=>array("id","user_id","leader_status","group_id","group_status"),
				),
			),
		));
		$this->Group->Groupleader->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","nickname","username"),
				),
			),
		));
		$result=$this->Group->find("all",array(
			"conditions"=>array(
				"Group.status"=>1,
			),
			"order"=>array("Group.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
			"recursive"=>3,
		));

		$this->set("result",$result);

		$totalcount=$this->Group->find("count");
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);


	}
	//★ユーザーのグループ一覧画面
	public function lists($userid){
		//ユーザー情報を取得
		$result=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$userid,
			),
		));
		$this->set("result",$result);

		//グループユーザー情報を取得
		$this->Groupuser->bindModel(array(
			"belongsTo"=>array(
				"Group",
			),
		));
		$this->paginate=array(
			"Groupuser"=>array(
				"conditions"=>array(
					"Groupuser.user_id"=>$userid,
				),
			),
		);

		$result_group=$this->paginate("Groupuser");
		$this->set("result_group",$result_group);

		$this->set("leader_status",array(0=>"通常メンバー",1=>"グループリーダー"));

	}
	public function view($id){
		//メッセージ情報を取得
		if($this->Session->read("alert")){
			$this->set("alert",$this->Session->read("alert"));
			$this->Session->delete("alert");
		}


		//グループ情報を取得
		$this->Group->bindModel(array(
			"hasMany"=>array(
				"Groupuser",
			),
		));
		$this->Group->Groupuser->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","nickname","username"),
				),
			),
		));
		$result=$this->Group->find("first",array(
			"conditions"=>array(
				"Group.id"=>$id,
			),
			"recursive"=>2,
		));
		$this->set("result",$result);

		$this->set("itemurl",$this->Loadbasic->load("itemurl"));
		$this->set("group_status",array(0=>"公開",1=>"会員のみ")); 
		$this->set("leader_status",array(0=>"通常メンバー",1=>"リーダー"));
		$this->set("status",array(0=>"申請中",1=>"申請中",2=>"承認許可",3=>"承認拒否",4=>"メンバー脱退"));
	}
	public function edit($id=null){

		$this->set("groupcategory",$this->Db->groupcategory(1));
		$this->set("group_status",array(0=>"公開",1=>"会員のみ")); 
		$this->set("itemurl",$this->Loadbasic->load("itemurl"));

		if(isset($this->params["named"]["user_id"]))
		{
			$this->set("user_id",$this->params["named"]["user_id"]);
			$user_nickname=$this->User->find("first",array(
				"condition"=>array(
					"User.id"=>$this->params["named"]["user_id"],
				),
				"fields"=>array("id","nickname"),
			));
			$this->set("user_nickname",$user_nickname["User"]["nickname"]);
		}
		else
		{
			$userdata=$this->User->find("all",array(
				"conditions"=>array(
					"User.role"=>1,
				),
				"fields"=>array("id","nickname","username"),
			));
		}

		$userlist=array();
		foreach($userdata as $u_)
		{
			$userlist[$u_["User"]["id"]]=$u_["User"]["username"]." - ".$u_["User"]["nickname"];
		}
		$this->set("userlist",$userlist);
		
		//POSTされている場合
		if($this->request->data){
			$data=$this->request->data;

			$this->Group->set($data);
			if($this->Group->validates()){

				//Groupをsave
				$result=$this->Group->save($data,false);

				//リーダー分のGroupuser情報をsave(idが空の場合のみ)
				if(!$data["Group"]["id"])
				{
					$userdata=array(
						"Groupuser"=>array(
							"id"=>"",
							"group_id"=>$result["Group"]["id"],
							"user_id"=>$data["Group"]["leader_user_id"],
							"leader_status"=>1,
						),
					);

					$this->Groupuser->save($userdata,false);
				}

				$setuserdata=$this->User->find("first",array(
					"conditions"=>array(
						"User.id"=>$data["Group"]["leader_user_id"],
					),
					"fields"=>array("id","item_app_id"),
				));

				//アイコン画像をアップロード
				//getパラメータ付きのURLを作成
				$itemurl=$this->Loadbasic->load("itemurl");
				$upurl=$itemurl."content/savesmp?";
				$upurl.="app_id=".$setuserdata["User"]["item_app_id"]."&";//アプリIDを指定
				$upurl.="directory=groupicon&";//ディレクトリを指定
				$upurl.="source=".Router::url("/",true)."buffer/Admin/".$this->admindata["Admin"]["admin_number"]."/".$data["Group"]["icontag"]."&";//ソース(バッファのデータパス)指定
				$upurl.="write_tag=".$data["Group"]["icontag"];//タグ番号

				//curlで画像変更手続き
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $upurl);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//4/28追加　CURLはSSL接続したものに対してはバグるのでそれ会費用
				$result_curl = curl_exec($ch);
				curl_close($ch);

				//メッセージ送信後、リダイレクト
				$this->Session->write("alert","グループを１件設定しました");
				$this->redirect(array("controller"=>"group","action"=>"view",$result["Group"]["id"]));
			}

		}
		else
		{
			if($id){
				$this->Group->bindModel(array(
					"hasOne"=>array(
						"Groupuser"=>array(
							"conditions"=>array(
								"Groupuser.leader_status"=>1,
							),
						),
					),
				));
				$post=$this->Group->find("first",array(
					"conditions"=>array(
						"Group.id"=>$id,
					),
				));
				$this->request->data=$post;
				$this->set("post",$post);

				$user_nickname=$this->User->find("first",array(
					"conditiosn"=>array(
						"User.id"=>$post["Groupuser"]["user_id"],
					),
					"fields"=>array("id","nickname"),
				));
				$this->set("user_nickname",$user_nickname["User"]["nickname"]);
				$this->set("user_id",$user_nickname["User"]["id"]);

			}

		}
	}
	//★グループメンバー編集
	public function memberedit($groupid,$memberid=null){
		//グループ情報をロード
		$groupdata=$this->Group->find("first",array(
			"conditions"=>array(
				"Group.id"=>$groupid,
			),
		));
		$this->set("result_group",$groupdata);

		if($this->request->data){
			$data=$this->request->data;

			$this->Groupuser->save($data,false);

			//メッセージ送信後、リダイレクト
			$this->Session->write("alert","グループメンバーを１件設定しました");
			$this->redirect(array("controller"=>"group","action"=>"view",$groupid));
		}
		else
		{
			if($memberid){
				$this->Groupuser->bindModel(array(
					"belongsTo"=>array(
						"User",
					),
				));
				$userdata=$this->Groupuser->find("first",array(
					"conditions"=>array(
						"Groupuser.id"=>$memberid,
					),
					"recursive"=>2,
				));
				$this->set("result_user",$userdata);
				$this->request->data=$userdata;
			}
			else
			{
				$userbuff=$this->User->find("all",array(
					"conditions"=>array(
						"User.role"=>1,
					),
					"fields"=>array("id","username","nickname"),
				));
				$userlist=array();
				foreach($userbuff as $u_)
				{
					$userlist[$u_["User"]["id"]]=$u_["User"]["username"]." - ".$u_["User"]["nickname"];
				}

				$this->set("userlist",$userlist);

			}
		}
	}
}
