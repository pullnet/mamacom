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

class PagecategoryController extends AppController{

	public $uses=array(
		"Freepagecategory",
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

		$result=$this->Freepagecategory->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$result=$this->Freepagecategory->find("count");
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
	}
	//★ページカテゴリー登録・編集
	public function edit($id=null){


		if($this->request->data){
			$post=$this->request->data;


			$this->Freepagecategory->set($post);
			if($this->Freepagecategory->validates()){

				$this->Freepagecategory->save($post,false);


				$this->Session->write("alert","ページカテゴリーを１件設定しました。");
				$this->redirect(array("controller"=>"pagecategory","action"=>"index"));

			}
		}
		else{
			if($id){

				$post=$this->Freepagecategory->find("first",array(
					"conditions"=>array(
						"Freepagecategory.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}

	}
}
