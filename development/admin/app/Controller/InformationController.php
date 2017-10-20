<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/10							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	インフォメーション管理用					*/
/*	InformationController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class InformationController extends AppController{

	public $uses=array(
		"Information",
	);

	public $components=array(
		"Db",
		"Loadbasic",
		"Csv",
	);


	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	//★インフォメーション一覧
	public function index($page=1){
		

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));

		$limit=30;
		$this->set("limit",$limit);
		$this->set("page",$page);

		$result=$this->Information->find("all",array(
			"order"=>array("Information.post_date desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		
		$this->set("result",$result);

		$totalcount=$this->Information->find("count");

		$totalpage=ceil($totalcount/$limit);
		$this->set("totalpage",$totalpage);
		$this->set("totalcount",$totalcount);

	}
	//★インフォメーション編集
	public function edit($id=null){
	
		//POSTされている場合
		if($this->request->data){
			$data=$this->request->data;

			$this->Information->set($data);
			if($this->Information->validates()){

				if(!$data["Information"]["id"]){
					$data["Information"]["post_date"]=date("Y-m-d H:i:s");
				}
				//save
				$result=$this->Information->save($data,false);

				//メッセージを送信してリダイレクト
				$this->Session->write("alert","インフォメーションを登録完了しました");
				$this->redirect(array("controller"=>"information","action"=>"index"));
			}
		}
		else
		{
			if($id)
			{
				$post=$this->Information->find("first",array(
					"conditions"=>array(
						"Information.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}
	
	}
	
	//★削除
	public function delete($id){
		
		$this->autoRender=false;
		
		//idでテーブルデータ取得
		$result=$this->Information->find("first",array(
			'conditions' => array(
				'Information.id' => $id,
			)
		));
		//idでテーブルデータ削除
		$this->Information->delete($id);
		
		//テキスト表示とリダイレクト
		$this->Session->write("alert", "お知らせを削除いたしました。");
		$this->redirect(array("controller"=>"information","action"=>"index"));

	}		

}