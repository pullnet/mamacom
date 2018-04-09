<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	FilemanageComponent
//	FilemanageComponent.php
//
//--------------------------------------------------
class FilemanageComponent extends Component{

	//constructer
	public function __construct($data){
		include("../app/Backend/Config/Filemanage.php");
		$this->config=$filemanage["default"];

		parent::__construct($data);

	}
	public function set_config($name){
		$this->config=$filemanage[$name];
	}
	public function manual_setting($array){
		$this->config=$array;
	}
	public function dir_list($directory="/"){
		$directory="../wdata/".$this->config["rootdirectory"].$directory."/*";
		$directory=$this->double_slash($directory);
		$output=array();
		$datalist=glob($directory);
		foreach($datalist as $d_){
			if(is_dir($d_)){
				$buff=array(
					"path"=>$d_,
					"name"=>basename($d_),
					"createdate"=>date("Y-m-d H:i:s",filectime($d_)),
					"refreshdate"=>date("Y-m-d H:i:s",filemtime($d_)),
				);
				$output["dir"][]=$buff;
			}
			else
			{
				$types=pathinfo($d_);
				$buff=array(
					"path"=>$d_,
					"name"=>basename($d_),
					"size"=>filesize($d_),
					"type"=>$types["extension"],
					"createdate"=>date("Y-m-d H:i:s",filectime($d_)),
					"refreshdate"=>date("Y-m-d H:i:s",filemtime($d_)),
				);
				$output["file"][]=$buff;
			}
		}

		return $output;
	}
	public function dir_make($directory){
		$dbf_=$directory;
		$directory="../wdata/".$this->config["rootdirectory"];


		$dbfc_=explode("/",$dbf_);
		foreach($dbfc_ as $d_){
			$directory.="/".$d_;
			$directory=$this->double_slash($directory);
			@mkdir($directory);
		}
	}
	public function dir_delete($directory){
		$directory="../wdata/".$this->config["rootdirectory"]."/".$directory;
		
		$list=$this->_search($directory);
		if(@$list["file"]){
			foreach($list["file"] as $l_){
				@unlink($l_);
			}
		}
		sleep(1);
		if(@$list["dir"]){
			foreach($list["dir"] as $l_){
				@rmdir($l_);
			}
		}
		@rmdir($directory);
	}

	public function file_download($directory){
		$directory="../wdata/".$this->config["rootdirectory"]."/".$directory;
		$directory=$this->double_slash($directory);

		$length=filesize($directory);
		header("Content-Disposition: inline; filename=\"".basename($directory)."\"");
		header("Content-Length: ".$length);
		header("Content-Type: application/octet-stream");
		
		@readfile($directory);
	}
	public function file_upload($source,$upload_path){
		//$source="../wdata/".$this->config["buffer"]."/".$source;
		$source=$this->double_slash($source);

		$u_dir=explode("/",$upload_path);
		$udirs="../wdata/".$this->config["rootdirectory"];
		$ind=0;
		foreach($u_dir as $u_){
			if($ind<count($u_dir)-1){
				$udirs.="/".$u_;
				$udirs=$this->double_slash($udirs);
				@mkdir($udirs);
			}
			$ind++;
		}

		$upload_path="../wdata/".$this->config["rootdirectory"]."/".$upload_path;
		$upload_path=$this->double_slash($upload_path);

		@copy($source,$upload_path);
	}
	public function file_delete($filepath){
		$filepath="../wdata/".$this->config["rootdirectory"]."/".$filepath;
		$filepath=$this->double_slash($filepath);

		@unlink($filepath);

	}
	public function rename($before,$after){
		$before="../wdata/".$this->config["rootdirectory"]."/".$before;
		$before=$this->double_slash($before);

		$after="../wdata/".$this->config["rootdirectory"]."/".$after;
		$after=$this->double_slash($after);
		
		@rename($before,$after);
	}
	private function _search($directory){
		$lists=glob($directory."/*");

		$output=array();
		foreach($lists as $l_){
			if(is_dir($l_)){
				$buff=$this->_search($l_);
				$output=array_merge($output,$buff);
				$output["dir"][]=$l_;
			}
			else
			{
				$output["file"][]=$l_;
			}
		}
		return $output;
	}
	private function double_slash($str){
		$str=str_replace("//","/",$str);
		return $str;
	}


}
?>