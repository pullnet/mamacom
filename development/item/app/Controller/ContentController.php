<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	2017/10/17							*/
/*									*/
/*	画像・コンテンツメソッド用コントローラ				*/
/*	ContentController.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('Controller', 'Controller');

class ContentController extends Controller {

	public $autoRender=false;
	public $layout=false;

	public $components=array(
		"Loadbasic",
	);・

	public function beforefilter(){
		parent::beforefilter();
	}
	public function save(){
		if($this->request->query){
			$post=$this->request->query;

			if($this->key_check(@$post["access_token"])){
				
				@mkdir("Content");

				copy($post["source"],"Content/".$post["filename"]);

				return true;
			}
			else
			{
				return "アクセストークンが間違えているか、ありません";
			}
		}
		else
		{
			return "リクエストがありません";
		}
	}
	private function key_check($key){
		if($key){
			$key=base64_decode($key);

			$key=explode(":",$key);

			if($key[0]==$this->Loadbasic->load("img_service_secret") && $key[0]==$this->Loadbasic->load("img_lisence_key")){
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
