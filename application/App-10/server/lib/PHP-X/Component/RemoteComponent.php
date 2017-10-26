<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/09/29
//
//	RemoteComponent
//	RemoteComponent.php
//
//--------------------------------------------------
class RemoteComponent extends Component{

	public $config;

	public $components=array(
		"Curl",
	);

	public function __construct($data){
		parent::__construct($data);

	}
	public function setting($params){
		$this->config=$params;
	}
	public function listen(){

		$params=array(
			"method"=>"post",
			"POST"=>$this->request->post,
			"GET"=>$this->request->get,
			"access_token"=>$this->config["access_token"],
			"option"=>$this->config["option"],
			"root"=>$this->params["root"],
		);
		$url=$this->config["url"].$this->params["request_url"];
		$url=str_replace("//","/",$url);
		$result=$this->Curl->access($url,$params);
		return $result;
	}
	public function auth(){

		if($this->request->post){
			$post=$this->request->post;
			if($post["access_token"]==$this->config["access_token"]){
				$this->root=$post["root"];
				$this->option=$post["option"];
				$this->request->post=@$post["POST"];
				$this->request->get=@$post["GET"];
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	public function redirect($url){
		$output=array(
			"redirect_url"=>$url,
		);
		if(@$this->send_data){
			$output["send"]=$this->send_data;
		}
		echo JSON_ENC($output);
	}
	public function sendSession($name,$value){
		$this->send_data[$name]=$value;
	}
}
?>