<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	EncryptController
//	EncryptController.php
//
//--------------------------------------------------

class EncryptComponent extends Component{

	public $hash_number="1254d89er8g6d9re8g6d9waad59er8zd9er8g";
	public $hash_password="292d56e8rg6f8er9f8gddd8a6a65d8er1dd3a5ed58er8vg";
	public $enc_method='aes-128-cbc';

	public function __construct($data){
		parent::__construct($data);

		@include("../app/Backend/Config/config.php");
		if(@$hash_number){
			$this->hash_number=$hash_number;
		}
		if(@$hash_password){
			$this->hash_password=$hash_password;
		}
		if(@$enc_method){
			$this->enc_method=$enc_method;
		}
	}
	//get cipher method list
	public function get_cipherlist(){

		$method_list = openssl_get_cipher_methods();
		return $method_list;
	}
	//encode
	public function encode($str,$password=null){
		if(is_array($str)){
			$str=json_encode($str,JSON_UNESCAPED_UNICODE);
		}

		if(@$password){
			$this->hash_password=$password;
		}
		 
		$ivLength = openssl_cipher_iv_length($this->enc_method);
		$iv = substr($this->hash_number,1,$ivLength);
		$options = 0;

		//encodeing...
		$encrypted=openssl_encrypt($str, $this->enc_method, $this->hash_password, $options, $iv);

		return $encrypted;

	}
	//decode
	public function decode($str,$password=null){
		if(@$password){
			$this->hash_password=$password;
		}

		$ivLength = openssl_cipher_iv_length($this->enc_method);
		$iv = substr($this->hash_number,1,$ivLength);
		$options=0;

		//decode
		$decrypted=openssl_decrypt($str, $this->enc_method, $this->hash_password, $options, $iv);

		if(is_array(json_decode($decrypted,true))){
			$output=json_decode($decrypted,true);
		}
		else
		{
			$output=$decrypted;
		}
		return $output;

	}
}