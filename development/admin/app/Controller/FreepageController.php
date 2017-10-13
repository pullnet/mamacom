<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	LP・固定ページ管理画面						*/
/*	FreepageController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class FreepageController extends AppController{

	public $uses=array(
		"Freepage",
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
	//★固定ページ一覧
	public function index($page=1){
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
		$this->set("open_status",$this->Db->openstatus());
		$this->set("page_status",array(0=>"表示",1=>"非表示"));

		$limit=30;
		$this->set("limit",$limit);
		$this->set("page",$page);

		if(@$this->request->query){
			$query=$this->request->query;

			if(@$query["keyword"]){
				$cond_keyword=array(
					"Or"=>array(
						"Freepage.name LIKE"=>"%".$query["keyword"]."%",
						"Freepage.permalink LIKE"=>"%".$query["keyword"]."%",
					),
				);
			}
			if(@$query["category"]){
				$cond_cl=array(
					"Freepage.freepagecategory_id"=>$query["category"],
				);
			}
		}

		//ページカテゴリー情報をset
		$category_list=$this->Freepagecategory->find("list",array(
			"fields"=>array("id","name"),
		));
		$this->set("category_list",$category_list);

		//固定ページ情報を取得
		$this->Freepage->bindModel(array(
			"belongsTo"=>array(
				"Freepagecategory",
			),
		));
		$result=$this->Freepage->find("all",array(
			"conditions"=>array(
				@$cond_keyword,
				@$cond_cl,
			),
			"order"=>array("Freepage.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$this->Freepage->find("count",array(
			"conditions"=>array(
				@$cond_keyword,
				@$cond_cl,
			),
		));

		$totalpage=ceil($totalcount/$limit);
		$this->set("totalpage",$totalpage);
		$this->set("totalcount",$totalcount);


	}
	//★固定ページ編集
	public function edit($id=null){
		$pagecategory_list=$this->Freepagecategory->find("list",array(
			"fields"=>array("id","name"),
		));
		$this->set("pagecategory_list",$pagecategory_list);

		//POSTされている場合
		if($this->request->data){
			$data=$this->request->data;
			$this->Freepage->set($data);

			if($this->Freepage->validates()){

				//固定ページ情報をsave
				$result=$this->Freepage->save($data,false);

				//メッセージを送信してリダイレクト
				$this->Session->write("alert","固定ページを登録完了しました");
				$this->redirect(array("controller"=>"freepage","action"=>"index"));
			}
		}
		else
		{
			if($id)
			{
				$post=$this->Freepage->find("first",array(
					"conditions"=>array(
						"Freepage.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}
	}
	//★一覧情報をcsv出力
	public function dataexport(){
		$this->layout=false;
		$result=$this->Freepage->find("all");
		$result_key=array_keys($result[0]["Freepage"]);
		$dat=$this->Csv->makecsv($result_key,$result,"Freepage");
		
		$this->set("filename","Freepage_data.csv");
		$this->set("html",$dat);

		$this->Render("../Csv/dataexport");
	}
	/*
	//★削除メソッド(論理)
	public function delete_logic($id){
		$this->autoRender=false;
		$data=array(
			"id"=>$id,
			"delete_flag"=>1,//削除フラグ1に
		);
		$this->Freepage->save($data,false);

		$this->Session->write("alert","ページを１件削除しました");
		$this->redirect(array("controller"=>"freepage","action"=>"index"));
	}
	*/
	//★削除メソッド(物理消去)
	public function delete($id){
		$this->autoRender=false;
		$this->Freepage->delete($id);

		$this->Session->write("alert","ページを１件完全に削除しました");
		$this->redirect(array("controller"=>"freepage","action"=>"index"));
	}

	//★画像管理
	public function image(){


	}
}
