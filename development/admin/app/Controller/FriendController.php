<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/16							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	仲間管理画面							*/
/*	FriendController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class FriendController extends AppController {

	public $uses=array(
		"User",
		"Group",
		"Groupuser",
	);

	public $components=array(
		"Db",
	);

	public function beforeFilter(){
		parent::beforeFilter();
		
	}
	//★全仲間一覧画面
	public function index($page=1){
		$limit=100;
		$this->set("limit",$limit);
		$this->set("page",$page);
		$this->set("friend_status",array(0=>"申請中",1=>"承認済み",2=>"承認拒否"));


		if(@$this->request->query){
			$query=$this->request->query;

			if(@$query["keyword"]){
				$userlist=$this->User->find("list",array(
					"conditions"=>array(
						"User.nickname LIKE"=>"%".$query["keyword"]."%",
						"User.role"=>1,
					),
					"fields"=>array("id","id"),
				));

				$groupuserlist=$this->Groupuser->find("list",array(
					"conditions"=>array(
						"Groupuser.user_id"=>$userlist,
					),
					"fields"=>array("group_id","group_id"),
				));

				$grouplist=$this->Group->find("list",array(
					"conditions"=>array(
						"Group.id"=>$groupuserlist,
						"Group.status"=>0,
					),
					"fields"=>array("id","id"),
				));
				$cond_keyword=array(
					"Group.id"=>$grouplist,
				);
			}

			if(@$query["type"]){
				$cond_type=array(
					"Group.friend_status"=>$query["type"]-1,
				);
			}
		}

		//すべての仲間情報(Group内の仲間関係情報のみ)を取得
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
		$result=$this->Group->find("all",array(
			"conditions"=>array(
				"Group.status"=>0,
				@$cond_keyword,
				@$cond_type,
			),
			"order"=>array("Group.createdate desc"),
			"recursive"=>2,
		));
		$this->set("result",$result);

		$totalcount=$this->Group->find("count",array(
			"conditions"=>array(
				"Group.status"=>0,
				@$cond_keyword,
				@$cond_type,
			),
		));
		$totalpage=ceil($totalcount/$limit);

		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

	}
	//★仲間詳細画面
	public function view($id){

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
		$result=$this->Group->find("first",array(
			"conditions"=>array(
				"Group.id"=>$id,
			),
			"recursive"=>2,
		));
		$this->set("result",$result);

		$this->set("status",array(
			0=>"申請中",
			1=>"承認済",
			2=>"承認拒否",
		));
	}
	//★仲間編集画面
	public function edit($id=null){

		$userdata=$this->User->find("all",array(
			"conditions"=>array(
				"User.role"=>1,
			),
			"fields"=>array("id","nickname","username"),
		));
		$userlist=array();
		foreach($userdata as $u_)
		{
			$userlist[$u_["User"]["id"]]=$u_["User"]["username"]." - ".$u_["User"]["nickname"];
		}
		$this->set("userlist",$userlist);
		
		if($this->request->data){

		}
		else
		{
			if($id){
				$post=$this->Group->find("first",array(

				));
			}
		}

	}
}
