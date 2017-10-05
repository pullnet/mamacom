<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/13							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	検索キーワード管理画面						*/
/*	KeywordController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class KeywordController extends DblistController {

	public $uses=array(
		"Keyword",
	);
	
	public $components=array(
		"Loadbasic",
	);
	//★登録キーワード一覧画面
	public function index($page=1){
		$limit=20;
		$this->set("limit",$limit);
		$this->set("page",$page);

		$wwwurl=$this->Loadbasic->load("wwwurl");
		$this->set("wwwurl",$wwwurl);


		$result=$this->Keyword->find("all",array(
			"order"=>array("Keyword.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$this->Keyword->find("count");

		$totalpage=ceil($totalcount/$limit);

		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);
	}
	//★登録キーワード編集画面
	public function edit($id=null){

		if($this->request->data){
			$post=$this->request->data;

			$this->Keyword->set($post);
			if($this->Keyword->validates()){

				$this->Keyword->save($post,false);

				//メッセージを送信してリダイレクト
				$this->Session->write("alert","キーワードを設定しました");
				$this->redirect(array("controller"=>"keyword","action"=>"index"));
			}
		}
		else
		{
			if($id){
				$post=$this->Keyword->find("first",array(
					"conditions"=>array(
						"Keyword.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}

	}
	//★キーワード削除
	public function delete($id){
		$this->autoRender=false;

		$this->Keyword->delete($id);

		//メッセージを送信してリダイレクト
		$this->Session->write("alert","キーワードを一件削除しました");
		$this->redirect(array("controller"=>"keyword","action"=>"index"));
	}
}
