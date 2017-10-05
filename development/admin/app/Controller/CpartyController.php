<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/09							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ参加表明管理用コントローラ				*/
/*	CpartyController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class CpartyController extends AppController {

	public $uses=array(
		"Collaboparty",
		"Collabopartylog",
		"User",
	);
	public $components=array(
		"Db",
		"Loadbasic",
	);
	//★コラボ参加表明一覧
	public function index($page=1){
		$this->set("partystatus",$this->Db->partystatus());

		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);

		if(@$this->request->query){
			$query=$this->request->query;

			if(@$query["keyword"]){
				$cond_keyword=array(
					"Collaboparty.number LIKE"=>"%".$query["keyword"]."%",
				);
			}

			if(@$query["party_status"]){
				$cond_order_status=array(
					"Collaboparty.party_status"=>$query["party_status"],
				);

			}

		}

		$this->Collaboparty->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
			"belongsTo"=>array(
				"User",
			),
		));
		$result=$this->Collaboparty->find("all",array(
			"conditions"=>array(
				@$cond_keyword,
				@$cond_type,
				@$cond_order_status,
			),
			"order"=>array("Collaboparty.party_date desc"),
			"limit"=>$limit,
			"page"=>$page,
			"recursive"=>2,
		));
		$ind=0;
		foreach($result as $r_){
			$sort=json_decode($r_["Contentbuffer"]["buffer"],true);
			$result[$ind]["Contentbuffer"]=$sort;

			$owner=$this->User->find("first",array(
				"conditions"=>array(
					"User.id"=>$sort["Content"]["user_id"],
				),

			));
			$result[$ind]["Owner"]=$owner["User"];
			$ind++;
		}
		$this->set("result",$result);

		$totalcount=$this->Collaboparty->find("count",array(
			"conditions"=>array(
				@$cond_keyword,
				@$cond_type,
				@$cond_order_status,
			),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

	}
	//★コラボ参加表明詳細画面
	public function detail($id){
		$this->set("partystatus",$this->Db->partystatus());
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));

		$this->Collaboparty->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
		));
		$result=$this->Collaboparty->find("first",array(
			"conditions"=>array(
				"Collaboparty.id"=>$id,
			),
		));
		$result["Contentbuffer"]=json_decode($result["Contentbuffer"]["buffer"],JSON_UNESCAPED_UNICODE);
		$user_1=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$result["Contentbuffer"]["Content"]["user_id"],
			),
		));
		$user_2=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$result["Collaboparty"]["user_id"],
			),
		));
		$result["User_1"]=$user_1["User"];
		$result["User_2"]=$user_2["User"];
		$this->set("result",$result);

		//ログ情報を取得
		$logdata=$this->Collabopartylog->find("all",array(
			"conditions"=>array(
				"Collabopartylog.collaboparty_id"=>$result["Collaboparty"]["id"],
			),
			"order"=>array("Collabopartylog.change_date desc"),
		));
		$this->set("logdata",$logdata);
		
	}
	public function edit($id){
		$this->set("partystatus",$this->Db->partystatus());
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));

		$this->Collaboparty->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
		));
		$result=$this->Collaboparty->find("first",array(
			"conditions"=>array(
				"Collaboparty.id"=>$id,
			),
		));

		$result["Contentbuffer"]=json_decode($result["Contentbuffer"]["buffer"],JSON_UNESCAPED_UNICODE);
		$user_1=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$result["Contentbuffer"]["Content"]["user_id"],
			),
		));
		$user_2=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$result["Collaboparty"]["user_id"],
			),
		));
		$result["User_1"]=$user_1["User"];
		$result["User_2"]=$user_2["User"];
		$this->set("result",$result);

		//ログ情報を取得
		$logdata=$this->Collabopartylog->find("all",array(
			"conditions"=>array(
				"Collabopartylog.collaboparty_id"=>$result["Collaboparty"]["id"],
			),
			"order"=>array("Collabopartylog.change_date asc"),
		));
		$this->set("logdata",$logdata);

		if($this->request->data){
			$post=$this->request->data;
			if(
				$post["Collaboparty"]["hope_price"]==$result["Collaboparty"]["hope_price"] && 
				$post["Collaboparty"]["comment"]==$result["Collaboparty"]["comment"]
			){
				$this->redirect(array("controller"=>"cparty","action"=>"edit",$id));
			}

			$this->Collaboparty->set($post);
			if($this->Collaboparty->validates()){

				$this->Collaboparty->save($post,false);
				$caption_json=array(
					"type"=>"edit",
					"edit"=>array(
						"before"=>$result["Collaboparty"],
						"after"=>$post["Collaboparty"],
					),
				);

				$save_log=array(
					"Collabopartylog"=>array(
						"id"=>"",
						"collaboparty_id"=>$post["Collaboparty"]["id"],
						"change_date"=>date("Y-m-d H:i:s"),
						"changeuser_id"=>$this->admindata["Admin"]["id"],
						"changeuser_status"=>2,
						"unreaduser_status"=>0,
						"caption"=>json_encode($caption_json,JSON_UNESCAPED_UNICODE),
					),
				);
				$this->Collabopartylog->save($save_log,false);

				$this->Session->write("alert","コラボ参加表明情報を変更しました。");
				$this->redirect(array("controller"=>"cparty","action"=>"detail",$id));
			}
		}
		else
		{
			$this->request->data=$result;
		}
	}

}
