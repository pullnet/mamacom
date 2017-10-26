<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	EmailComponent
//	EmailComponent.php
//
//--------------------------------------------------

include("../lib/PHP-X/Plugin/PHPMailer/class.phpmailer.php");

class EmailComponent extends Component{

	public $host;
	public $host_default;

	public function __construct($data){

		parent::__construct($data);
		@include("../app/Backend/Config/email.php");

		$this->host=@$email["default"];
		$this->host_default=@$email["default"];

	}
	//change mail host
	public function change_host($hostname){

		$this->host=$email[$hostname];
		$this->host_default=$email[$hostname];

	}
	//sendmail...
	public function send($array){

		if(@$array["host"]){
			$this->host=$array["host"];
		}
		/* SMTP setting */
		$mail_host=$this->host["host"].":".$this->host["port"];
		$mail_username=$this->host["username"];
		$mail_pw=$this->host["password"];
		$mail_from=$this->host["mailaddress"];
		if(!@$this->host["encoding"]){
			$this->host["encoding"]=$this->host_default["encoding"];
		}
		$mail_charset="iso-2022-jp";
		$mail_encoding='7bit';
		if(!@$this->host["language"]){
			$this->host["language"]=$this->host_default["language"];
		}
		$mail_php_language=$this->host["language"];
		$mail_php_internal_encoding=$this->host["encoding"];
		$mail_from_name=$this->host["name"];
		
		mb_language($mail_php_language);
		mb_internal_encoding($mail_php_internal_encoding);
		$mail = new PHPMailer();
		
		$mail->CharSet = $mail_charset;
		$mail->Encoding = $mail_encoding;

		//SMTP access
		$mail->IsSMTP();
		$mail->SMTPAuth = TRUE;
		if(@$this->host["type"]=="gmail"){
			$mail->SMTPSecure = 'ssl';  // Gmailの場合はこれが必要！
		}
		$mail->Host = $mail_host;  //メールサーバー
		$mail->Username =$mail_username; //アカウント名
		$mail->Password = $mail_pw; //アカウントのパスワード
		$mail->From = $mail_from; //差出人(From)をセット
		$mail->FromName = mb_encode_mimeheader($mail_from_name); //差出人の名前
		$mail->ClearAddresses();  // 宛先アドレスを前に指定した場合はクリア

		if(is_array($array["from"])){
			foreach($array["from"] as $a_){
				$mail->AddAddress($a_); //宛先アドレス。
			}
		}
		else
		{
			$mail->AddAddress($array["from"]);
		}
 
		$mail->ClearCCs();	//CCアドレスを前に指定した場合はクリア
		if(@$array["cc"]){
			if(is_array($array["cc"])){
				foreach($array["cc"] as $ac_){
					$mail->AddCC($ac_);
				}
			}
		}
		$mail->ClearBCCs();	//BCCアドレスを前に指定した場合はクリア
		if(@$array["bcc"]){
			if(is_array($array["bcc"])){
				foreach($array["bcc"] as $ac_){
					$mail->AddBcc($ac_);
				}
			}
		}

		$mail->Subject = mb_encode_mimeheader($array["subject"]);
		$mail->Body  = mb_convert_encoding($array["message"], 'JIS', $mail_php_internal_encoding);
		//　送信
		$mails=$mail->Send();
		return $mails;
	}

	

}