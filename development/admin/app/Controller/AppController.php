<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/08							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	共通コントローラ						*/
/*	AppController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $layout="collabos_admin";//管理画面レイアウト

	public $uses=array("Admin");
	public $admindata=array();

	//共通コンポーネント設定
	public $components = array(
		//Sessionコンポーネント
		"Session",
		//Authコンポーネント設定
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Admin'//会員情報
				),
			),
			//ログイン後の移動先
			'loginRedirect' => array('controller' =>'main','action' =>'index'),
			//ログアウト後の移動先
			'logoutRedirect' => array('controller' =>'user','action' =>'login'),
			//ログインページのパス
			'loginAction' => array('controller' =>'user','action' =>'login'),
		),
	);

	//前処理
	public function beforeFilter(){
		session_start();
		AuthComponent::$sessionKey = "Auth.CollabosadminUser";//これないと一般アカウントのAuth(User)と同じ場所に入ってしまう。

		//echo "システムメンテナンス中";
		//exit;

		if($this->Auth->user())
		{
			$this->set("logined",true);
			if($this->Session->read("admindata"))
			{
				$admindata=$this->Session->read("admindata");
				$this->set("admindata",$admindata);
				$this->admindata=$admindata;
			}
			else
			{
				$admindata=$this->Admin->find("first",array(
					"Admin.id"=>$this->Auth->user("id"),
				));
				$this->admindata=$admindata;
				$this->set("admindata",$admindata);
				$this->Session->write("admindata",$admindata);
			}
		}
		else
		{
			if($this->Auth->logoutRedirect["controller"]!=$this->params["controller"]){
				$redirect_url=array(
					"rurl"=>Router::url(null,true),
				);
				$this->redirect(array("controller"=>"user","action"=>"login","?"=>$redirect_url));
			}

			if($this->Session->read("admindata"))
			{
				$this->Session->delete("admindata");
			}
			$this->set("logined",false);
			unset($this->admindata);
		}
		$this->set("controller",$this->name);
		$this->set("action",$this->action);

		//メッセージがあれば受信
		if($this->Session->read("alert"))
		{
			$this->set("alert",$this->Session->read("alert"));
			$this->Session->delete("alert");
		}

		$this->set("inputDefaults",array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		));
	}
}
