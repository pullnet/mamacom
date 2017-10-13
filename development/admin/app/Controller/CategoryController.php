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
	//★カテゴリー一覧
	public function index($page=1){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);

		$result=$this->Category->find("all",array(
			"conditions"=>array(
				"Category.type_mode"=>"0",						
			),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$this->Category->find("count",array(
			"conditions"=>array(
				"Category.type_mode"=>"0",						
			),
		));		
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
	}
	//★カテゴリー登録・編集
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
						"Category.type_mode"=>"0",						
					),
				));
				$this->request->data=$post;
			}
		}

	}
	
	//★カテゴリー登録・削除
	public function delete($id){
		
		$this->autoRender=false;
		
		//idでItemcategoryテーブルデータ取得
		$result=$this->Category->find("first",array(
			'conditions' => array(
				'Category.id' => $id,
			)
		));
		//idでItemcategoryテーブルデータ削除
		$this->Category->delete($id);
		
		//テキスト表示とリダイレクト
		$this->Session->write("alert", "カテゴリーを削除いたしました。");
		$this->redirect(array("controller"=>"category","action"=>"index"));

	}	
	

}
