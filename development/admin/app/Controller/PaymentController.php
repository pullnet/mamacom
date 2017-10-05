<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/06							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	支払管理用コントローラ						*/
/*	PaymentController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class PaymentController extends AppController {

	public $uses=array(
		"Order",
		"Orderclaim",
		"User",
	);
	public $components=array(
		"Db",
		"Loadbasic",
		"Numbering",
		"Paymentcontrol",
	);
	//★支払管理(銀行振込)
	public function index($page=1){
		$this->set("payment",$this->Db->payment());
		$this->set("payment_status",$this->Db->payment_status());
		$this->set("orderstatus",$this->Db->orderstatus());

		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);

		if(@$this->request->query){
			$query=$this->request->query;

			if(@$query["keyword"]){
				$cond_keyword=array(
					"Order.number LIKE"=>"%".$query["keyword"]."%",
				);
			}
			if(@$query["payment_status"]){
				$cond_ps=array(
					"Order.payment_status"=>$query["payment_status"],
				);
			}

		}



		$this->Order->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
			"belongsTo"=>array(
				"Inputuser"=>array(
					"className"=>"User",
					"foreignKey"=>"input_user_id",
				),
				"Outputuser"=>array(
					"className"=>"User",
					"foreignKey"=>"output_user_id",
				),
			),
			"hasMany"=>array(
				"Orderlog",
			),
		));
		$result=$this->Order->find("all",array(
			"conditions"=>array(
				"NOT"=>array(
					"Order.order_status"=>array("neworder","cancel","onhold"),
				),
				"Order.special_payment_status"=>0,//特別権限のないものだけ表示
				@$cond_keyword,
				@$cond_ps,
			),
			"order"=>array("Order.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
			"recursive"=>2,
		));
		$ind=0;
		foreach($result as $r_){
			$sort=json_decode($r_["Contentbuffer"]["buffer"],true);
			$result[$ind]["Contentbuffer"]=$sort;
			$ind++;
		}
		$this->set("result",$result);

		$totalcount=$this->Order->find("count",array(
			"conditions"=>array(
				"NOT"=>array(
					"Order.order_status"=>array("neworder","cancel","onhold"),
				),
				"Order.special_payment_status"=>0,//特別権限のないものだけ表示
				@$cond_keyword,
				@$cond_ps,
			),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);


		if($this->request->data){
			$post=$this->request->data;

			$params=array();

			foreach($post["Order"]["check"] as $p_){
				if($p_["id"]){
					$buff=array(
						"id"=>$p_["id"],
						"before_status"=>$p_["before_status"],
						"after_status"=>$post["Order"]["order_status"],
					);
					$params[]=$buff;
				}
			}

			$this->Paymentcontrol->change_status($params);

			$this->Session->write("alert","ステータスを一括変更完了しました");
			$this->redirect(array("controller"=>"payment","action"=>"index",$page,"?"=>@$this->request->data));

		}

	}
}
