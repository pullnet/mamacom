<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/11
//
//	AccesstalkenComponent
//	AccesstalkenComponent.php
//
//--------------------------------------------------
class AccesstalkenComponent extends Component{

	public $config;

	public $uses=array();

	//constructer
	public function __construct($data){
		include("../app/Backend/Config/Accesstalken.php");
		$this->config=$accesstalken["default"];
		if(!@$this->config["appkey"]){
			$this->config["appkey"]="appkey";
		}
		if(!@$this->config["access_talken"]){
			$this->config["access_talken"]="access_talken";
		}
		if(!@$this->config["access_talken_limit"]){
			$this->config["access_talken_limit"]="access_talken_limit";
		}

		$this->uses=array($this->config["table"]);

		parent::__construct($data);
	}
	public function set_talken($name){
		$this->config=$accesstalken[$name];
	}
	public function manual_setting($array){
		if(!@$array["appkey"]){
			$array["appkey"]="appkey";
		}
		if(!@$array["access_talken"]){
			$array["access_talken"]="access_talken";
		}
		if(!@$array["access_talken_limit"]){
			$array["access_talken_limit"]="access_talken_limit";
		}
		$this->config=$array;
	}
	public function get_talken($id){
		
		$udata=$this->{$this->config["table"]}->find("first",array(
			"condigions"=>array(
				$this->config["table"].".id"=>$id,
			),
			"fields"=>array(
				"id",
				$this->config["appkey"],
				$this->config["access_talken"],
				$this->config["access_talken_limit"],
			),
		));
		if(@$udata[$this->config["table"]][$this->config["appkey"]]){
			$set_appkey=@$udata[$this->config["table"]][$this->config["appkey"]];
		}
		else
		{
			$set_appkey=$this->_make_appkey($id);
		}
	
		if(!@$udata[$this->config["table"]][$this->config["access_talken"]] && !@$udata[$this->config["table"]][$this->config["access_talken_limit"]]){
			//make talken
			$set_talken=$this->_make_talken($id,$udata[$this->config["table"]][$this->config["appkey"]]);

			return $set_talken;
		}
		else
		{
			$now=strtotime(phpx_date("Y-m-d H:i:s"));
			$limit=strtotime(@$udata[$this->config["table"]][$this->config["access_talken_limit"]]);

			if(@$this->config["limit"]){
				if($now<$limit){
					return @$udata[$this->config["table"]][$this->config["access_talken"]];
				}
				else
				{
					$set_talken=$this->_make_talken($id,$udata[$this->config["table"]][$this->config["appkey"]]);
					return $set_talken;
				}
			}
			else
			{
				return @$udata[$this->config["table"]][$this->config["access_talken"]];
			}

		}
	}
	public function refresh_talken($id){

		$udata=$this->{$this->config["table"]}->find("first",array(
			"conditions"=>array(
				$this->config["table"].".id"=>$id,
			),
			"fields"=>array(
				"id",
				$this->config["appkey"],
				$this->config["access_talken"],
				$this->config["access_talken_limit"],
			),
		));
		$set_appkey=$this->_make_talken($id,$udata[$this->config["table"]][$this->config["appkey"]]);
		return $set_appkey;

	}
	private function _make_talken($id,$appkey){

		$set_talken=hash("sha256",phpx_date("YmdHis").$appkey);
		if(@$this->config["limit"]){
			$set_talken_limit=phpx_date("Y-m-d H:i:s",strtotime($this->config["limit"],time()));
		}
		else
		{
			$set_talken_limit=phpx_date("Y-m-d H:i:s");
		}
		$savedata=array(
			$this->config["table"]=>array(
				"id"=>$id,
				$this->config["access_talken"]=>$set_talken,
				$this->config["access_talken_limit"]=>$set_talken_limit,
			),
		);
		$this->{$this->config["table"]}->save($savedata);

		return $set_talken;
	}
	private function _make_appkey($id){

		$set_appkey=hash("sha256",phpx_date("YmdHis").$this->config["table"]);

		$savedata=array(
			$this->config["table"]=>array(
				"id"=>$id,
				$this->config["appkey"]=>$set_appkey,
			),
		);
		$this->{$this->config["table"]}->save($savedata);

		return $set_appkey;
	}
}
?>