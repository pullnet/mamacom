<?php
//-----------------------------------------------------------------------------
//
//	2017.09.01
//	Masato Nakatsuji
//
//	V1Controller
//
//-----------------------------------------------------------------------------

class TokenController extends Controller{

	public $layout=false;
	public $autoRender=false;

	public $uses=array(
		"User",
	);

	public $components=array(
		"RestAPI",
	);

	public function get_token(){
		header("Access-Control-Allow-Origin:*");

		$this->RestAPI->auth("private");
		if(@$this->RestAPI->error){
			echo JSON_ENC($this->RestAPI->error);
			exit;
		}

		$token=$this->RestAPI->get_accessToken();
		echo JSON_ENC($token);
	}
}
?>
