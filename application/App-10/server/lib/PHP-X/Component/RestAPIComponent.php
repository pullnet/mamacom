<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/08/27
//
//	RestAPIComponent
//	RestAPIComponent.php
//
//--------------------------------------------------
class RestAPIComponent extends Component{
	
	public $config;
	public $uses=array();
	public $error;

	public $apikey;

	public function __construct($data){
		parent::__construct($data);

		include_once("../app/Backend/Config/RestAPI.php");
		$this->config=$RestAPI;
	}
	public function auth($type="default",$option=array()){

		$config=$this->config[$type];

		$this->error=array();

		if(@$option["method"]){
			if($option["method"]=="get"){
				$get_data=$this->request->get;
			}
			else if($option["method"]=="post"){
				$get_data=$_POST;
			}
		}
		else
		{
			if($config["method"]=="get"){

				$get_data=$this->request->get;

			}
			else if($config["method"]=="post"){

				$get_data=$_POST;

			}
		}
		if(!@$get_data["service_secret"]){
			$this->error=array(
				"message"=>"request Failed(service_secret)",
				"code"=>400,
			);
			return;
		}
		if(!@$get_data["lisence_key"]){
			$this->error=array(
				"message"=>"request Failed(lisence_key)",
				"code"=>400,
			);
			return;
		}

		if($config["type"]=="public"){

			$this->add_uses($config["Model"]);

			$check=$this->{$config["Model"]}->find("first",array(
				"conditions"=>array(
					$config["Model"].".".$config["service_secret"]=>@$get_data["service_secret"],
					$config["Model"].".".$config["lisence_key"]=>@$get_data["lisence_key"],
				),
			));

			if(!@$check){
				$this->error=array(
					"message"=>"You can not authenticate a given request",
					"code"=>401,
				);
				return;
			}

			$token=$check[$config["Model"]][$config["access_token"]];
		}
		else if($config["type"]=="private"){

			if(@$option["service_secret"]){
				$config["service_secret"]=$option["service_secret"];
			}
			if(@$option["lisence_key"]){
				$config["lisence_key"]=$option["lisence_key"];
			}
			if(@$option["access_token"]){
				$config["access_token"]=$option["access_token"];
			}

			if(@$get_data["service_secret"]==@$config["service_secret"] && @$get_data["lisence_key"]==@$config["lisence_key"]){

				$token=@$config["access_token"];
			}
			else
			{
				$this->error=array(
					"message"=>"You can not authenticate a given request",
					"code"=>401,
				);
				return;
			}
		}

		$this->apikey=array(
			"service_secret"=>$get_data["service_secret"],
			"lisence_key"=>$get_data["lisence_key"],
			"access_token"=>$token,
		);

	}
	public function get_accessToken(){
		if($this->apikey){
			$output=array(
				"access_token"=>$this->apikey["access_token"],
			);
			return $output;
		}
	}
	public function check_accessToken($type="default",$option=array()){


		$config=$this->config[$type];

		if(@$option["method"]){
			if($option["method"]=="get"){
				$get_data=$this->request->get;
			}
			else if($option["method"]=="post"){
				$get_data=$_POST;
			}
		}
		else
		{
			if($config["method"]=="get"){
				$get_data=$this->request->get;
			}
			else if($config["method"]=="post"){
				$get_data=$_POST;
			}
		}

		if(!@$get_data["access_token"]){
			$this->error=array(
				"message"=>"request Failed(access_token)",
				"code"=>401,
			);
			return;
		}

		//check access_token....

		if($config["type"]=="public"){

			$this->add_uses($config["Model"]);

			foreach($config["Model"] as $tm_){
				$check=$this->{$tm_}->find("first",array(
					"conditions"=>array(
						$tm_.".".$config["access_token"]=>@$get_data["access_token"],
					),
				));
				if($check){
					break;
				}
			}
			if(!@$check){
				$this->error=array(
					"message"=>"You can not authenticate a given request(access_token)",
					"code"=>401,
				);
				return false;
			}
			
		}
		else if($config["type"]=="private"){
			if(@$option["access_token"]){
				$config["access_token"]=$option["access_token"];
			}
			if($get_data["access_token"]!=$config["access_token"]){
				$this->error=array(
					"message"=>"You can not authenticate a given request(access_token)",
					"code"=>401,
				);
				return;
			}
		}
		return true;
	}
}
?>