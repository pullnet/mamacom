<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/20							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	メッセージ管理画面						*/
/*	TalkController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class TalkController extends AppController {

	public $uses=array(
		"User",
		"Group",
		"Content",
		"Originalmsg",
		"Messagefielduser",
		"Messagefield",
		"Message",
		"Messageread",
		"Messagezip",
	);
	public $components=array(
		"Db",
		"Loadbasic",
	);

	public function index($page=1){
		$limit=100;
		$this->set("page",$page);
		$this->set("limit",$limit);


		if(@$this->request->query){
			$query=$this->request->query;

			if(@$query["type"]){
				$cond_type=array(
					"Messagefield.field_status"=>$query["type"]-1,
				);
			}


		}

		//messagefieldを取得
		$this->Messagefield->bindModel(array(
			"hasMany"=>array(
				"Messagefielduser"=>array(
					"fields"=>array("id","messagefield_id","user_id"),
				),
				"Message"=>array(
					"fields"=>array("id","messagefield_id","talk_number"),
				),
			),
			"belongsTo"=>array(
				"Group"=>array(
					"fields"=>array("id","name"),
				),
				"Content"=>array(
					"foreignKey"=>"collabo_content_id",
					"fields"=>array("id","title"),
				),
			),
		));
		$this->Messagefield->Messagefielduser->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","username","nickname"),
				),
			),
		));
		$result=$this->Messagefield->find("all",array(
			"conditions"=>array(
				@$cond_type,
			),
			"fields"=>array("id","field_status","group_id","createdate","collabo_content_id"),
			"order"=>array("Messagefield.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
			"recursive"=>2,
		));
		$this->set("result",$result);

		$totalcount=$this->Messagefield->find("count",array(
			"conditions"=>array(
				@$cond_type,
			),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

	}

	public function lists($id){
		//ユーザーリストを取得
		$result=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$id,
			),
		));
		$this->set("result",$result);


		//messagefieldを取得
		$this->Messagefielduser->bindModel(array(
			"belongsTo"=>array(
				"Messagefield",
			),
		));
		$this->Messagefielduser->Messagefield->bindModel(array(
			"hasOne"=>array(
				"Messagefielduser"=>array(
					"conditions"=>array(
						"NOT"=>array("Messagefielduser.user_id"=>$id),
					),
				),
				"Message"=>array(
					"order"=>"Message.createdate desc",
				),
			),
		));
		$this->Messagefielduser->Messagefield->Messagefielduser->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","username","nickname"),
				),
			),
		));
		$this->paginate=array(
			"Messagefielduser"=>array(
				"conditions"=>array(
					"Messagefielduser.user_id"=>$id,
				),
				"recursive"=>3,
			),
		);
		$result_mf=$this->paginate("Messagefielduser");
		$this->set("result_mf",$result_mf);
	}
	//●メッセージフィールド編集フォーム
	public function edit($id=null){


		$this->Group->bindModel(array(
			"hasMany"=>array(
				"Groupuser",
			),
		));
		$this->Group->Groupuser->bindModel(array(
			"belongsTo"=>array(
				"User",
			),
		));
		$friend_buff=$this->Group->find("all",array(
			"conditions"=>array(
				"Group.status"=>0,
			),
			"recursive"=>2,
		));
		$friend_list=array();
		foreach($friend_buff as $fb_){
			$buff=$fb_["Groupuser"][0]["User"]["nickname"]."__".$fb_["Groupuser"][1]["User"]["nickname"];
			$friend_list[$fb_["Group"]["id"]]=$buff;
		}
		$this->set("friend_list",$friend_list);


		//グループリストを取得
		$group_list=$this->Group->find("list",array(
			"conditions"=>array(
				"Group.status"=>1,
			),
			"fields"=>array("id","name"),
		));
		$this->set("group_list",$group_list);

		//コラボリストを取得
		$collabo_list=$this->Content->find("list",array(
			"conditions"=>array(
				"Content.status"=>0,
			),
			"fields"=>array("id","title"),
		));
		$this->set("collabo_list",$collabo_list);


		//POSTされている場合
		if($this->request->data){
			$data=$this->request->data;

			if($data["Messagefield"]["field_status"]==3){
				$data["Messagefield"]["group_id"]=$data["Messagefield"]["friend_id"];
			}

			$result_data=$this->Messagefield->save($data,false);
			
			$this->Session->write("alert","メッセージフィールドを設定しました");
			$this->redirect(array("controller"=>"talk","action"=>"view",$result_data["Messagefield"]["id"]));
		}
		else
		{
			//POSTされていない場合
			if($id){
				$this->Messagefield->bindModel(array(
					"hasMany"=>array(
						"Messagefielduser",
					),
				));
				$this->Messagefield->Messagefielduser->bindModel(array(
					"belongsTo"=>array(
						"User",
					),
				));
				$post=$this->Messagefield->find("first",array(
					"conditions"=>array(
						"Messagefield.id"=>$id,
					),
					"recursive"=>2,
				));
				if($post["Messagefield"]["field_status"]==3){
					$post["Messagefield"]["friend_id"]=$post["Messagefield"]["group_id"];
				}
				$this->request->data=$post;

			}
		}

	}
	//●メッセージフィールド詳細画面
	public function view($id,$page=1){

		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);
		$this->set("id",$id);

		//メッセージフィールド情報を取得
		$this->Messagefield->bindModel(array(
			"hasMany"=>array(
				"Messagefielduser"=>array(
					"fields"=>array("id","messagefield_id","user_id"),
				),
			),
			"belongsTo"=>array(
				"Group"=>array(
					"fields"=>array("id","name"),
				),
				"Content"=>array(
					"foreignKey"=>"collabo_content_id",
				),
			),
		));
		$this->Messagefield->Messagefielduser->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","username","nickname"),
				),
			),
		));

		$mfdata=$this->Messagefield->find("first",array(
			"conditions"=>array(
				"Messagefield.id"=>$id,
			),
			"recursive"=>2,
		));
		$this->set("result_mf",$mfdata);

		//メッセージ情報
		$this->Message->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","username","nickname"),
				),
			),
			"hasMany"=>array(
				"Messagezip",
			),

		));
		$result_m=$this->Message->find("all",array(
			"conditions"=>array(
				"Message.messagefield_id"=>$id,
			),
			"order"=>"Message.talk_number desc",
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result_m",$result_m);

		$totalcount=$this->Message->find("count",array(
			"conditions"=>array(
				"Message.messagefield_id"=>$id,
			),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

	}
	//●メッセージフィールド削除処理
	public function delete($id){
		$this->autoRender=false;

		$this->Messagefield->bindModel(array(
			"hasMany"=>array(
				"Messagefielduser"=>array(
					"dependent"=>true,
				),
				"Message"=>array(
					"dependent"=>true,
				),
			),
		));
		$this->Messagefield->delete($id);

		$this->Session->write("alert","メッセージフィールド情報を１件削除しました");
		$this->redirect(array("controller"=>"talk","action"=>"index"));
		
	}
	//●メッセージ詳細画面
	public function msgview($id){
		//メッセージ情報を取得
		$this->Message->bindModel(array(
			"belongsTo"=>array(
				"Messagefield",
				"User"=>array(
					"fields"=>array("id","username","nickname"),
				),
			),
			"hasMany"=>array(
				"Messagezip",
			),
		));
		$result=$this->Message->find("first",array(
			"conditions"=>array(
				"Message.id"=>$id,
			),
			"recursive"=>2,
		));
		$this->set("result",$result);

		//itemurlをset
		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

	}
	//●メッセージ編集画面
	public function msgedit($fid,$id=null){
		//メッセージフィールド情報を取得
		$this->Messagefield->bindModel(array(
			"hasMany"=>array(
				"Messagefielduser"=>array(
					"fields"=>array("id","messagefield_id","user_id"),
				),
			),
			"hasOne"=>array(
				"Message"=>array(
					"order"=>"Message.talk_number desc",//新着のtalk_number
				),
			),
		));
		$this->Messagefield->Messagefielduser->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","username","nickname"),
				),
			),
		));

		$mfdata=$this->Messagefield->find("first",array(
			"conditions"=>array(
				"Messagefield.id"=>$fid,
			),
			"recursive"=>2,
		));
		$this->set("result_mf",$mfdata);

		//発信ユーザーリスト
		$userlist=array();
		foreach($mfdata["Messagefielduser"] as $mff_){
			$userlist[$mff_["user_id"]]=$mff_["User"]["username"]."[".$mff_["User"]["nickname"]."]さん";
		}
		$this->set("userlist",$userlist);

		//POSTされている場合
		if($this->request->data){
			$data=$this->request->data;

			//投稿日が空の場合は今日の日時を自動入力
			if(!$data["Message"]["send_date"]){
				$data["Message"]["send_date"]=date("Y-m-d H:i:s");
			}

			//メッセージ情報をsave
			$this->Message->save($data,false);

			//メッセージ受信して、リダイレクト
			$this->Session->write("alert","メッセージを1件設定しました");
			$this->redirect(array("controller"=>"talk","action"=>"view",$fid));
		}
		else
		{
			if($id){
				//$idがあればメッセージ情報をpost
				$post=$this->Message->find("first",array(
					"conditions"=>array(
						"Message.id"=>$id,
					),
				));
				$this->request->data=$post;
				$this->set("next_talk_number",$post["Message"]["talk_number"]);

			}
			else
			{
				//新規登録の場合は次のtalk_numberをset
				$this->set("next_talk_number",$mfdata["Message"]["talk_number"]+1);
			}

		}

	}
	//★添付データ編集画面
	public function msgzipedit($mid,$id=null){
		//メッセージ情報を取得
		$result_m=$this->Message->find("first",array(
			"conditions"=>array(
				"Message.id"=>$mid,
			),
		));
		$this->set("result_m",$result_m);


		//POSTがある場合
		if($this->request->data){
			$data=$this->request->data;

			$this->Messagezip->set($data);
			if($this->Messagezip->validates()){

				//ここでMessagezipにsave
				$this->Messagezip->save($data,false);

				//バッファデータを本番にアップロード
				//getパラメータ付きのURLを作成

				//itemurlをset
				$itemurl=$this->Loadbasic->load("itemurl");

				$upurl=$itemurl."content/save?";
				$upurl.="app_id=".$this->admindata["Admin"]["item_app_id"]."&";//アプリIDを指定
				$upurl.="directory=msgzip&";//アプリIDを指定
				$upurl.="source=".Router::url("/",true)."buffer/Admin/".$this->admindata["Admin"]["admin_number"]."/".$data["Messagezip"]["data_tag"].".data&";//ソース(バッファのデータパス)指定
				$upurl.="write_tag=".$data["Messagezip"]["data_tag"];//タグ番号

				//curlで画像変更手続き
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $upurl);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//4/28追加　CURLはSSL接続したものに対してはバグるのでそれ会費用
				$result_curl = curl_exec($ch);
				curl_close($ch);

				//終わったらメッセージ送信して一覧画面へリダイレクト
				$this->Session->write("alert","メッセージ情報を更新しました");
				$this->redirect(array("controller"=>"talk","action"=>"msgview",$result_m["Message"]["id"]));

			}

		}
		else
		{

		}
	}

	//★コラボス運営メッセージ管理
	public function originalmsg(){
		//メッセージ情報を取得
		$result_m=$this->Message->find("all",array(
			"conditions"=>array(
				"Message.messagefield_id"=>0,
			),
		));
		$this->set("result_m",$result_m);

	}
	//★コラボス運営メッセージ編集
	public function originalmsg_add(){
		if($this->request->data){
			$post=$this->request->data;

			$this->Originalmsg->set($post);
			if($this->Originalmsg->validates()){

				//最新のMessage情報を取得..
				$now_msgadata=$this->Message->find("first",array(
					"conditions"=>array(
						"Message.messagefield_id"=>0,
					),
					"order"=>array("Message.talk_number desc"),
				));


				$savedata=array(
					"Message"=>array(
						"id"=>"",
						"message"=>$post["Originalmsg"]["message"],
						"talk_number"=>$now_msgadata["Message"]["talk_number"]+1,
						"messagefield_id"=>0,
						"send_date"=>date("Y-m-d H:i:s"),
						"html_status"=>1,
					),
				);
				$result_msg=$this->Message->save($savedata,false);

				$userlist=$this->User->find("all",array(
					"conditions"=>array(
						"User.role"=>1,
					),
				));
				foreach($userlist as $u_){
					$save_read=array(
						"Messageread"=>array(
							"id"=>"",
							"user_id"=>$u_["User"]["id"],
							"message_id"=>$result_msg["Message"]["id"],
						),
					);
					$this->Messageread->save($save_read,false);
				}

				//メールの送信通知は、転送上限に引っかかる恐れがある為、初期段階ではあえて入れない...。
				//言われてからしてねww

				$this->Session->write("alert","メッセージを設定しました");
				$this->redirect(array("controller"=>"talk","action"=>"originalmsg"));
			}
		}

	}
}
