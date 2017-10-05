<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/02/07							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	ページ用画像・ファイル管理用コントローラ			*/
/*	FiledataController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');//サニタイズ用

class FiledataController extends AppController {

	public $itemurl="";

	public $components=array(
		"Curl",
		"Loadbasic",
	);
	//★前処理
	public function beforeFilter(){
		parent::beforeFilter();

		$this->itemurl=$this->Loadbasic->load("itemurl");
	}
	//★画像データ領域画面
	public function index(){
		$this->set("itemurl",$this->itemurl);

	}
	//以下はAJAX
	//★画面表示(ディレクトリ情報表示)
	public function dir_view(){
		$this->layout=false;
	
		if($this->request->data){
			$post=$this->request->data;
			$params=array(
				"app_id"=>$this->admindata["Admin"]["item_app_id"],
				"directory"=>$post["dir"],
			);
			$dirlist=$this->Curl->access($this->itemurl."fileedit/dir_list",$params);
			$this->set("dirlist",$dirlist);

			$backpath=dirname($post["dir"]);
			if($backpath!="."){
				$this->set("backpath",$backpath);
			}
		}
	}
	//ディレクトリ作成
	public function dir_make(){
		$this->layout=false;
		$this->autoRender=false;

		if($this->request->data){
			$post=$this->request->data;

			$params=array(
				"app_id"=>$this->admindata["Admin"]["item_app_id"],
				"directory"=>$post["path"]."/".$post["directory_name"],
			);
			$this->Curl->access($this->itemurl."fileedit/dir_make",$params);

		}


	}
	//ファイルバッファ準備
	public function file_buffer(){
		$this->layout=false;
		$this->autoRender=false;

		if($this->request->data){
			$post=$this->request->data;

			$buffer_path="buffer/admin/".hash("sha256",$this->admindata["Admin"]["item_app_id"]);

			@mkdir("buffer");
			@mkdir("buffer/admin/");
			@mkdir($buffer_path);

			copy($post["uploadfile"]["tmp_name"],$buffer_path."/".$post["uploadfile"]["name"]);
		}


	}
	//ファイルアップロード
	public function file_upload(){
		$this->layout=false;
		$this->autoRender=false;

		if($this->request->data){
			$post=$this->request->data;

			$localfile=Router::url("/",true)."buffer/admin/".hash("sha256",$this->admindata["Admin"]["item_app_id"])."/".$post["uploadfile"]["name"];
			$remotefile=$post["path"]."/".$post["uploadfile"]["name"];

			$params=array(
				"app_id"=>$this->admindata["Admin"]["item_app_id"],
				"localfile"=>$localfile,
				"remotefile"=>$remotefile,
			);
			$this->Curl->access($this->itemurl."fileedit/file_upload",$params);
		}
	}
	//ファイルを削除
	public function file_delete(){
		$this->layout=false;
		$this->autoRender=false;

		if($this->request->data){
			$post=$this->request->data;

			$params=array(
				"app_id"=>$this->admindata["Admin"]["item_app_id"],
				"deletefile"=>$post["path"],
			);
			$this->Curl->access($this->itemurl."fileedit/file_delete",$params);

		}
	}
	//ディレクトリを削除
	public function dir_delete(){
		$this->layout=false;
		$this->autoRender=false;

		if($this->request->data){
			$post=$this->request->data;

			$params=array(
				"app_id"=>$this->admindata["Admin"]["item_app_id"],
				"deletedirectory"=>$post["path"],
			);
			$this->Curl->access($this->itemurl."fileedit/dir_delete",$params);
		}

	}
	//ディレクトリ名を変更
	public function dir_rename(){
		$this->layout=false;
		$this->autoRender=false;

		if($this->request->data){
			$post=$this->request->data;

			$params=array(
				"app_id"=>$this->admindata["Admin"]["item_app_id"],
				"after_directory"=>$post["after_directory"],
				"before_directory"=>$post["before_directory"],
			);
			$this->Curl->access($this->itemurl."fileedit/dir_rename",$params);
		}

	}
	//ファイル名を変更
	public function file_rename(){
		$this->layout=false;
		$this->autoRender=false;

		if($this->request->data){
			$post=$this->request->data;

			$params=array(
				"app_id"=>$this->admindata["Admin"]["item_app_id"],
				"after_file"=>$post["after_file"],
				"before_file"=>$post["before_file"],
			);
			$this->Curl->access($this->itemurl."fileedit/file_rename",$params);
		}

	}
}
