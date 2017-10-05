<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/03/01							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	入力エラー表示文管理						*/
/*	InputerrorController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class InputerrorController extends AppController {

	public $uses=array(
		"Inputerror",
	);

	public function index(){
		$page=1;
		$limit=20;

		if(@$this->request->query){
			$query=$this->request->data;

			if(@$query["page"]){
				$page=$query["page"];
			}
			if(@$query["limit"]){
				$limit=$query["limit"];
			}

		}

		$result=$this->Inputerror->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

	}
	public function edit($id=null){
		
		if($this->request->data){
			$post=$this->request->data;

			$this->Inputerror->set($post);
			if($this->Inputerror->validates()){
				$this->Inputerror->save($post,false);

				$this->Session->write("alert","入力エラー表示情報を登録しました");
				$this->redirect(array("controller"=>"inputerror","action"=>"index"));
			}

		}
		else
		{
			if($id){
				$post=$this->Inputerror->find("first",array(
					"conditions"=>array(
						"Inputerror.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}
	}
	public function delete($id){
		$this->autoRender=false;

		$this->Inputerror->delete($id);

		$this->Session->write("alert","入力エラー表示情報を削除しました");
		$this->redirect(array("controller"=>"inputerror","action"=>"index"));
	}
}
