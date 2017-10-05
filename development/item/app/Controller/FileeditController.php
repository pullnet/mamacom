<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/02/07							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://image.collabos.jp					*/
/*									*/
/*	管理側ファイル操作用コントローラ				*/
/*	FileeditController.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppController', 'Controller');

class FileeditController extends AppController {

	public $uses=array(
		"Admin",
	);

	public $autoRender=false;//viewを使わない
	public $layout=false;//レイアウトなし

	public function beforefilter(){
		parent::beforefilter();
	}

	//★ディレクトリ内検索
	public function dir_list(){
		if(@$this->request->query){
			$query=$this->request->query;
			if($this->_check($query)){
				if($query["directory"]){
					return json_encode($this->_search($query["directory"]),JSON_UNESCAPED_UNICODE);
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
		else
		{
			return false;
		}
	}
	//★ディレクトリ作成
	public function dir_make(){
		if(@$this->request->query){
			$query=$this->request->query;
			if($this->_check($query)){
				if($query["directory"]){
					@mkdir($query["directory"]);
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
		else
		{
			return false;
		}
	}
	//★ファイルアップロード
	public function file_upload(){
		if(@$this->request->query){
			$query=$this->request->query;
			if($this->_check($query)){
				@copy($query["localfile"],$query["remotefile"]);
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
	//★ファイルを削除
	public function file_delete(){
		if(@$this->request->query){
			$query=$this->request->query;
			if($this->_check($query)){
				@unlink($query["deletefile"]);
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
	//★ディレクトリを削除
	public function dir_delete(){
		if(@$this->request->query){
			$query=$this->request->query;
			if($this->_check($query)){

				$othercheck=$this->_search($query["deletedirectory"]);
				foreach($othercheck as $oc_){
					if(@$oc_["type"]=="dir"){
						@rmdir($oc_["path"]);
					}
					else if(@$oc_["type"]=="file"){
						@unlink($oc_["path"]);
					}
				}
				@rmdir($query["deletedirectory"]);
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
	//★ディレクトリ名を変更
	public function dir_rename(){
		if(@$this->request->query){
			$query=$this->request->query;
			if($this->_check($query)){
				@rename($query["before_directory"],$query["after_directory"]);
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
	//★ファイル名を変更
	public function file_rename(){
		if(@$this->request->query){
			$query=$this->request->query;
			if($this->_check($query)){
				@rename($query["before_file"],$query["after_file"]);
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
	public function _search($dir){
		$list=@glob($dir."/*");
		$output=array();
		foreach($list as $l_){
			if(is_dir($l_)){
				$output[]=array(
					"type"=>"dir",
					"name"=>basename($l_),
					"createdate"=>@filemtime(@$l_),
					"path"=>$l_,
				);
			}
			else
			{
				$pathinfo=@pathinfo(@$l_);
				$output[]=array(
					"type"=>"file",
					"name"=>basename($l_),
					"path"=>$l_,
					"size"=>@filesize($l_),
					"createdate"=>@filemtime(@$l_),
					"filetype"=>$pathinfo["extension"],
				);
			}
		}
		return $output;
	}
	//☆アクセスチェック用
	private function _check($query){
		
		if($query["app_id"]){

			$check=$this->Admin->find("first",array(
				"conditions"=>array("Admin.item_app_id"=>$query["app_id"]),
			));

			if($check){
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
