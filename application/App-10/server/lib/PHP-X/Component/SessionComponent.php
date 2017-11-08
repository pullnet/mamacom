<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	SessionComponent
//	SessionComponent.php
//
//--------------------------------------------------

class SessionComponent extends Component{

	public $session_number="phpx-00000";

	public function __construct($data){

		parent::__construct($data);
		include("../app/Backend/Config/config.php");
		if(@$session_number){
			$this->session_number=$session_number;
		}


	}
	//read
	public function read($str=null){

		if($str){
			$getsession=@$_SESSION[$this->session_number][$str];
			if($getsession){
				$str_json=json_decode($getsession,true);
				return @$str_json;
			}
			else
			{
				return null;
			}
		}
		else
		{
			$getsession=@$_SESSION[$this->session_number];

			if($getsession){
				$output=array();

				$gs_key=array_keys($getsession);
				$ind=0;
				foreach($getsession as $gs_){
					$output[$gs_key[$ind]]=json_decode($gs_,true);
					$ind++;
				}
				return @$output;
			}
			else
			{
				return null;
			}
		}
	}
	//write
	public function write($str,$param){
		$str_json=json_encode($param,JSON_UNESCAPED_UNICODE);
		$_SESSION[$this->session_number][$str]=$str_json;
	}
	//delete
	public function delete($str){
		unset($_SESSION[$this->session_number][$str]);
	}
}