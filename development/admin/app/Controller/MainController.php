<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/08							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	トップページ							*/
/*	MainController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class MainController extends AppController {
	public $uses=array(
		"Admin",
		"Adminlogin",
		"Order",
	);
	public $components=array(
		"Db",
		"Loadbasic",
	);

	//★前処理
	public function beforeFilter(){
		parent::beforeFilter();

		//Auth許可
		$this->Auth->allow("login");
	}
	public function index(){

		$this->set("commission",$this->Loadbasic->load("commission"));
		$this->set("orderstatus",$this->Db->orderstatus());
		$this->set("payment",$this->Db->payment());

		$this->Order->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
			"belongsTo"=>array(
				"User"=>array(
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
		$result_order=$this->Order->find("all",array(
			"order"=>array("Order.createdate desc"),
			"limit"=>5,
		));
		$ind=0;
		foreach($result_order as $r_){
			$sort=json_decode($r_["Contentbuffer"]["buffer"],true);
			$result_order[$ind]["Contentbuffer"]=$sort;
			$ind++;
		}
		$this->set("result_order",$result_order);



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
		$result_payment=$this->Order->find("all",array(
			"conditions"=>array(
				"NOT"=>array(
					"Order.order_status"=>array("neworder","cancel","onhold"),
				),
				"Order.special_payment_status"=>0,//特別権限のないものだけ表示
				@$cond_keyword,
				@$cond_ps,
			),
			"order"=>array("Order.createdate desc"),
			"limit"=>5,
			"recursive"=>2,
		));
		$ind=0;
		foreach($result_payment as $r_){
			$sort=json_decode($r_["Contentbuffer"]["buffer"],true);
			$result_payment[$ind]["Contentbuffer"]=$sort;
			$ind++;
		}
		$this->set("result_payment",$result_payment);




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
		$result_transfer=$this->Order->find("all",array(
			"conditions"=>array(
				"OR"=>array(
					"Order.order_status"=>array("transfer_request","transfer_complete"),
				),
			),
			"limit"=>5,
			"order"=>array("Order.claim_startdate desc"),
		));
		$this->set("result_transfer",$result_transfer);
	}
	public function login(){
		//レイアウトを変更

		//postされているかどうか
		if($this->request->data)
		{
			$data=$this->request->data;

			//バリデーション
			$this->Adminlogin->set($data);
			if($this->Adminlogin->validates())
			{
				//Adminに変換
				$logindata=array(
					"Admin"=>array(
						"username"=>$data["Adminlogin"]["username"],
						"password"=>$data["Adminlogin"]["password"],
					),
				);
				//$this->request->data=$logindata;

				//ログインさせる
				if($this->Auth->login()){

				}
				else
				{
					$this->set("alert","ログインできません");
				}

			}
		}
	}
	public function logout(){
		$this->autoRender=false;
		$this->Auth->logout();
		$this->redirect(array("controller"=>"main","action"=>"login"));

	}
}
