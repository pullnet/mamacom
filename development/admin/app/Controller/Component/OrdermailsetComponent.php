<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/03/24							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	受注用メール文面設定コンポーネント				*/
/*	OrdermailsetComponent.php					*/
/* ------------------------------------------------------------------- 	*/

class OrdermailsetComponent extends Component{

	public $wwwurl="";

	public $components=array(
		"Db",
		"Loadbasic",
		"Sendmail",
	);
	//ここが窓口
	public function mailset($order_data,$mailcode){
		//$order_data
		//※必ず下記を内包していること
		//Order(受注情報)
		//Orderlog(受注ログ)
		//Inuser(受注ユーザー情報)
		//Outuser(発注ユーザー情報)
		//Contentbuffer(コンテンツバッファ情報)

		//$mailcode:メールフォーマットコード

		return $this->_mailset($order_data,$mailcode);
	}
	private function _mailset($order_data,$mailcode){

		if(@$order_data["Order"]["libraryorderset_id"]){
			$order_type="ライブラリ発注";
			$sub_content_title=h($order_data["Contentbuffer"]["Libraryorderset"]["title"]);
		}
		else if(@$order_data["Order"]["collaboparty_id"]){
			$order_type="コラボ参加";
			$sub_content_title=h($order_data["Contentbuffer"]["Collabopartyset"]["title"]);
		}

		//支払方法
		$payment=$this->Db->payment();
		$payment_str=$payment[$order_data["Order"]["payment"]]."\n";
		if($order_data["Order"]["payment"]==1){
			//クレジット決済の場合
			$credit_json=json_decode($order_data["Order"]["credit_json"],true);
			$payment_str.="カード会社名 : ".@$credit_company[@$credit_json["corporate"]]."\n";
			$payment_str.="カード番号 : ".substr(@$credit_json["number"],1,3)."**************\n";
			$payment_str.="カード名義人 : ".@$credit_json["owner"]."\n";
			$payment_str.="有効期限 : ".date("m月Y年",strtotime(@$credit_json["limit_y"]."-".@$credit_json["limit_m"]."-01 00:00:00"));
		}
		else if($order_data["Order"]["payment"]==2)
		{
			$payment_str.="\n振込先情報については後程お知らせいたしますのでしばらくお待ちください";
		}

		$wwwurl=$this->Loadbasic->load("wwwurl");
		$adminurl=$this->Loadbasic->load("adminurl");

//		debug($order_data);
		if($mailcode=="order_new_receive"){
			//新規受注通知(受注者側)

			$mail_params=array(
				"code"=>"order_new_receive",
				"order_id"=>$order_data["Order"]["id"],
				"user_id"=>$order_data["Inuser"]["id"],
				"from"=>$order_data["Inuser"]["mailaddress"],
				"fromuser"=>h($order_data["Inuser"]["nickname"]),
				"format_name"=>"新規受注通知(受注者側)",
				"vars"=>array(
					"username_ordering"=>h($order_data["Outuser"]["nickname"]),
					"username_receive"=>h($order_data["Inuser"]["nickname"]),
					"order_number"=>$order_data["Order"]["number"],
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>h($sub_content_title),
					"order_hopedelivary"=>date("Y年m月d日",strtotime($order_data["Order"]["hope_delivary"]))."を予定",
					"order_count"=>$order_data["Order"]["order_count"],
					"order_hopeprice"=>"￥".number_format($order_data["Order"]["hope_price"]),
					"order_hopeprice_total"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]),
					"payment"=>@$payment_str,
					"order_caption"=>h($order_data["Order"]["caption"]),
					"order_url"=>$wwwurl.$order_data["Inuser"]["username"]."order/receive_detail/".$order_data["Order"]["number"],
				),
			);
		}
		else if($mailcode=="order_new_ordering"){
			//新規発注通知(発注者側)

			$mail_params=array(
				"code"=>"order_new_ordering",
				"order_id"=>$order_data["Order"]["id"],
				"user_id"=>$order_data["Outuser"]["id"],
				"from"=>$order_data["Outuser"]["mailaddress"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"新規受注通知(発注者側)",
				"vars"=>array(
					"username_ordering"=>h($order_data["Outuser"]["nickname"]),
					"username_receive"=>h($order_data["Inuser"]["nickname"]),
					"order_number"=>$order_data["Order"]["number"],
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>h($sub_content_title),
					"order_hopedelivary"=>date("Y年m月d日",strtotime($order_data["Order"]["hope_delivary"]))."を予定",
					"order_count"=>$order_data["Order"]["order_count"],
					"order_hopeprice"=>"￥".number_format($order_data["Order"]["hope_price"]),
					"order_hopeprice_total"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]),
					"payment"=>@$payment_str,
					"order_caption"=>h($order_data["Order"]["caption"]),
					"order_url"=>$wwwurl.$order_data["Outuser"]["username"]."order/ordering_detail/".$order_data["Order"]["number"],
				),
			);

		}
		else if($mailcode=="order_new_admin"){
			//新規受注通知用(管理通知用)

			$mail_params=array(
				"code"=>"order_new_admin",
				"order_id"=>$order_data["Order"]["id"],
				"from"=>$this->Loadbasic->load("mail_address"),
				"fromuser"=>"コラボス運営",
				"format_name"=>"新規受注通知用(管理通知用)",
				"vars"=>array(
					"order_number"=>$order_data["Order"]["number"],
					"order_type"=>$order_type,
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"order_username"=>h($order_data["Inuser"]["nickname"]),
					"order_hopedelivary"=>date("Y年m月d日",strtotime($order_data["Order"]["hope_delivary"]))."を予定",
					"order_count"=>$order_data["Order"]["order_count"]."件",
					"order_hopeprice"=>number_format($order_data["Order"]["hope_price"])."円",
					"order_hopeprice_total"=>number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"])."円",
					"order_payment"=>@$payment_str,
					"order_caption"=>$order_data["Order"]["caption"],
					"order_url"=>$adminurl."order/detail/".$order_data["Order"]["id"],
				),
			);

		}
		else if($mailcode=="order_transfer_request_complete"){
			//振込完了通知

			$mail_params=array(
				"code"=>"order_transfer_request_complete",
				"from"=>$order_data["Inuser"]["mailaddress"],
				"user_id"=>$order_data["Inuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Inuser"]["nickname"]),
				"format_name"=>"振込完了通知",
				"vars"=>array(
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"user_name"=>h($order_data["Inuser"]["nickname"]),
					"order_number"=>$order_data["Order"]["number"],
					"pricetotal"=>"￥".number_format(($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"])*(1-$order_data["Order"]["commission"]*0.01)),
					"transfer_date"=>date("Y年m月d日 H時i分"),
					"order_url"=>$wwwurl.$order_data["Inuser"]["username"]."/order/receive_detail/".$order_data["Order"]["number"],
				),
			);

		}
		else if($mailcode=="order_transfer_request_admin"){
			//振込依頼確認通知(管理通知用)

			$mail_params=array(
				"code"=>"order_transfer_request_admin",
				"from"=>$this->Loadbasic->load("mail_address"),
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>"コラボス運営",
				"format_name"=>"振込依頼確認通知(管理通知用)",
				"vars"=>array(
					"order_number"=>$order_data["Order"]["number"],
					"date_time"=>date("Y年m月d日 H時i分"),
					"user_name"=>h($order_data["Inuser"]["nickname"]),
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"price"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]*(1-0.01*$order_data["Order"]["commission"])),
				),
			);

		}
		else if($mailcode=="order_transfer_request"){
			//振込依頼確認通知(受注ユーザー用)

			$mail_params=array(
				"code"=>"order_transfer_request",
				"from"=>$order_data["Inuser"]["mailaddress"],
				"user_id"=>$order_data["Inuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Inuser"]["nickname"]),
				"format_name"=>"振込依頼確認通知(受注ユーザー用)",
				"vars"=>array(
					"order_number"=>$order_data["Order"]["number"],
					"user_name"=>h($order_data["Inuser"]["nickname"]),
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"price"=>"￥".number_format($order_data["Order"]["hope_price"]),
					"count"=>$order_data["Order"]["order_count"]."件",
					"pricetotal"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]*(1-0.01*$order_data["Order"]["commission"])),
					"order_url"=>$wwwurl.$order_data["Inuser"]["username"]."/order/receive_detail/".$order_data["Order"]["number"],
				),
			);

		}
		else if($mailcode=="order_complete_ordering"){
			//検品済通知(発注用)

			$mail_params=array(
				"code"=>"order_complete_ordering",
				"from"=>$order_data["Outuser"]["mailaddress"],
				"user_id"=>$order_data["Outuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"検品済通知(発注用)",
				"vars"=>array(
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"user_name"=>h($order_data["Outuser"]["nickname"]),
					"order_number"=>$order_data["Order"]["number"],
					"datetime"=>date("Y年m月d日 H時i分"),
					"pricetotal"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]),
					"order_url"=>$wwwurl.$order_data["Outuser"]["username"]."/order/ordering_detail/".$order_data["Order"]["number"],
				),
			);

		}
		else if($mailcode=="order_complete_receive"){
			//検品済通知(受注用)

			$mail_params=array(
				"code"=>"order_complete_receive",
				"from"=>$order_data["Inuser"]["mailaddress"],
				"user_id"=>$order_data["Inuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Inuser"]["nickname"]),
				"format_name"=>"検品済通知(受注用)",
				"vars"=>array(
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"user_name"=>h($order_data["Inuser"]["nickname"]),
					"order_number"=>$order_data["Order"]["number"],
					"datetime"=>date("Y年m月d日 H時i分"),
					"pricetotal"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]*(1-0.01*$order_data["Order"]["commission"])),
					"order_url"=>$wwwurl.$order_data["Inuser"]["username"]."/order/receive_detail/".$order_data["Order"]["number"],
				),
			);
		}
		else if($mailcode=="order_pre_complete"){
			//納品完了・検品通知

			$mail_params=array(
				"code"=>"order_pre_complete",
				"from"=>$order_data["Outuser"]["mailaddress"],
				"user_id"=>$order_data["Outuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"納品完了・検品通知",
				"vars"=>array(
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"datetime"=>date("Y年m月d日 H時i分"),
					"username"=>$order_data["Outuser"]["nickname"],
					"order_number"=>$order_data["Order"]["number"],
					"order_url"=>$wwwurl.$order_data["Outuser"]["username"]."/order/ordering_detail/".$order_data["Order"]["number"],
				),
			);


		}
		else if($mailcode=="order_onhold_omit"){
			//注文保留解除通知

			$mail_params=array(
				"code"=>"order_onhold_omit",
				"from"=>$order_data["Outuser"]["mailaddress"],
				"user_id"=>$order_data["Outuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"注文保留解除通知",
				"vars"=>array(
					"content_title"=>$order_data["Contentbuffer"]["Content"]["title"],
					"sub_content_title"=>$sub_content_title,
					"username"=>$order_data["Outuser"]["nickname"],
					"datetime"=>date("Y年m月d日 H時i分"),
					"order_number"=>$order_data["Order"]["number"],
					"order_url"=>$wwwurl.$order_data["Outuser"]["username"]."/order/ordering_detail/".$order_data["Order"]["number"],
				),
			);

		}
		else if($mailcode=="order_onhold"){
			//注文保留通知

			$mail_params=array(
				"code"=>"order_onhold",
				"from"=>$order_data["Outuser"]["mailaddress"],
				"user_id"=>$order_data["Outuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"注文保留通知",
				"vars"=>array(
					"content_title"=>$order_data["Contentbuffer"]["Content"]["title"],
					"sub_content_title"=>$sub_content_title,
					"username"=>$order_data["Outuser"]["nickname"],
					"datetime"=>date("Y年m月d日 H時i分"),
					"order_number"=>$order_data["Order"]["number"],
					"order_url"=>$wwwurl.$order_data["Outuser"]["username"]."/order/ordering_detail/".$order_data["Order"]["number"],
				),
			);
		}
		else if($mailcode=="order_payment_claim_complete"){
			//注文キャンセル通知
			$mail_params=array(
				"code"=>"order_payment_claim_complete",
				"from"=>$order_data["Outuser"]["mailaddress"],
				"user_id"=>$order_data["Outuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"注文キャンセル通知",
				"vars"=>array(
					"content_title"=>$order_data["Contentbuffer"]["Content"]["title"],
					"sub_content_title"=>$sub_content_title,
					"username"=>$order_data["Outuser"]["nickname"],
					"datetime"=>date("Y年m月d日 H時i分"),
					"order_number"=>$order_data["Order"]["number"],
					"order_url"=>$wwwurl.$order_data["Outuser"]["username"]."/order/ordering_detail/".$order_data["Order"]["number"],
				),
			);
		}
		else if($mailcode=="order_payment_claim_complete_receive"){
			//支払確認通知(銀振)(受注)

			$mail_params=array(
				"code"=>"order_payment_claim_complete_receive",
				"from"=>$order_data["Inuser"]["mailaddress"],
				"user_id"=>$order_data["Inuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Inuser"]["nickname"]),
				"format_name"=>"支払確認通知(銀振)(受注)",
				"vars"=>array(
					"order_number"=>$order_data["Order"]["number"],
					"username"=>h($order_data["Inuser"]["nickname"]),
					"content_title"=>h($order_data["Contentbuffer"]["Content"]["title"]),
					"sub_content_title"=>$sub_content_title,
					"total_price"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]*(1-0.01*$order_data["Order"]["commission"])),
					"payment_paydate"=>date("Y年m月d日 H時i分"),
					"orderurl"=>$wwwurl.$order_data["Inuser"]["username"]."/order/receive_detail/".$order_data["Order"]["number"]
				),
			);

		}
		else if($mailcode=="order_payment_claim_complete_ordering"){
			//支払確認通知(銀振)(発注)

			$mail_params=array(
				"code"=>"order_payment_claim_complete_ordering",
				"from"=>$order_data["Outuser"]["mailaddress"],
				"user_id"=>$order_data["Outuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"支払確認通知(銀振)(発注)",
				"vars"=>array(
					"content_title"=>$order_data["Contentbuffer"]["Content"]["title"],
					"sub_content_title"=>$sub_content_title,
					"username"=>$order_data["Outuser"]["nickname"],
					"order_number"=>$order_data["Order"]["number"],
					"total_price"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]),
					"orderurl"=>$wwwurl.$order_data["Outuser"]["username"]."/order/ordering_detail/".$order_data["Order"]["number"],
					"payment_paydate"=>date("Y年m月d日 H時i分"),
					"option_caption"=>"ライブラリ管理ユーザーに、お支払確認と作業開始のメールを通知いたしました。",
				),
			);
		}
		else if($mailcode=="order_payment_claim"){
			//支払請求通知(銀振)

			$loaddata=$this->Loadbasic->load("");
			$claim_info="
銀行振込
振込先情報
銀行名:".$loaddata["pool_bank_name"]."
口座支店名:".$loaddata["pool_bank_areaname"]."
口座種別:".$loaddata["pool_bank_type"]."
口座番号:".$loaddata["pool_bank_number"]."
口座名義:".$loaddata["pool_bank_caption"]."
その他備考:".$loaddata["pool_bank_other"];

			//「入金前作業待ち」の場合
			$mail_params=array(
				"code"=>"order_payment_claim",
				"from"=>$order_data["Outuser"]["mailaddress"],
				"user_id"=>$order_data["Outuser"]["id"],
				"order_id"=>$order_data["Order"]["id"],
				"fromuser"=>h($order_data["Outuser"]["nickname"]),
				"format_name"=>"支払請求通知(銀振)",
				"vars"=>array(
					"username"=>$order_data["Outuser"]["nickname"],
					"content_title"=>$order_data["Contentbuffer"]["Content"]["title"],
					"sub_content_title"=>$sub_content_title,
					"order_number"=>$order_data["Order"]["number"],
					"order_url"=>$wwwurl.$order_data["Outuser"]["username"]."/order/ordering_detail/".$order_data["Order"]["number"],
					"total_price"=>"￥".number_format($order_data["Order"]["hope_price"]*$order_data["Order"]["order_count"]),
					"payment_claimdate"=>date("Y年m月d日 H時i分"),
					"claim_info"=>$claim_info,
				),
			);
		}

		$mailtext=$this->Sendmail->mailset($mail_params);

		$mail_params["output"]=array(
			"subject"=>$mailtext["subject"],
			"message"=>$mailtext["message"],
		);
		return $mail_params;

	}
}
