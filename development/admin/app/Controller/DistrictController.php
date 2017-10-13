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
	//★地区一覧
	public function index($page=1){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);

		$result=$this->Category->find("all",array(
			"conditions"=>array(
				"Category.type_mode"=>"1",						
			),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$this->Category->find("count",array(
			"conditions"=>array(
				"Category.type_mode"=>"1",						
			),
		));		
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
	}
	//★地区登録・編集
	public function edit($id=null){


		if($this->request->data){
			$post=$this->request->data;

			$this->Category->set($post);
			if($this->Category->validates()){

				$this->Category->save($post,false);

				$this->Session->write("alert","地区を１件設定しました。");
				$this->redirect(array("controller"=>"district","action"=>"index"));

			}
		}
		else{
			if($id){

				$post=$this->Category->find("first",array(
					"conditions"=>array(
						"Category.id"=>$id,
						"Category.type_mode"=>"1",			
					),
				));
				$this->request->data=$post;
			}
		}

	}
	
	//★地区・削除
	public function delete($id){
		
		$this->autoRender=false;
		
		//idでテーブルデータ取得
		$result=$this->Category->find("first",array(
			'conditions' => array(
				'Category.id' => $id,
			)
		));
		//idでテーブルデータ削除
		$this->Category->delete($id);
		
		//テキスト表示とリダイレクト
		$this->Session->write("alert", "地区を削除いたしました。");
		$this->redirect(array("controller"=>"district","action"=>"index"));

	}		
	
}
