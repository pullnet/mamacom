<?php


App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');


class ContactController extends AppController{
	
	public $name ='SendMail';
	
	public $uses=array(
		"Contact",
	);
	
	public $components=array(
		"Db",
		"Loadbasic",
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function contact_step1(){
		
		if($this->request->data){

			$post=$this->request->data;	
			//debug($post);
			
			$post2=array(
				"Contact"=>$post,
			);
			
			$this->Contact->set($post2);

			if($this->Contact->validates()){
				$result=array(
					"enable"=>true,
					"errors"=>"",
				);
			}
			else{
				$errors = $this->Contact->validationErrors;			
				$result=array(
					"enable"=>false,
					"errors"=>$errors,
				);
			}
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}
	
	
	public function contact_step2(){
		
		if($this->request->data){

			$post=$this->request->data;	
			//debug($post);
			
			$post3=array(
				"Contact"=>$post,
			);
			
			$this->Contact->set($post3);

			if($this->Contact->validates()){
				$result=array(
					"enable"=>true,
					"errors"=>"",
				);
				
				$s_mail = $post["post_mail"];
				$s_name = $post["post_name1"].' '.$post["post_name2"].'様';
				$f_name = $post["post_name3"].' '.$post["post_name4"].'様';
	
				//メールの送信処理
				$bdata=$this->Loadbasic->load();
				
				$emailsetting=array(
					"from"=>array($bdata["mail_address"]=>$bdata["mail_sendname"]),
					"host"=>$bdata["mail_host"],
					"port"=>$bdata["mail_port"],
					"username"=>$bdata["mail_username"],
					"password"=>$bdata["mail_password"],
					"transport"=>"Smtp",
				);
		
//自動返信		
$mail_ttl='【MAMACOM】お問い合わせありがとうございます。';
$mail_text=
'				
--------------------------------------------------------------------------

　※このメールは自動返信メールです

--------------------------------------------------------------------------	

'.$s_name.'

この度はmamacomをご利用いただき誠にありがとうございます。
送信いただいたお問い合わせ内容については後程担当の者より返答させて抱きますので、
それまでしばらくお待ちください。


お名前:【 '.$s_name.' 】

お名前(フリガナ):【 '.$f_name.' 】

連絡先メールアドレス:【 '.$post["post_mail"].' 】


お問い合わせ件名:
【 '.$post["post_subject"].' 】

お問い合わせ内容:
【 '.$post["post_text"].' 】


--------------------------------------------------------------------------

　地域の子育て情報サイト MAMACOM.

　http://mamacom.net/

　運営会社:NPO法人mamaコム

--------------------------------------------------------------------------
	
';

				$email = new CakeEmail($emailsetting);
				$email->to($post["post_mail"]);
				$email->subject($mail_ttl);
				$email->send($mail_text);

				
//運営への通知メール		
$mail_ttl='【MAMACOM】アプリからのお問い合わせがあります。';
$mail_text=
'				
--------------------------------------------------------------------------

　※このメールは自動送信メールです

--------------------------------------------------------------------------	

ご利用のユーザー様より以下のお問い合わせがありました。
ご対応よろしくお願い申し上げます。


お名前:【 '.$s_name.' 】

お名前(フリガナ):【 '.$f_name.' 】

連絡先メールアドレス:【 '.$post["post_mail"].' 】


お問い合わせ件名:
【 '.$post["post_subject"].' 】

お問い合わせ内容:
【 '.$post["post_text"].' 】


--------------------------------------------------------------------------

　地域の子育て情報サイト MAMACOM.

　http://mamacom.net/

　運営会社:NPO法人mamaコム

--------------------------------------------------------------------------
	
';

				$email = new CakeEmail($emailsetting);
				$email->to($bdata["mail_address"]);
				$email->subject($mail_ttl);
				$email->send($mail_text);	
			
			}
			else{
				$errors = $this->Contact->validationErrors;			
				$result=array(
					"enable"=>false,
					"errors"=>$errors,
				);
			}

			return json_encode($result,JSON_UNESCAPED_UNICODE);
			
		}
	}	

}