<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	default index
//	index.php
//
//--------------------------------------------------
	$params=array();
	$url_array=array();

	include("../app/Backend/Config/config.php");
	if(@$default_charset){
		header('Content-Type: text/html; charset='.$default_charset);
	}
	//Default function
	$params=set_params();

	//include...
	include("../app/Backend/Config/routes.php");
	include("../lib/PHP-X/Function.php");
	include("../lib/PHP-X/Error.php");
	include("../lib/PHP-X/Object.php");
	include("../lib/PHP-X/Model/Model.php");
	include("../lib/PHP-X/Helper/Helper.php");
	include("../lib/PHP-X/Component/Component.php");
	include("../lib/PHP-X/Controller/Controller.php");

	//Controller add
	$error_check=false;
	if(file_exists("../app/Backend/Controller/".ucfirst($params["Controller"])."Controller.php")){
		$controller_path="../app/Backend/Controller/".ucfirst($params["Controller"])."Controller.php";
		$error_check=true;
	}
	else
	{
		$subdir=glob_deep("../app/Backend/Controller",null,"directory");
		foreach($subdir as $key=>$s_){
			if(file_exists($s_."/".ucfirst($params["Controller"])."Controller.php")){
				$controller_path=$s_."/".ucfirst($params["Controller"])."Controller.php";
				$error_check=true;
				break;
			}
		}

		if(file_exists("../lib/PHP-X/Controller/".ucfirst($params["Controller"])."Controller.php")){
			$error_check=true;
			$controller_path="../lib/PHP-X/Controller/".ucfirst($params["Controller"])."Controller.php";
		}
	}

	if($error_check){
		include($controller_path);
	}
	else
	{
		error(ucfirst($params["Controller"])."Controller.php not found.","Please file make ".ucfirst($params["Controller"])."Controller.php");
		exit;
	}

	$controller_name=$params["Controller"]."Controller";
	$controllers=new $controller_name($params);
	$controllers->beforeFilter();
	if(method_exists($controllers,$params["action"])){
		if(!@$params["names"][0]){
			$controllers->{$params["action"]}();
		}
		else if(!@$params["names"][1]){
			$controllers->{$params["action"]}(@$params["names"][0]);
		}
		else if(!@$params["names"][2]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1]);
		}
		else if(!@$params["names"][3]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2]);
		}
		else if(!@$params["names"][4]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2],@$params["names"][3]);
		}
		else if(!@$params["names"][5]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2],@$params["names"][3],@$params["names"][4]);
		}
		else if(!@$params["names"][6]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2],@$params["names"][3],@$params["names"][4],@$params["names"][5]);
		}
		else if(!@$params["names"][7]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2],@$params["names"][3],@$params["names"][4],@$params["names"][5],@$params["names"][6]);
		}
		else if(!@$params["names"][8]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2],@$params["names"][3],@$params["names"][4],@$params["names"][5],@$params["names"][6],@$params["names"][7]);
		}
		else if(!@$params["names"][9]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2],@$params["names"][3],@$params["names"][4],@$params["names"][5],@$params["names"][6],@$params["names"][7],@$params["names"][8]);
		}
		else if(!@$params["names"][10]){
			$controllers->{$params["action"]}(@$params["names"][0],@$params["names"][1],@$params["names"][2],@$params["names"][3],@$params["names"][4],@$params["names"][5],@$params["names"][6],@$params["names"][7],@$params["names"][8],@$params["names"][9]);
		}
		else
		{
			$controllers->{$params["action"]}();
		}

	}
	else
	{
		$controllers->error=array(
			"main"=>"No exists Controller action ".$params["action"],
			"caption"=>"Please make ".ucfirst($params["Controller"])."Controller.php as ".$params["action"]." function.",
		);
	}
	$controllers->afterFilter();
	$controllers=NULL;

	function set_params(){
		global $params;
		global $url_array;
		global $cms_routing;
		global $url_offset;

		//URL setting
		$url_array=explode('/',$_SERVER['REQUEST_URI']);
		unset($url_array[0]);

		$script_array=explode('/',$_SERVER["SCRIPT_NAME"]);
		unset($script_array[0]);
		unset($script_array[count($script_array)]);
		unset($script_array[count($script_array)]);

		//rootdirectory setting
		$rootdirs=$script_array;

		$sc_count=count($script_array);

		if(@$url_offset){
			for($vss=1;$vss<=$sc_count+$url_offset;$vss++){
				unset($url_array[$vss]);
				unset($script_array[$vss]);
			}
		}
		else
		{
			for($vss=1;$vss<=$sc_count;$vss++){
				unset($url_array[$vss]);
				unset($script_array[$vss]);
			}
		}

		unset($url_array[count($script_array)]);

		$request_url="";
		$ind=0;
	//	print_r($url_array);

		foreach($url_array as $u_){
		/*	if(@$url_offset){
				if($ind==0){
					$ind++;
					continue;
				}
			}*/

			if(@$params["firsturl"]){
				if($ind>0){
					$request_url.="/".$u_;
				}

				if($ind==0){
					$params[$params["firsturl"]]=$u_;
				}
			}
			else
			{
				$request_url.="/".$u_;
			}
			$ind++;
		}
		$params["request_url"]=$request_url;
		$url_array=explode("/",$request_url);
		unset($url_array[0]);



		if(@$cms_routing){

			$params["Controller"]="main";
			$params["action"]="index";
			$permalink_list=explode("/",$params["request_url"]);
	
			$ind=0;
			foreach($permalink_list as $p_){
				if($p_){

					if($ind==(count($permalink_list)-1)){
						$p_=@explode("?",$p_);
						$p_=$p_[0];
					}

					$params["names"][]=$p_;
				}
				$ind++;
			}

			//root directory setting
			$rootdirectory="/";
			$ind=0;
			foreach($rootdirs as $key=>$rdr_){
				if(@$url_offset){
					if($ind==count($rootdirs)-1){
						continue;
					}
				}
				$rootdirectory.=$rdr_."/";
				$ind++;
			}

			$params["root"]=(empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"].$rootdirectory;
			$params["url"]=substr($params["root"],0,strlen($params["root"])-1).$params["request_url"];
			
			return $params;
		}
		else
		{

			$count=0;
			foreach($url_array as $u_){
				if($count==0){
					if($u_){
						$params["Controller"]=$u_;
					}

				}
				else if($count==1){
					if($u_){
						$u_=@explode("?",$u_);
						$u_=@explode("#",$u_[0]);
						$u_=@explode("/",$u_[0]);
						$params["action"]=$u_[0];
					}
				}
				else if($count>=2){
					if($u_){
						$u_=@explode("?",$u_);
						$u_=@explode("#",$u_[0]);

						$params["names"][]=$u_[0];
					}
				}
				$count++;
			}
			if(!@$params["Controller"]){
		//		$params["Controller"]="main";
			}
			if(!@$params["action"]){
				$params["action"]="index";
			}

			//root directory setting
			$rootdirectory="/";
			foreach($rootdirs as $rdr_){
				$rootdirectory.=$rdr_."/";
			}
		
			$params["root"]=(empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"].$rootdirectory;
			$params["url"]=substr($params["root"],0,strlen($params["root"])-1).$params["request_url"];
			
			return $params;
		}
	}
	//routing
	function set_routes($url,$params_set){
		global $params;
		global $cms_routing;

		if($url==$params["request_url"]){
			if(@$params_set["controller"]){
				$params["Controller"]=$params_set["controller"];
			}
			if(@$params_set["action"]){
				$params["action"]=$params_set["action"];
			}
		}
		//routing foot
		if($url){
			if(strpos($url,"/*")){
				$suburl=substr($url,1,-2);
				if(strpos($params["request_url"],$suburl)){
					if(@$params_set["controller"]){
						$params["Controller"]=$params_set["controller"];
						if($cms_routing){
							$get_action=$params["names"][1];
							unset($params["names"][0]);
							unset($params["names"][1]);
							sort($params["names"]);
							$params["action"]=$get_action;
						}
					}
				}
			}
		}		
	}
	function set_firsturl($url){
		global $params;
		$params["firsturl"]=$url;
	}
?>
