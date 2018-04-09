<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	AuthComponent
//	AuthComponent.php
//
//--------------------------------------------------

class AuthComponent extends Component{

	public $hash_number;
	public $config;
	public $uses=array(
	);

	public $components=array(
		"Session",
		"Cookie",
		"Encrypt",
	);
	public function __construct($data){
		parent::__construct($data);
		@include("../app/Backend/Config/config.php");

		$this->hash_number=@$hash_number;
		@include("../app/Backend/Config/auth.php");
		$this->config=@$auth["default"];
		$this->add_uses($this->config["Model"]);
	}
	//beforefilter
	public function beforeFilter(){
		parent::beforeFilter();

		if(@$this->config["enabled"]){

			if($this->params["action"]!="logout"){

				//2017/7/20 cookie auth..

				if(@$this->config["cookie"]){
					$getauth=$this->Cookie->read($this->config["cookie"]["token_name"]);
					$authlogin=$this->Encrypt->decode($getauth);

					if(@$authlogin){
						$authlogin=explode(":",@$authlogin);

						if(!@$this->config["username"]){
							$this->config["username"]="username";
						}
						if(!@$this->config["password"]){
							$this->config["password"]="password";
						}

						$postlogin=array(
							$this->config["Model"]=>array(
								$this->config["username"]=>$authlogin[0],
								$this->config["password"]=>$authlogin[1],
							),
						);

						$this->login($postlogin,false);

					}
					else
					{
						$allowed=false;
						foreach($this->allow as $ta_){
							if($ta_==$this->params["action"]){
								$allowed=true;
								break;
							}
						}
						if(!@$allowed){
							$this->logout(false);
						}
					}

				}


				$auth=$this->Session->read($this->config["Authcode"]);
				$this->data=$auth;
				if(@$auth){
					//if logined
					if($this->params["Controller"]==$this->config["loginurl"]["controller"] && $this->params["action"]==$this->config["loginurl"]["action"]){
						$this->redirect($this->config["loginedurl"]);
					}
				}
				else
				{
					//login page redirect
					if($this->params["Controller"]!=$this->config["loginurl"]["controller"] || $this->params["action"]!=$this->config["loginurl"]["action"]){
						$jugement=false;
						if(@$this->allow){
							foreach(@$this->allow as $alw_){
								if($this->params["action"]==$alw_){
									$jugement=true;
								}
							}
							if(!$jugement){
								$this->redirect(array("controller"=>$this->config["loginurl"]["controller"],"action"=>$this->config["loginurl"]["action"]));
							}
						}
						else
						{
							$this->redirect(array("controller"=>$this->config["loginurl"]["controller"],"action"=>$this->config["loginurl"]["action"]));
						}

					}
				}
			}

		}


	}
	//login
	public function login($data,$pwhash=true){

		if(@$this->config["enabled"]){

			if($data){

				if(!@$this->config["username"]){
					$this->config["username"]="username";
				}
				if(!@$this->config["password"]){
					$this->config["password"]="password";
				}

				if($pwhash){
					$passwd=$this->password($data[$this->config["Model"]][$this->config["password"]]);
				}
				else
				{
					$passwd=$data[$this->config["Model"]][$this->config["password"]];
				}

				$cond=array(
					$this->config["Model"].".".$this->config["username"]=>$data[$this->config["Model"]][$this->config["username"]],
					$this->config["Model"].".".$this->config["password"]=>$passwd,
				);
				if(@$this->config["option"]){
					foreach($this->config["option"] as $key=>$c_){
						$cond[$this->config["Model"].".".$key]=$c_;
					}
				}

				$result=$this->{$this->config["Model"]}->find("first",array(
					"conditions"=>@$cond,
				));

				if($result){
					$this->Session->write($this->config["Authcode"],$result);

					//2017/7/20 cookie auth
					if(@$this->config["cookie"]){
						$auth_token=$this->Encrypt->encode($result[$this->config["Model"]][$this->config["username"]].":".$result[$this->config["Model"]][$this->config["password"]]);
						$this->Cookie->write(
							$this->config["cookie"]["token_name"],
							$auth_token,
							time()+3600*24*365*7,
							"/",
							@$this->config["cookie"]["domain"]
						);
					}

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
		else
		{
			if(!@$this->config["username"]){
				$this->config["username"]="username";
			}
			if(!@$this->config["password"]){
				$this->config["password"]="password";
			}
			if($pwhash){
				$passwd=$this->password($data[$this->config["Model"]][$this->config["password"]]);
			}
			else
			{
				$passwd=$data[$this->config["Model"]][$this->config["password"]];
			}

			$result=$this->{$this->config["Model"]}->find("first",array(
				"conditions"=>array(
					$this->config["Model"].".".$this->config["username"]=>$data[$this->config["Model"]][$this->config["username"]],
					$this->config["Model"].".".$this->config["password"]=>$passwd,
				),
			));

			if($result){
				return $result;
			}
			else
			{
				return false;
			}
		}
	}
	//force login
	public function force_login($username){

		if(@$this->config["enabled"]){

			if($username){
				$result=$this->{$this->config["Model"]}->find("first",array(
					"conditions"=>array(
						$this->config["Model"].".".$this->config["username"]=>$username,
					),
				));

				if($result){
					$this->Session->write($this->config["Authcode"],$result);
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
	//login check
	public function check_login(){

		if(@$this->config["enabled"]){

			if($this->data){
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	//logout
	public function logout($redirect=true){

		if(@$this->config["enabled"]){
			$this->Session->delete($this->config["Authcode"]);
			if(@$this->config["cookie"]){
				$this->Cookie->delete($this->config["cookie"]["token_name"],"/",$this->config["cookie"]["domain"]);
			}
			if($redirect){
				$this->redirect(array("controller"=>$this->config["loginurl"]["controller"],"action"=>$this->config["loginurl"]["action"]));
			}
		}
	}
	//auth allow
	public function allow($action=null){

		if(@$this->config["enabled"]){

			if(@$action){
				if(is_array($action)){
					foreach($action as $a_){
						$this->allow[]=$a_;
					}
				}
				else
				{
					$this->allow[]=$action;
				}
			}
			else
			{
				
			}
		}
	}
	//password
	public function password($password){
		return hash("sha256",$password.$this->hash_number);
	}
	//refresh
	public function refresh($before_auth){
		
		$result=$this->{$this->config["Model"]}->find("first",array(
			"conditions"=>array(
				$this->config["Model"].".id"=>$before_auth[$this->config["Model"]]["id"],
			),
		));
		
		$this->Session->write($this->config["Authcode"],$result);

	}

}
?>