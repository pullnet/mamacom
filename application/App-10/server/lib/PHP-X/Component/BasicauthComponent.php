<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	BasicauthComponent
//	BasicauthComponent.php
//
//--------------------------------------------------
class BasicauthComponent extends Component{

	public function auth($account,$option=array()){

		if(@$_SERVER['PHP_AUTH_USER'] and @$account[$_SERVER['PHP_AUTH_USER']]){

			$password_hash_server=hash("sha256","PHPX_".$_SERVER['PHP_AUTH_PW']);
			$password_hash_client=hash("sha256","PHPX_".$account[$_SERVER['PHP_AUTH_USER']]);

			if($password_hash_server==$password_hash_client){
				return $_SERVER['PHP_AUTH_USER'];
			}
		}
		if(!@$option["realm"]){
			$option["realm"]="Restricted Area";
		}
		if(!@$option["failed_text"]){
			$option["failed_text"]="Error:certification failed.";
		}

		header('WWW-Authenticate: Basic realm="'.$option["realm"].'"');
		header('HTTP/1.0 401 Unauthorized');
		header('Content-type: text/html; charset='.mb_internal_encoding());

		die($option["failed_text"]);
	}
	public function clear(){
		
	}
}
?>