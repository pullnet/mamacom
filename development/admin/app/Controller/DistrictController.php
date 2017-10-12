<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/06							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	地区管理画面					*/
/*	DistrictController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class DistrictController extends AppController{

	public $uses=array(
		"District",
	);

	public $components=array(
		"Db",
		"Loadbasic",
		"Csv",
	);


	public function beforeFilter(){
		parent::beforeFilter();
	}
	//★ページカテゴリー一覧
	public function index($page=1){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);

		$result=$this->District->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$result=$this->District->find("count");
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
	}
	//★ページカテゴリー登録・編集
	public function edit($id=null){


		if($this->request->data){
			$post=$this->request->data;

			$this->District->set($post);
			if($this->District->validates()){

				$this->District->save($post,false);

				$this->Session->write("alert","地区を１件設定しました。");
				$this->redirect(array("controller"=>"district","action"=>"index"));

			}
		}
		else{
			if($id){

				$post=$this->District->find("first",array(
					"conditions"=>array(
						"District.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}

	}
}
