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
/*	ContentsController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class ContentsController extends AppController{

	public $uses=array(
		"Contents",
		"Category",
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
		
		
		//カテゴリー情報をset
		$category_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
		));
		$this->set("category_list",$category_list);
		
		//地区情報をset
		$district_list=$this->District->find("list",array(
			"fields"=>array("id","name"),
		));
		$this->set("district_list",$district_list);		
		
		//コンテンツ情報をset
		$result=$this->Contents->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$result=$this->Contents->find("count");
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
