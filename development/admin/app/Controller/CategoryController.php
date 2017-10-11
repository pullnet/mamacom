<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/06							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	ページカテゴリー管理画面					*/
/*	PagecategoryController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class CategoryController extends AppController{

	public $uses=array(
		"Category",
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

		$result=$this->Category->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$result=$this->Category->find("count");
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
	}
	//★ページカテゴリー登録・編集
	public function edit($id=null){


		if($this->request->data){
			$post=$this->request->data;

			$this->Category->set($post);
			if($this->Category->validates()){

				$this->Category->save($post,false);


				$this->Session->write("alert","カテゴリーを１件設定しました。");
				$this->redirect(array("controller"=>"category","action"=>"index"));

			}
		}
		else{
			if($id){

				$post=$this->Category->find("first",array(
					"conditions"=>array(
						"Category.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}

	}
}
