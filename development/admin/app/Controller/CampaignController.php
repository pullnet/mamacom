<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/28							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	キャンペーン管理						*/
/*	CampaignController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class CampaignController extends AppController {

	public $uses=array(
		"Campaign",
		"Default",
	);
	public $components=array(

		"Loadbasic",
	);

	public function index(){
		$result=$this->Campaign->find("all");
		$this->set("result",$result);
	}
	public function edit($id=null){

		if($this->request->data){
			$post=$this->request->data;

			$this->Campaign->set($post);
			if($this->Campaign->validates()){

				$this->Campaign->save($post,false);

				$this->Session->write("alert","キャンペーン情報を設定しました");
				$this->redirect(array("controller"=>"campaign","action"=>"index"));
			}
		}
		else
		{
			if($id){
				$post=$this->Campaign->find("first",array(
					"conditions"=>array(
						"Campaign.id"=>$id,
					),
				));
				$this->request->data=$post;
			}
		}

	}
	//★キャンペーン情報の削除
	public function delete($id){
		$this->autoRender=false;
		
		$this->Campaign->delete($id);

		$this->Session->write("alert","キャンペーン情報を削除しました");
		$this->redirect(array("controller"=>"campaign","action"=>"index"));
	}
	//★キャンペーン情報並び替え
	public function sort(){

		$campaign_sort=@$this->Loadbasic->load("campaign_sort");

		if(@$campaign_sort){
			$json_decode=json_decode($json_decode,true);

		}

		if($this->request->data){

			$post=$this->request->data;



			$this->Session->write("alert","キャンペーン情報の並び替えが完了しました");
			$this->redirect(array("controller"=>"campaign","action"=>"index"));

		}
		else
		{

		}
	}
}
