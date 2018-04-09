<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	Component
//	Component.php
//
//--------------------------------------------------

class Component extends Object{

	public $components;

	public function add_data($name,$data){
		$this->{$name}=$data;
	}
	public function __construct($data){
		parent::__construct($data);

		//model setting...
		if(@$this->uses){
			foreach($this->uses as $u_){
				$no_modelfile=false;
				if(file_exists("../app/Backend/Model/".$u_.".php")){
					include_once("../app/Backend/Model/".$u_.".php");
					$no_modelfile=true;
				}
				else
				{
					$subdir=glob_deep("../app/Backend/Model",null,"directory");
					foreach($subdir as $key=>$s_){
						if(file_exists($s_."/".$u_.".php")){
							include_once($s_."/".$u_.".php");
							$no_modelfile=true;
							break;
						}
					}
				}


				if($no_modelfile){
					$this->{$u_}=new $u_($this,$u_);
				}
				else
				{
					$this->{$u_}=new Model($this,$u_);
				}
			}
		}

		//default component setting...
		$dcl_list=array(
			"Auth"=>true,
			"Cookie"=>true,
			"Session"=>true,
			"Encrypt"=>true,
			"Email"=>true,
			"Configload"=>true,
			"Image"=>true,
			"Filemanage"=>true,
			"Curl"=>true,
			"Zip"=>true,
			"Ftp"=>true,
			"Filemanage"=>true,
			"Csv"=>true,
			"Basicauth"=>true,
			"RestAPI"=>true,
		);

		if(@$this->components){
			foreach($this->components as $com_){
				if($com_."Component"!=get_Class($this)){
					if(@$dcl_list[$com_]){
						include_once("../lib/PHP-X/Component/".$com_."Component.php");
					}
					else
					{
						if(file_exists("../app/Backend/Component/".$com_."Component.php")){
							include_once("../app/Backend/Component/".$com_."Component.php");
						}
						else
						{
							$subdir=glob_deep("../app/Backend/Component",null,"directory");
							foreach($subdir as $key=>$s_){
								if(file_exists($s_."/".$com_."Component.php")){
									include_once($s_."/".$com_."Component.php");
									break;
								}
							}
						}

					}
					$componame=$com_."Component";
					$this->{$com_}=new $componame($this);
					$this->{$com_}->beforeFilter();
				}
			}
		}
	}
	public function beforeFilter(){

	}
	//redirect
	public function redirect($url){
		if(is_array($url)){
			$urlkey=array_keys($url);
			$ind=0;
			$param=array();

			foreach($url as $u_){
				if(is_int($urlkey[$ind])){
					$param[]=$u_;
				}

				$ind++;
			}
			$redirecturl=$this->params["root"].$url["controller"]."/".$url["action"];

			foreach($param as $p_){
				$redirecturl.="/".$p_;
			}
		}
		else
		{
			if($url=="/"){
				$url="";
			}
			$redirecturl=$this->params["root"].$url;
		}
		header("Location: ".$redirecturl);
	}
	//add uses
	public function add_uses($model){
		if(is_array($model)){
			foreach($model as $m_){

				if(file_exists("../app/Backend/Model/".$m_.".php")){
					include_once("../app/Backend/Model/".$m_.".php");
				}
				else
				{
					$dir_search=glob_deep("../app/Backend/Model","directory");
					foreach($dir_search as $d_){
						if(file_exists($d_."/".$m_.".php")){
							include_once($d_."/".$m_.".php");
							break;
						}
					}

				}
				$this->{$m_}=new $m_($this,$m_);
			}
		}
		else
		{
			if(file_exists("../app/Backend/Model/".$model.".php")){
				include_once("../app/Backend/Model/".$model.".php");
			}
			else
			{
				$dir_search=glob_deep("../app/Backend/Model","directory");
				foreach($dir_search as $d_){
					if(file_exists($d_."/".$model.".php")){
						include_once($d_."/".$model.".php");
						break;
					}
				}

			}
			$this->{$model}=new $model($this,$model);
		}
	}
	//2017 7/14 transaction method
	//begin
	public function Transam($mode=null,$models=array()){
		if($mode=="begin"){
			if($models){
				$this->transam_model=$models;
			}
		}
		if($mode){
			foreach($this->transam_model as $m_){
				$this->{$m_}->transam($mode);
			}
		}
	}
}
?>