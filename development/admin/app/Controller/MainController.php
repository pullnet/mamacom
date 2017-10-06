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
