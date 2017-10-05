<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/09							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://www.collabos.jp						*/
/*									*/
/*	自動送信メール用コンポーネント					*/
/*	SendmailComponent.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('CakeEmail', 'Network/Email');//cakeEmailの読み込み

class SendmailComponent extends Component{
	public $components=array(
		"Loadbasic",
	);
	//★メール送信
	public function send($array){


		//arrayに必要なパラメタ
		// cord:フォーマットコード(フォーマットIDのどちらかが必要)
		// formatnumber:フォーマットID(フォーマットコードのどちらかが必要)
		// from:送信先メールアドレス
		// from_cc:送信先メールアドレス(複数ある場合はここに、配列で)
		// vars:置換内容(array)

		// template.subject = メール件名(※フォーマットを指定しない場合は必要)
		// template.message = メール本文(※フォーマットを指定しない場合は必要)

		// user_id:ユーザーID(ログには残る、任意)
		// order_id:注文情報ID(ログには残る、任意)
		// collaboparty_id:コラボ参加表明情報ID(ログには残る、任意)
		// message_id:メッセージ情報ID(ログには残る、任意)

		//まずDefaultテーブルから設定情報をロード
		$bdata=$this->Loadbasic->load();	
		$emailsetting=array(
			"from"=>array($bdata["mail_address"]=>$bdata["mail_sendname"]),
			"host"=>$bdata["mail_host"],
			"port"=>$bdata["mail_port"],
			"username"=>$bdata["mail_username"],
			"password"=>$bdata["mail_password"],
			"transport"=>"Smtp",
		);

		//複数メールアドレスがある場合は、追加
		$mailfrom=array($array["from"]);
		if(@$array["from_cc"]){
			$mailfrom=array_merge($mailfrom,$array["from_cc"]);
		}

		//テンプレート読み込み
		//番号がある場合はDBよりロード、ない場合は手動
		if(!@$array["no_format"]){
			if(isset($array["formatnumber"]) || isset($array["code"]))
			{
				if(@$array["formatnumber"]){
					$conditions=array(
						"Mailformat.id"=>$array["formatnumber"],
					);
				}
				else if(@$array["code"]){
					$conditions=array(
						"Mailformat.code"=>$array["code"],
					);
				}

				//Mailformatよりロード(mailtemplateをbelongsTo)
				$loadModel = ClassRegistry::init('Mailformat');
				$loadModel->bindModel(array(
					"belongsTo"=>array(
						"Mailtemplate",
					),
				));
				$gettemplate=$loadModel->find("first",array(
					"conditions"=>array(
						@$conditions,
					),
					"recursive"=>2,
				));

				//メール本文を合成(ヘッダー＋本文＋フッター)
				$mailbody=$gettemplate["Mailtemplate"]["header"]."\n\n".$gettemplate["Mailformat"]["message"]."\n\n".$gettemplate["Mailtemplate"]["footer"];

				$array["template"]["subject"]=$gettemplate["Mailformat"]["subject"];
				$array["template"]["message"]=$mailbody;
				
			}

			if(@$array["vars"]){
				$subject=$this->replacement($array["template"]["subject"],$array["vars"]);
				$message=$this->replacement($array["template"]["message"],$array["vars"]);
			}
		}
		else
		{
			$subject=$array["template"]["subject"];
			$message=$array["template"]["message"];
			@$gettemplate["Mailformat"]["code"]=@$array["code"];
		}


		//読み込む設定ファイルの変数名を指定
		$email = new CakeEmail($emailsetting);
		$email->to($mailfrom);
		$email->bcc($bdata["mail_address"]);
		$email->subject($subject);
		$email->send($message);

		//ログを記録
		$sma_list="";
		foreach($mailfrom as $m_){
			$sma_list.=$m_."|";
		}

		$logdata=array(
			"Maillog"=>array(
				"id"=>"",
				"send_date"=>date("Y-m-d H:i:s"),
				"mailaddress"=>@$sma_list,
				"subject"=>@$subject,
				"message"=>@$message,
				"user_id"=>@$array["user_id"],
				"order_id"=>@$array["order_id"],
				"collaboparty_id"=>@$array["collaboparty_id"],
				"mailformatcode"=>@$gettemplate["Mailformat"]["code"],
			),
		);
		$loadModel = ClassRegistry::init('Maillog');
		$loadModel->save($logdata,false);

	}
	//ショートコード部分の置換処理用
	private function replacement($source,$vars)
	{
		$output=$source;
		$dindex=array_keys($vars);

		//設定されたコード分だけ置換処理
		$count=0;
		foreach($vars as $v_)
		{
			$output=str_replace("[[".$dindex[$count]."]]",$v_,$output);
			$count++;
		}
		return $output;
	}
	//メール送信テスト用
	public function sendmailtest($tomail){

		//まずDefaultテーブルから設定情報をロード
		$bdata=$this->Loadbasic->load();	
		$emailsetting=array(
			"from"=>array($bdata["mail_address"]=>$bdata["mail_sendname"]),
			"host"=>$bdata["mail_host"],
			"port"=>$bdata["mail_port"],
			"username"=>$bdata["mail_username"],
			"password"=>$bdata["mail_password"],
			"transport"=>"Smtp",
		);

		$Email = new CakeEmail($emailsetting);
		$Email->to($tomail);
		$Email->subject("Collabos送信テスト");
		return $Email->send('テスト送信用のメールです。※返信はしないでください！');
	}
	public function test(){
		return "OKO";
	}
	//送信メール文章の作成
	public function mailset($array){

		//テンプレート読み込み
		//番号がある場合はDBよりロード、ない場合は手動
		if(isset($array["formatnumber"]) || isset($array["code"]))
		{
			if(@$array["formatnumber"]){
				$conditions=array(
					"Mailformat.id"=>$array["formatnumber"],
				);
			}
			else if(@$array["code"]){
				$conditions=array(
					"Mailformat.code"=>$array["code"],
				);
			}

			//Mailformatよりロード(mailtemplateをbelongsTo)
			$loadModel = ClassRegistry::init('Mailformat');
			$loadModel->bindModel(array(
				"belongsTo"=>array(
					"Mailtemplate",
				),
			));
			$gettemplate=$loadModel->find("first",array(
				"conditions"=>array(
					@$conditions,
				),
				"recursive"=>2,
			));

			//メール本文を合成(ヘッダー＋本文＋フッター)
			$mailbody=$gettemplate["Mailtemplate"]["header"]."\n\n".$gettemplate["Mailformat"]["message"]."\n\n".$gettemplate["Mailtemplate"]["footer"];

			$array["template"]["subject"]=$gettemplate["Mailformat"]["subject"];
			$array["template"]["message"]=$mailbody;
			
		}

		if(@$array["vars"]){
			$subject=$this->replacement($array["template"]["subject"],$array["vars"]);
			$message=$this->replacement($array["template"]["message"],$array["vars"]);
		}

		$output=array(
			"code"=>$array["code"],
			"name"=>$gettemplate["Mailformat"]["name"],
			"subject"=>$subject,
			"message"=>$message,
		);
		return $output;
	}
}
