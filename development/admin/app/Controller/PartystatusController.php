<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/30							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	注文ステータス項目管理画面					*/
/*	OrderstatusController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class PartystatusController extends AppController {

	public $uses=array(
		"Collabostatuslist",
		"Default",
	);

	public $components=array(
		"Db",
		"Loadbasic",
	);

	public function beforeFilter(){
		parent::beforeFilter();
		
	}
	//コラボ参加ステータス一覧画面
	public function index(){
		$sort_json=json_decode(@$this->Loadbasic->load("partystatus_sort"),true);
		$sort="";
		if(@$sort_json){
			$sort="Field(Collabostatuslist.id";
			foreach($sort_json as $s_){
				$sort.=",".$s_;
			}
			$sort.=")";
		}
		$result=$this->Collabostatuslist->find("all",array(
			"conditions"=>array(
			),
			"order"=>@$sort,
		));
		$this->set("result",$result);
	}
	//コラボ参加ステータス編集フォーム
	public function edit($id=null){

		//POSTされている場合
		if($this->request->data){
			$data=$this->request->data;
			$this->Collabostatuslist->set($data);
			if($this->Collabostatuslist->validates()){
				//バリデーションOKならば登録

				if(!$data["Collabostatuslist"]["id"]){
					$data["Collabostatuslist"]["status"]=1;
				}

				$this->Collabostatuslist->save($data,false);

				$this->Session->write("alert","ステータスを1件変更致しました");
				$this->redirect(array("controller"=>"partystatus","action"=>"index"));
			}
		}
		else
		{
			//POSTされていない場合はidがある場合は取得してpost
			if($id){
				$post=$this->Collabostatuslist->find("first",array(
					"conditions"=>array(
						"Collabostatuslist.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		
		}

	}
	//コラボ参加ステータス並び替え
	public function sort(){

		$sort_json=json_decode(@$this->Loadbasic->load("partystatus_sort"),true);
		$sort="";
		if(@$sort_json){
			$sort="Field(Collabostatuslist.id";
			foreach($sort_json as $s_){
				$sort.=",".$s_;
			}
			$sort.=")";
		}
		$result=$this->Collabostatuslist->find("all",array(
			"order"=>@$sort,
		));

		$this->set("result",$result);

		if($this->request->data){

			$post=$this->request->data;

			$sort_json=json_encode($post["Csort"]);

			$check=$this->Default->find("first",array(
				"conditions"=>array(
					"Default.name"=>"partystatus_sort",
				),
			));

			$savedata=array(
				"Default"=>array(
					"id"=>@$check["Default"]["id"],
					"name"=>"partystatus_sort",
					"value"=>$sort_json,
				),
			);
			$this->Default->save($savedata,false);
			
			$this->Session->write("alert","コラボ参加ステータスの並び替えが完了しました");
			$this->redirect(array("controller"=>"partystatus","action"=>"index"));
		}

	}
	//注文ステータス削除処理
	public function delete($id){
		$this->autoRender=false;
		
		$this->Collabostatuslist->delete($id);

		$this->Session->write("alert","コラボ参加ステータスを１件削除が完了しました");
		$this->redirect(array("controller"=>"partystatus","action"=>"index"));
	}
}
