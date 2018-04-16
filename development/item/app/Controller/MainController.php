<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/21							*/
/*									*/
/*	画像・コンテンツ管理用コントローラ				*/
/*	MainController.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('Controller', 'Controller');

class MainController extends Controller {

	public $password="buteneko";//簡易パスワード....
	public $component=array(
		"Session",
	);

	public function login(){
		if($this->request->data)
		{
			$data=$this->request->data;
			if($this->password==$data["Adminlogin"]["password"])
			{
				$this->Session->write("login",md5($this->password));
				$this->redirect(array("controller"=>"main","action"=>"index"));
			}
		}
	}
	public function beforefilter(){
		parent::beforefilter();

		if($this->params["action"]!="login")
		{
			if($this->Session->read("login"))
			{
				if($this->Session->read("login")!=md5($this->password))
				{
					$this->redirect(array("controller"=>"main","action"=>"login"));
				}
			}
		}
		else
		{
		}

	}
	//一覧画面
	public function index(){
		$this->autoRender=false;
		return json_encode(array(
			"error"=>"400 Bad Request",
		));
	}
}