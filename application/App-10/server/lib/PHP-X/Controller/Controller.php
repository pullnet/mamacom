<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	Controller
//	Controoler.php
//
//--------------------------------------------------

class Controller{

	public $params=array(
		"Controller"=>"main",
		"action"=>"index",
	);

	public $access_mode=0;

	public $error;
	public $request;

	public $autoRender=true;

	public $layout;
	public $uses;
	public $components;
	public $helpers;

	public $view_output=array();

	public function __construct($params){
		global $fast_loading;

		if(@$fast_loading){
			$this->access_mode=0;
		}
		else{
			if(!$params){
				$this->access_mode=1;
			}

			$bcf=get_parent_class($this);
			$null=array();
			if($bcf && $bcf!="Controller"){
				$bef=new $bcf($null);

				//uses parent reload
				$this->uses=@array_merge($this->uses,$bef->uses);
				if(@$this->uses){
					$usesbuff=array();
					foreach($this->uses as $u_){
						$usesbuff[$u_]=$u_;
					}
					$this->uses=$usesbuff;
				}
				//component parent reload
				$this->components=@array_merge($this->components,$bef->components);
				if(@$this->components){
					$component_buff=array();
					foreach($this->components as $c_){
						$component_buff[$c_]=$c_;
					}
					$this->components=$component_buff;
				}

				//helper parent reload
				$this->helpers=@array_merge($this->helpers,$bef->helpers);
				if(@$this->helpers){
					$helper_buff=array();
					foreach($this->helpers as $c_){
						$helper_buff[$c_]=$c_;
					}
					$this->helpers=$helper_buff;
				}
			}

		}

		if($this->access_mode==0){
			$this->request=new request();

			//setting POST and GET parameter
			$this->params=$params;
			$this->request->post=@$_POST["dat"];
			if(@$_FILES){
				$postbuff=array();
				if(@$_FILES["dat"]){
					$files_key=array_keys(@$_FILES["dat"]);
					$ind=0;
					foreach(@$_FILES["dat"] as $f_){
						$f_key=array_keys($f_);
						$ind2=0;
						foreach($f_ as $ff_){
							$ind3=0;
							$ff_key=array_keys($ff_);
							foreach($ff_ as $fff_){
								$postbuff[$f_key[$ind2]][$ff_key[$ind3]][$files_key[$ind]]=$fff_;
								$ind3++;
							}
							$ind2++;
						}
						$ind++;
					}
				}
				if(@$_POST["dat"][key(@$_POST["dat"])]){
					$posts[key(@$postbuff)]=array_merge(@$_POST["dat"][key(@$_POST["dat"])],$postbuff[key(@$postbuff)]);
				}
				else
				{
					$posts[key(@$postbuff)]=@$postbuff[key(@$postbuff)];
				}
				$this->request->post=$posts;
			}
			$this->request->get=@$_GET;

			//Database access setting
			include_once("../app/Backend/Config/database.php");
			$this->database=$database;

			//Model setting
			if(@$this->uses){
				foreach($this->uses as $u_){
					$no_modelfile=false;
					if(file_exists("../app/Backend/Model/".$u_.".php")){
						include_once("../app/Backend/Model/".$u_.".php");
						$no_modelfile=true;
					}
					else
					{
						$subdir=glob_deep("../app/Backend/Model","directory");
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

/*
					if(!@class_exists($u_)){
						error("Error Model ".$u_,"Nothing Class ".$u_);
					}
*/

				}
			}
			//Model setting(library)
			if(@$this->uses_lib){
				foreach($this->uses_lib as $u_){
					if(file_exists("../lib/PHP-X/Model/".$u_.".php")){
						include_once("../lib/PHP-X/Model/".$u_.".php");
					}
					else
					{
						$subdir=glob_deep("../lib/PHP-X/Model","directory");
						foreach($subdir as $key=>$s_){
							if(file_exists($s_."/".$u_.".php")){
								include_once($s_."/".$u_.".php");
								break;
							}
						}
					}

					if(!@class_exists($u_)){
						error("Error Model ".$u_,"Nothing Class ".$u_);
					}
					$this->{$u_}=new $u_($this,$u_);

				}
			}


			//Component setting
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
				"Htmlscrape"=>true,
				"Modelmake"=>true,
				"Csv"=>true,
				"Basicauth"=>true,
				"RestAPI"=>true,
				"Remote"=>true,
			);
			//set component
			if(@$this->components){
				$com_key=array_keys($this->components);
				$ind=0;
				foreach($this->components as $com_){
					if(is_array($com_)){
						$com2_=$com_key[$ind];
					
						if(@$dcl_list[$com2_]){
							include_once("../lib/PHP-X/Component/".$com2_."Component.php");
						}
						else
						{

							if(file_exists("../app/Backend/Component/".$com2_."Component.php")){
								include_once("../app/Backend/Component/".$com2_."Component.php");
							}
							else
							{
								$subdir=glob_deep("../app/Backend/Component","directory");
								foreach($subdir as $key=>$s_){
									if(file_exists($s_."/".$com2_."Component.php")){
										include_once($s_."/".$com2_."Component.php");
										break;
									}
								}
							}

						}
						$componame=$com2_."Component";
						$this->{$com2_}=new $componame($this);
						$this->{$com2_}->add_data($com2_,$com_);
					}
					else
					{
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
								$subdir=glob_deep("../app/Backend/Component","directory");
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
					}

					$ind++;
				}
			}
		}
	}
	public function __destruct(){
		if($this->access_mode==0){

			//Helper setting
			$hel_list=array(
				"Form"=>true,
				"Html"=>true,
				"Pager"=>true,
				"Calender"=>true,
				"Highlight"=>true,
				"Apidoc"=>true,
				"Sqldoc"=>true,
			);
			if(@$this->helpers){
				foreach($this->helpers as $h_){

					if(@$hel_list[$h_]){
						include_once("../lib/PHP-X/Helper/".$h_."Helper.php");
					}
					else
					{
						if(file_exists("../app/Frontend/Helper/".$h_."Helper.php")){
							include_once("../app/Frontend/Helper/".$h_."Helper.php");
						}
						else
						{
							$subdir=glob_deep("../app/Frontend/Helper","directory");
							foreach($subdir as $key=>$s_){
								if(file_exists($s_."/".$h_."Helper.php")){
									include_once($s_."/".$h_."Helper.php");
									break;
								}
							}
						}
					}

					$helper=$h_."Helper";
					$this->{$h_}=new $helper($this);
				}
			}

			//component(before filter and refrsh)
			if(@$this->components){
				$com_key=array_keys($this->components);
				$ind=0;
				foreach(@$this->components as $com_){
					if(is_array($com_)){
						$com2_=$com_key[$ind];
						$this->{$com2_}->o__refresh($this);
						$this->{$com2_}->beforeFilter();
					}
					else
					{
						$this->{$com_}->o__refresh($this);
						$this->{$com_}->beforeFilter();
					}
					$ind++;
				}
			}

			//beforeFilter2nd
			$this->beforeFilter2nd();

			//set layout
			foreach($this->view_output as $key=>$o_){
				$$key=$o_;
			}

			if(@$this->layout_lib){
				if($this->autoRender){
					include_once("../lib/PHP-X/Layout/".$this->layout_lib.".ctp");
				}
			}
			else
			{
				if($this->layout){
					if($this->autoRender){
						include_once("../app/Frontend/Layout/".$this->layout.".ctp");
					}
				}
				else
				{
					if($this->autoRender){
						if(@$this->Render){
							include_once("../app/Frontend/View/".$this->Render.".ctp");
						}
						else
						{
							include_once("../app/Frontend/View/".ucfirst($this->params["Controller"])."/".$this->params["action"].".ctp");
						}
					}
				}
			}

		}
	}
	public function set($name,$value){
		$this->view_output[$name]=$value;
	}
	public function beforeFilter(){

		//free....

	}
	public function afterFilter(){

		//free....

	}
	public function beforeFilter2nd(){

		//free....

	}
	public function fetch($type){
		foreach($this->view_output as $key=>$o_){
			$$key=$o_;
		}

		if($type=="content"){
			if(@$this->Render){
				include_once("../app/Frontend/View/".ucfirst($this->params["Controller"])."/".$this->Render.".ctp");
			}
			else
			{
				include_once("../app/Frontend/View/".ucfirst($this->params["Controller"])."/".$this->params["action"].".ctp");
			}
		}
		if($this->error){
			error($this->error["main"],$this->error["caption"]);
		}
	}
	// fetch_lib
	public function fetch_lib($type){
		foreach($this->view_output as $key=>$o_){
			$$key=$o_;
		}

		if($type=="content"){

			if(@$this->Render){
				include_once("../lib/PHP-X/View/".ucfirst($this->params["Controller"])."/".$this->Render.".ctp");
			}
			else
			{
				include_once("../lib/PHP-X/View/".ucfirst($this->params["Controller"])."/".$this->params["action"].".ctp");
			}
		}
		if($this->error){
			error($this->error["main"],$this->error["caption"]);
		}
	}
	public function Part($name){
		foreach($this->view_output as $key=>$o_){
			$$key=$o_;
		}

		if(!@file_exists("../app/Frontend/Part/".$name.".ctp")){
		//	echo "<p>no exists .".$name.".ctp</p>";
		}
		include("../app/Frontend/Part/".$name.".ctp");
	}
	public function Part_lib($name){
		foreach($this->view_output as $key=>$o_){
			$$key=$o_;
		}

		if(!@file_exists("../lib/PHP-X/Part/".$name.".ctp")){
		//	echo "<p>no exists .".$name.".ctp</p>";
		}
		include("../lib/PHP-X/Part/".$name.".ctp");
	}


	//redirect
	public function redirect($url){
		$redirecturl=$this->_seturl($url);
		header("Location: ".$redirecturl);
	}
	//seturl
	private function _seturl($url){

		if(is_array($url)){

			$checkurl=$url;
			unset($checkurl["controller"]);
			unset($checkurl["action"]);
			if(@$checkurl){
				if(!@$url["action"]){
					$url["action"]="index";
				}
			}

			if(@$this->params["firsturl"]){
				$linkurl=$this->params["root"].@$url[$this->params["firsturl"]]."/".$url["controller"]."/".$url["action"];
			}
			else
			{
				$linkurl=$this->params["root"].$url["controller"]."/".$url["action"];
			}

			$urlbuff=$url;
			unset($urlbuff["controller"]);
			unset($urlbuff["action"]);
			unset($urlbuff["?"]);
			unset($urlbuff["#"]);
			if(@$this->params["firsturl"]){
				unset($urlbuff[$this->params["firsturl"]]);
			}
			$last=count($urlbuff);
			$ind=0;
			foreach($urlbuff as $u_){
				if($ind<$last){
					$linkurl.="/".$u_;
				}
				$ind++;
			}

			//get parameter
			if(@$url["?"]){
				$url["?"]=$this->_getparams($url["?"]);
			}
			else
			{
				unset($url["?"]);
			}
			//pagein linke
			if(@$url["#"]){
				$url["#"]="#".$url["#"];
			}

			$linkurl.=$url["?"].$url["#"];

			return $linkurl;
		}
		else
		{
			if($url=="/"){
				return $this->params["root"];
			}
			else
			{
				return $url;
			}
		}
	}
	//get parameter
	private function _getparams($params){
		$get_str="?";
		$params_key=array_keys($params);
		$ind=0;
		$last=count($params);
		foreach($params as $p_){
			$get_str.=$params_key[$ind]."=".$p_;
			if($ind<($last-1)){
				$get_str.="&";
			}
			$ind++;
		}
		return $get_str;

	}
	//add uses
	public function add_uses($model){
		if(is_array($model)){
			foreach($model as $m_){
				include_once("../app/Backend/Model/".$m_.".php");
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
	//remove uses
	public function remove_uses($model){
		if(is_array($model)){
			foreach($model as $m_){
				unset($this->{$m_});
			}
		}
		else
		{
			unset($this->{$model});
		}
	}
	//file download
	public function download($filepath,$filename=null){
		$this->autoRender=false;

		if(!$filename){
			$filename=basename($filepath);
		}
		header('Content-Type: application/force-download');
		header('Content-Length: '.filesize($filepath));
		header('Content-disposition: attachment; filename="'.$filename.'"');
		readfile($filepath);

	}

	//2017 6/2 transaction method
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