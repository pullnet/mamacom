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

class OrderstatusController extends AppController {

	public $uses=array(
		"Orderstatuslist",
		"Default",
	);

	public $components=array(
		"Db",
		"Loadbasic",
	);

	public function beforeFilter(){
		parent::beforeFilter();
		
	}
	//注文ステータス一覧画面
	public function index(){

		$sort_json=json_decode(@$this->Loadbasic->load("orderstatus_sort"),true);
		if(@$sort_json){
			$sort="Field(Orderstatuslist.id";
			foreach($sort_json as $s_){
				$sort.=",".$s_;
			}
			$sort.=")";
		}
		$result=$this->Orderstatuslist->find("all",array(
			"order"=>@$sort,
		));

		$this->set("result",$result);
	}
	//注文ステータス編集フォーム
	public function edit($id=null){

		//POSTされている場合
		if($this->request->data){
			$data=$this->request->data;
			$this->Orderstatuslist->set($data);
			if($this->Orderstatuslist->validates()){
				//バリデーションOKならば登録

				//新規登録は全てstatusを1に
				if(!$data["Orderstatuslist"]["id"]){
					$data["Orderstatuslist"]["status"]=1;
				}

				$this->Orderstatuslist->save($data,false);

				$this->Session->write("alert","ステータスを1件変更致しました");
				$this->redirect(array("controller"=>"orderstatus","action"=>"index"));
			}
		}
		else
		{
			//POSTされていない場合はidがある場合は取得してpost
			if($id){
				$post=$this->Orderstatuslist->find("first",array(
					"conditions"=>array(
						"Orderstatuslist.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		
		}

	}
	//注文ステータス並び替え
	public function sort(){
		$sort_json=json_decode(@$this->Loadbasic->load("orderstatus_sort"),true);
		if(@$sort_json){
			$sort="Field(Orderstatuslist.id";
			foreach($sort_json as $s_){
				$sort.=",".$s_;
			}
			$sort.=")";
		}
		$result=$this->Orderstatuslist->find("all",array(
			"order"=>@$sort,
		));

		$this->set("result",$result);

		if($this->request->data){

			$post=$this->request->data;

			$sort_json=json_encode($post["Osort"]);

			$check=$this->Default->find("first",array(
				"conditions"=>array(
					"Default.name"=>"orderstatus_sort",
				),
			));

			$savedata=array(
				"Default"=>array(
					"id"=>@$check["Default"]["id"],
					"name"=>"orderstatus_sort",
					"value"=>$sort_json,
				),
			);
			$this->Default->save($savedata,false);
			
			$this->Session->write("alert","ステータスの並び替えが完了しました");
			$this->redirect(array("controller"=>"orderstatus","action"=>"index"));
		}
	}
	//注文ステータス削除処理
	public function delete($id){
		$this->autoRender=false;
		
		$this->Orderstatuslist->delete($id);

		$this->Session->write("alert","ステータスを１件削除が完了しました");
		$this->redirect(array("controller"=>"orderstatus","action"=>"index"));
	}
}
