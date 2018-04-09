<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	CookieComponent
//	CookieComponent.php
//
//--------------------------------------------------

class CookieComponent extends Component{

	public $cookie_number="cakejp000c";
	public $time=0;
	public $rootdirectory="/";

	public $components=array(
		"Encrypt",
	);

	public function __construct($data){
		parent::__construct($data);

		include("../app/Backend/Config/config.php");
		$this->cookie_number=$cookie_number;
		$this->time=$cookie_limit;
		$this->rootdirectory=$cookie_defaultdir;
	}
	//read
	public function read($str=null){

		$strdata=@$_COOKIE[$this->cookie_number.$str];
		$strdata=@$this->Encrypt->decode($strdata);

		return $strdata;
	}
	//write
	public function write($str,$param,$time=null,$rootdirectory=null,$domain=""){
		if(@$time){
			$this->time=$time;
		}
		if(@$rootdirectory){
			$this->rootdirectory=$rootdirectory;
		}
		$cookie_str=$param;
		if(is_array($cookie_str)){
			$cookie_str=json_encode($cookie_str,JSON_UNESCAPED_UNICODE);

			//encrypt
			$cookie_str=$this->Encrypt->encode($cookie_str);
		}
		else
		{
			$cookie_str=$this->Encrypt->encode($cookie_str);
		}
		setcookie(
			$this->cookie_number.$str,
			$cookie_str,
			$this->time,
			$this->rootdirectory,
			@$domain
		);
	}
	//delete
	public function delete($str,$rootdirectory=null,$domain=""){
		if(@$rootdirectory){
			$this->rootdirectory=$rootdirectory;
		}
		setcookie($this->cookie_number.$str,"1",time()-300,$this->rootdirectory,@$domain);
	}
}