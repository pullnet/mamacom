<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/01/26							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	振込管理用コントローラ						*/
/*	TransferrequestController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class TransferrequestController extends AppController {

	public $uses=array(
		"Order",
		"Orderclaim",
		"Orderlog",
		"User",
	);
	public $components=array(
		"Db",
		"Loadbasic",
		"Numbering",
		"Transferrequestcontrol",
	);
	//★振込管理状況一覧
	public function index($page=1){
		$this->set("commission",$this->Loadbasic->load("commission"));


		$this->Order->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",

			),
			"belongsTo"=>array(
				"Outputuser"=>array(
					"className"=>"User",
					"foreignKey"=>"output_user_id",
				),
				"Inputuser"=>array(
					"className"=>"User",
					"foreignKey"=>"input_user_id",
				),
			),
			"hasMany"=>array(
				"Orderlog",
			),
		));
		$result=$this->Order->find("all",array(
			"conditions"=>array(
				"OR"=>array(
					"Order.order_status"=>array("transfer_request","transfer_complete"),
				),
			),
			"order"=>array("Order.claim_startdate desc"),
		));
		$this->set("result",$result);

		if($this->request->data){

			$post=$this->request->data;
			$arrays=array();
			$counts=0;
			foreach($post["Order"]["check"] as $poc_){
				if($poc_){

					$buff=array(
						"id"=>$poc_,
					);
					$arrays[]=$buff;
					$counts++;
				}
			}

			$this->Transferrequestcontrol->change_status($arrays);

			$this->Session->write("alert","振込状況を".$counts."件更新しました");
			$this->redirect(array("controller"=>"transferrequest","action"=>"index"));
		}
	}
	//★振込管理状況詳細
	public function detail($id){

		$this->set("commission",$this->Loadbasic->load("commission"));

		$this->Order->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
			"belongsTo"=>array(
				"Owner"=>array(
					"className"=>"User",
					"foreignKey"=>"output_user_id",
				),
				"User"=>array(
					"foreignKey"=>"input_user_id",
				),
			),
		));
		$result=$this->Order->find("first",array(
			"conditions"=>array(
				"Order.id"=>$id,
			),
		));
		$jsondata=json_decode($result["Contentbuffer"]["buffer"],true);
		$result["Contentbuffer"]=$jsondata;
		$this->set("result",$result);

	}
}
