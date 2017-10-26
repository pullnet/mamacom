<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	ConfigloadComponent
//	ConfigloadComponent.php
//
//--------------------------------------------------
class ConfigloadComponent extends Component{

	public $components=array(
		"Session",
	);

	//constructer
	public function __construct($data){

		parent::__construct($data);

		@include("../app/Backend/Config/configload.php");
		$this->config=@$configload["default"];
		$this->add_uses($this->config["model"]);
	}
	//set_model
	public function set_model($model_name){
		$this->config["model"]=$model_name;
		$this->add_uses($this->config["model"]);
	}
	//set_sessionname
	public function set_sessionname($session_name){
		$this->config["session_name"]=$session_name;
	}
	//load
	public function load($name=null,$permission=null){

		if(@$permission){
			if(@$this->config["permission"]){
				if(@$name){
					$load=$this->{$this->config["model"]}->find("list",array(
						"conditions"=>array(
							$this->config["model"].".name"=>$name,
							$this->config["model"].".".$this->config["permission"]=>$permission,
						),
						"fields"=>array("name","value"),
					));
					return @$load[$name];
				}
			}
		}
		else
		{

			if($this->Session->read($this->config["session_name"])){
				$load=$this->Session->read($this->config["session_name"]);
				if(phpx_strtotime(@$load["limit"])>phpx_strtotime()){
					if($name){
						if(is_array($name)){
							$output=array();
							foreach($name as $n_){
								$output[$n_]=@$load[$n_];
							}
							return @$output;
						}
						else
						{
							return @$load[$name];
						}
					}
					else
					{
						return @$load;
					}

				}
				else
				{
					if(@$this->config["permission"]){
						$cond_permission=array(
							$this->config["model"].".".$this->config["permission"]=>0,
						);
					}
					$load=$this->{$this->config["model"]}->find("list",array(
						"conditions"=>@$cond_permission,
						"fields"=>array("name","value"),
					));
					$load["limit"]=phpx_date("Y-m-d H:i:s",null,$this->config["limit"]);
					$this->Session->write($this->config["session_name"],$load);
					if($name){
						return @$load[$name];
					}
					else
					{
						return @$load;
					}

				}
			}
			else
			{
				if(@$this->config["permission"]){
					$cond_permission=array(
						$this->config["model"].".".$this->config["permission"]=>0,
					);
				}
				$load=$this->{$this->config["model"]}->find("list",array(
					"conditions"=>@$cond_permission,
					"fields"=>array("name","value"),
				));
				$load["limit"]=phpx_date("Y-m-d H:i:s",null,$this->config["limit"]);
				$this->Session->write($this->config["session_name"],$load);
				if($name){
					return @$load[$name];
				}
				else
				{
					return @$load;
				}

			}
		}
	}
	//refresh
	public function refresh(){
		$this->Session->delete($this->config["session_name"]);
	}
	//write
	public function write($array,$permission=array()){
		try{

			$this->transam("begin",array(
				$this->config["model"],
			));
			foreach($array as $key=>$p_){

				$check=$this->{$this->config["model"]}->find("first",array(
					"conditions"=>array(
						$this->config["model"].".name"=>$key,
					),
				));

				$savedata=array(
					$this->config["model"]=>array(
						"id"=>@$check[$this->config["model"]]["id"],
						"name"=>$key,
						"value"=>$p_,
					),
				);


				if(@$this->config["permission"]){
					if(@$permission[$key]){
						$savedata[$this->config["model"]][$this->config["permission"]]=$permission[$key];
					}
				}
				$res=$this->{$this->config["model"]}->save($savedata);

				if(!$res){
					$this->transam("rollback");
				}

			}
			$this->transam("commit");

		}
		catch(Exception $e_){
			$this->transam("rollback");
		}
		$this->refresh();
	}
	//delete
	public function delete($colum){

		$check=$this->{$this->config["model"]}->find("first",array(
			"conditions"=>array(
				$this->config["model"].".name"=>$colum,
			),
		));

		if($check){
			$this->{$this->config["model"]}->delete($check[$this->config["model"]]["id"]);
		}

		$this->refresh();
	}

}

?>