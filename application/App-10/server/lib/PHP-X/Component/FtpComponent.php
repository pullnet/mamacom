<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	FtpComponent
//	FtpComponent.php
//
//--------------------------------------------------
class FtpComponent extends Component{

	public $config;
	public $access_id;

	//constructer
	public function __construct($data){
		parent::__construct($data);
		
		include("../app/Backend/Config/ftp.php");
		$this->config=$ftp["default"];
	}

	//ftp config change
	public function set_config($name){
		$this->config=$ftp[$name];
	}

	//ftp config manual setting
	public function manual_setting($array){

		$this->config=$array;
	}

	//ftp directory data search
	public function dir($directory="/"){
	
		if(!@$this->_access_open()){
			return false;
		}

		if(@$this->config["rootdirectory"]){
			$directory=$this->config["rootdirectory"]."/".$directory;
		}
		$directory=$this->double_slash($directory);

		//get file directory list
		$datalist=ftp_nlist($this->access_id, $directory);
		unset($datalist[0]);
		sort($datalist);
		$otuput=array();
		foreach($datalist as $d_){
			$filesize=ftp_size($this->access_id, $d_);
			if($filesize==-1){
				$buff=array(
					"name"=>basename($d_),
					"path"=>$d_,
					"type"=>"dir",
				);
			}
			else
			{
				$dates=ftp_mdtm($this->access_id,$d_);
				$buff=array(
					"name"=>basename($d_),
					"path"=>$d_,
					"type"=>"file",
					"size"=>$filesize,
					"date"=>date("Y-m-d H:i:s",$dates),
				);
			}
			$output[]=$buff;
		}



		$this->_access_close();

		return $output;

	}
	//ftp file download
	public function file_download($remotefile_path,$localfile_path=""){
		if(!@$this->_access_open()){
			return false;
		}


		if(!@$localfile_path){
			$localfile_path="download".date("YmdHis");
		}
		$localfile_path="../wdata/".$localfile_path;

		if(@$this->config["rootdirectory"]){
			$remotefile_path=$this->config["rootdirectory"]."/".$remotefile_path;
		}

		$localfile_path=$this->double_slash($localfile_path);
		$remotefile_path=$this->double_slash($remotefile_path);

		ftp_get($this->access_id,$localfile_path,$remotefile_path,FTP_BINARY);


		$this->_access_close();
	}
	//ftp file upload
	public function file_upload($localfile_path,$remotefile_path){
		if(!@$this->_access_open()){
			return false;
		}
		$localfile_path="../wdata/".$localfile_path;

		$rpb_=$remotefile_path;

		if(@$this->config["rootdirectory"]){
			$remotefile_path=$this->config["rootdirectory"]."/".$remotefile_path;
		}

		$localfile_path=$this->double_slash($localfile_path);
		$remotefile_path=$this->double_slash($remotefile_path);

		$directory=explode("/",$rpb_);
		unset($directory[count($directory)-1]);

		$target_dir=$this->config["rootdirectory"]."/";
		foreach($directory as $d_){
			if($d_){
				$target_dir.="/".$d_;
				$target_dir=$this->double_slash($target_dir);
				@ftp_mkdir($this->access_id,$target_dir);
			}
		}

		ftp_put($this->access_id,$remotefile_path,$localfile_path,FTP_BINARY);

		$this->_access_close();
	}
	//ftp file delete
	public function file_delete($remotefile_path){
		if(!@$this->_access_open()){
			return false;
		}

		if(@$this->config["rootdirectory"]){
			$remotefile_path=$this->config["rootdirectory"]."/".$remotefile_path;
		}
		$remotefile_path=$this->double_slash($remotefile_path);

		@ftp_delete($this->access_id,$remotefile_path);

		$this->_access_close();
	}
	//ftp directory make
	public function dir_make($remotefile_path){
		if(!@$this->_access_open()){
			return false;
		}

		if(@$this->config["rootdirectory"]){
			$remotefile_path=$this->config["rootdirectory"]."/".$remotefile_path;
		}
		$remotefile_path=$this->double_slash($remotefile_path);

		@ftp_mkdir($this->access_id,$remotefile_path);

		$this->_access_close();
	}
	//ftp directory delete
	public function dir_delete($remotefile_path){
		if(!@$this->_access_open()){
			return false;
		}

		if(@$this->config["rootdirectory"]){
			$remotefile_path=$this->config["rootdirectory"]."/".$remotefile_path;
		}
		$remotefile_path=$this->double_slash($remotefile_path);

		$datalist=$this->_dirsearch($remotefile_path);

		if(@$datalist["file"]){
			foreach($datalist["file"] as $d_){
				@ftp_delete($this->access_id,$d_);
			}
		}
		if(@$datalist["dir"]){
			foreach($datalist["dir"] as $d_){
				@ftp_rmdir($this->access_id,$d_);
			}
		}

		@ftp_rmdir($this->access_id,$remotefile_path);

		$this->_access_close();
	}
	private function _dirsearch($directory){
		$list=@ftp_nlist($this->access_id,$directory);
		unset($list[0]);
		unset($list[1]);

		$output=array();
		if(@$list){
			foreach($list as $l_){
				
				$size=ftp_size($this->access_id,$l_);
				if($size==-1){
					$output["dir"][]=$l_;
					$buffer=$this->_dirsearch($l_);
					$output=array_merge($output,$buffer);
				}
				else
				{
					$output["file"][]=$l_;
				}
			}
		}
		return $output;
	}
	
	//ftp access open
	private function _access_open(){
		//connect
		$this->access_id=ftp_connect(@$this->config["host"]);

		//login
		$login=(@ftp_login($this->access_id, @$this->config["username"], $this->config["password"]));

		if(@$login){
			//PASV mode
			if(@$this->config["PASV"]==true){
				ftp_pasv($this->access_id, TRUE);
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	//ftp access close
	private function _access_close(){
		//close
		ftp_close($this->access_id);
	}
	private function double_slash($str){
		$str=str_replace("//","/",$str);
		return $str;
	}

}
?>