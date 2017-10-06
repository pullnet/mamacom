<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	ログインページ							*/
/*	UserController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class UserController extends AppController {
	public $uses=array("Admin","Adminlogin");

	public $components=array(
		"Cookie",
	);

	//★前処理
	public function beforeFilter(){
		parent::beforeFilter();

		//Auth許可
		$this->Auth->allow("login");
		$this->Auth->allow("autologin");
	}
	//★ログイン画面
	public function login(){
		//レイアウトを変更
		$this->layout="collabos_admin_login";

		if($this->Cookie->read("Collabos_Admin")){
			$this->set("cookie",true);
		}

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
				$this->request->data=$logindata;

				//ログインさせる
				if($this->Auth->login()){
					//クッキーに保存(期限は1週間)
					$this->Cookie->write("Collabos_Admin",$logindata,true,"7 day");

					if(@$this->request->query["rurl"]){
						$this->redirect(@$this->request->query["rurl"]);
					}
					else
					{
						$this->redirect(array("controller"=>"main","action"=>"index"));
					}

				}
				else
				{
					$this->set("alert","ログインできません");
					$this->redirect(array("controller"=>"user","action"=>"login"));
				}

			}
		}
	}
	//★ログアウト処理
	public function logout(){
		$this->autoRender=false;
		$this->Auth->logout();
		$this->redirect(array("controller"=>"user","action"=>"login"));
	}
	//★前回のアカウントでログイン
	public function autologin(){
		$this->autoRender=false;

		if(@$this->Cookie->read("Collabos_Admin")){

			$data=$this->Cookie->read("Collabos_Admin");

			$this->request->data=$data;

			if($this->Auth->login()){
				//クッキーに保存(期限は1週間)
				$this->Cookie->write("Collabos_Admin",$data,true,"7 day");

				if(@$this->request->query["rurl"]){
					$this->redirect(@$this->request->query["rurl"]);
				}
				else
				{
					$this->redirect(array("controller"=>"main","action"=>"index"));
				}
			}
			else
			{
				$this->set("alert","ログインできません");
				$this->redirect(array("controller"=>"user","action"=>"login"));
			}
		}
	}
}
