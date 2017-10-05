<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/09							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	受注管理用コンポーネント					*/
/*	OrdercontrolComponent.php					*/
/* ------------------------------------------------------------------- 	*/

class OrdercontrolComponent extends Component{

	public $wwwurl="";

	public $components=array(
		"Loadbasic",
		"Sendmail",
	);

	//ステータス変更時処理
	public function change_status($array){
		
		//arrayの中身
		/*
		array(
			0=>array(
				"id"=>ステータス変更対象の受注ID
				"before_status"=>変更前のステータス
				"after_status"=>変更後のステータス
			),
		);
		*/
		$this->wwwurl=$this->Loadbasic->load("wwwurl");

		foreach($array as $a_){
			
			//ステータスが変更されているかどうかチェック
			if($a_["before_status"]!=$a_["after_status"]){
				
				//まず受注情報の中身を取得...
				$loadModel = ClassRegistry::init('Order');
				$loadModel->bindModel(array(
					"hasOne"=>array(
						"Contentbuffer",
					),
					"hasMany"=>array(
						"Orderlog",
					),
				));
				$result=$loadModel->find("first",array(
					"conditions"=>array(
						"Order.id"=>$a_["id"],
					),
				));

				if($result["Order"]["libraryorderset_id"]){
					$result["Order"]["type"]="library";
				}
				else if($result["Order"]["collaboparty_id"]){
					$result["Order"]["type"]="collabo";
				}

				//コンテンツバッファはjsonデコードして再度入れ直す
				$contenbuffer=json_decode($result["Contentbuffer"]["buffer"],true);
				$result["Contentbuffer"]=$contenbuffer;

				//メール通知の送信先(=発注ユーザー)の情報を取得..
				$loadModel = ClassRegistry::init('User');
				$userdata=$loadModel->find("first",array(
					"conditions"=>array(
						"User.id"=>$result["Order"]["output_user_id"],
					),
				));
				$result["User"]=$userdata["User"];

				//メール通知の送信先(=受注ユーザー)の情報を取得..
				$loadModel = ClassRegistry::init('User');
				$userdata=$loadModel->find("first",array(
					"conditions"=>array(
						"User.id"=>$result["Order"]["input_user_id"],
					),
				));
				$result["Owner"]=$userdata["User"];


				//まずステータス変更ｗ
				$savedata=array(
					"Order"=>array(
						"id"=>$a_["id"],
						"order_status"=>$a_["after_status"],
					),
				);
				if(!@$a_["auto_sendmail"]){
					$savedata["Order"]["sendmail_status"]=1;
				}
				$loadModel = ClassRegistry::init('Order');
				$loadModel->save($savedata,false);

				//変更ログを残す
				$log_caption=array(
					"type"=>"change_status",
					"order_status"=>array(
						"before"=>$a_["before_status"],
						"after"=>$a_["after_status"],
					),
				);
				$log_data=array(
					"Orderlog"=>array(
						"id"=>"",
						"order_id"=>$a_["id"],
						"change_date"=>date("Y-m-d H:i:s"),
						"changeuser_status"=>2,
						"unread"=>0,
						"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
					),
				);
				$loadModel = ClassRegistry::init('Orderlog');
				$loadModel->save($log_data,false);
				
				//その他の特殊な操作はコチラ
				$this->_option($a_,$result);

				//メール送信...
				if(@$a_["auto_sendmail"]){
					$this->_sendmail($a_,$result);
				}

			}
		}

	}
	//☆メール送信処理用
	private function _sendmail($post,$result){
		
		//各ステータスごとでのメール内容を割り振る

		if($post["after_status"]=="paybefore_workquery"){

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
				"from"=>$result["User"]["mailaddress"],
				"user_id"=>$result["User"]["id"],
				"order_id"=>$result["Order"]["id"],
				"vars"=>array(
					"username"=>$result["User"]["nickname"],
					"content_title"=>$result["Contentbuffer"]["Content"]["title"],
					"order_number"=>$result["Order"]["number"],
					"order_url"=>$this->wwwurl.$result["User"]["username"]."/order/ordering_detail/".$result["Order"]["number"],
					"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
					"payment_claimdate"=>date("Y年m月d日 H時i分"),
					"claim_info"=>$claim_info,
				),
			);
			if($result["Order"]["type"]=="library"){
				$mail_params["vars"]["sub_content_title"]=@$result["Contentbuffer"]["Libraryorderset"]["title"];
			}
			else if($result["Order"]["type"]=="collabo"){
				$mail_params["vars"]["sub_content_title"]=@$result["Contentbuffer"]["Collabopartyset"]["title"];
			}

			$this->Sendmail->send($mail_params);
		}
		else if($post["after_status"]=="working"){
			//「作業中(入金済)」の場合
			$payment_startdate="";
			foreach($result["Orderlog"] as $r_){
				$l_json=json_decode($r_["caption"],true);

				if($l_json["type"]=="change_status"){
					if($l_json["order_status"]["after"]=="working"){
						$payment_startdate=date("Y-m-d H:i",strtotime($r_["change_date"]));
					}
				}
			}


			if($result["Order"]["libraryorderset_id"]){
				//ライブラリ発注の場合
				//ライブラリ発注ユーザーに支払確認通知メールを
				$mail_params=array(
					"code"=>"order_payment_claim_complete_ordering",
					"from"=>$result["User"]["mailaddress"],
					"user_id"=>$result["User"]["id"],
					"order_id"=>$result["Order"]["id"],
					"vars"=>array(
						"content_title"=>$result["Contentbuffer"]["Content"]["title"],
						"sub_content_title"=>$result["Contentbuffer"]["Libraryorderset"]["title"],
						"username"=>$result["User"]["nickname"],
						"order_number"=>$result["Order"]["number"],
						"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
						"orderurl"=>$this->wwwurl.$result["User"]["username"]."/order/ordering_detail/".$result["Order"]["number"],
						"payment_claimdate"=>date("Y年m月d日 H時i分",strtotime($payment_startdate)),
						"payment_paydate"=>date("Y年m月d日 H時i分"),
						"option_caption"=>"ライブラリ管理ユーザーに、お支払確認と作業開始のメールを通知いたしました。",
					),
				);
				$this->Sendmail->send($mail_params);

				//ライブラリオーナー(受注ユーザー)にも支払確認メールを
				$mail_params=array(
					"code"=>"order_payment_claim_complete_receive",
					"from"=>$result["Owner"]["mailaddress"],
					"user_id"=>$result["Owner"]["id"],
					"order_id"=>$result["Order"]["id"],
					"vars"=>array(
						"order_number"=>$result["Order"]["number"],
						"username"=>h($result["Owner"]["nickname"]),
						"content_title"=>h($result["Contentbuffer"]["Content"]["title"]),
						"sub_content_title"=>$result["Contentbuffer"]["Libraryorderset"]["title"],
						"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
						"payment_paydate"=>date("Y年m月d日 H時i分"),
						"payment_claimdate"=>date("Y年m月d日 H時i分",strtotime($payment_startdate)),
						"orderurl"=>$this->wwwurl.$result["Owner"]["username"]."/order/receive_detail/".$result["Order"]["number"]
					),
				);
				$this->Sendmail->send($mail_params);

			}
			else if($result["Order"]["collaboparty_id"]){

				//コラボオーナー(発注ユーザー)に支払確認通知メールを
				$mail_params=array(
					"code"=>"order_payment_claim_complete_ordering",
					"from"=>h($result["User"]["mailaddress"]),
					"user_id"=>$result["User"]["id"],
					"order_id"=>$result["Order"]["id"],
					"vars"=>array(
						"content_title"=>$result["Contentbuffer"]["Content"]["title"],
						"sub_content_title"=>$result["Contentbuffer"]["Collabopartyset"]["title"],
						"username"=>$result["User"]["nickname"],
						"order_number"=>$result["Order"]["number"],
						"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
						"orderurl"=>$this->wwwurl.$result["User"]["username"]."/order/ordering_detail/".$result["Order"]["number"],
						"payment_claimdate"=>date("Y年m月d日 H時i分",strtotime($payment_startdate)),
						"payment_paydate"=>date("Y年m月d日 H時i分"),
						"option_caption"=>"コラボ参加者に、協業を開始するメールを通知いたしました。",
					),
				);
				
				$this->Sendmail->send($mail_params);

				//コラボ参加者(受注ユーザー)にも支払確認メールを
				$mail_params=array(
					"code"=>"order_payment_claim_complete_receive",
					"from"=>$result["Owner"]["mailaddress"],
					"user_id"=>$result["Owner"]["id"],
					"order_id"=>$result["Order"]["id"],
					"vars"=>array(
						"order_number"=>$result["Order"]["number"],
						"username"=>h($result["Owner"]["nickname"]),
						"content_title"=>h($result["Contentbuffer"]["Content"]["title"]),
						"sub_content_title"=>$result["Contentbuffer"]["Collabopartyset"]["title"],
						"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
						"payment_paydate"=>date("Y年m月d日 H時i分"),
						"payment_claimdate"=>date("Y年m月d日 H時i分",strtotime($payment_startdate)),
						"orderurl"=>$this->wwwurl.$result["Owner"]["username"]."/order/receive_detail/".$result["Order"]["number"]
					),
				);
				$this->Sendmail->send($mail_params);
			}
		}
		else if($post["after_status"]=="complete"){

			//「作業・サービス提供完了」の場合...


		}
		else if($post["after_status"]=="transfer_request"){
			//「振込依頼中」の場合...
/*
			$payment_info="銀行名:".$this->Loadbasic->load("pool_bank_name")."\n".
					"支店名:".$this->Loadbasic->load("pool_bank_areaname")."\n".
					"口座種別:".$this->Loadbasic->load("pool_bank_type")."\n".
					"口座番号:".$this->Loadbasic->load("pool_bank_number")."\n".
					"口座名義:".$this->Loadbasic->load("pool_bank_caption")."\n\n".
					$this->Loadbasic->load("pool_bank_other");

			$mail_params=array(
				"code"=>"payment_claim",
				"from"=>$result["User"]["mailaddress"],
				"user_id"=>$result["User"]["id"],
				"order_id"=>$result["Order"]["id"],
				"vars"=>array(
					"library_title"=>$result["Contentbuffer"]["Content"]["title"],
					"username"=>$result["User"]["nickname"],
					"sub_library_title"=>$result["Contentbuffer"]["Libraryorderset"]["title"],
					"ordernumber"=>$result["Order"]["number"],
					"payment_claimdate"=>date("Y年m月d日 H時i分"),
					"payment_info"=>$payment_info,
					"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
					"orderurl"=>$this->wwwurl.$result["User"]["username"]."/order/ordering_detail/".$result["Order"]["number"],
				),
			);
			$this->Sendmail->send($mail_params);
*/
		}
		else if($post["after_status"]=="transfer_complete"){
/*
			//「振込完了」の場合...
			$mail_params=array(
				"code"=>"payment_claim_complete",
				"from"=>$result["User"]["mailaddress"],
				"user_id"=>$result["User"]["id"],
				"order_id"=>$result["Order"]["id"],
				"vars"=>array(
					"library_title"=>$result["Contentbuffer"]["Content"]["title"],
					"username"=>$result["User"]["nickname"],
					"sub_library_title"=>$result["Contentbuffer"]["Libraryorderset"]["title"],
					"ordernumber"=>$result["Order"]["number"],
					"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
					"orderurl"=>$this->wwwurl.$result["User"]["username"]."/order/ordering_detail/".$result["Order"]["number"],
					"payment_claimdate"=>date("Y年m月d日 H時i分",strtotime($result["Order"]["payment_claimdate"])),
					"payment_paydate"=>date("Y年m月d日 H時i分"),
				),
			);
			$this->Sendmail->send($mail_params);
*/
		}
	}
	//☆オプション動作用
	private function _option($post,$result){

		if($post["after_status"]=="paybefore_workquery"){
			//「入金前作業待ち」の場合、

			$save_data=array(
				"Order"=>array(
					"id"=>$post["id"],
					"payment_status"=>1,
					"payment_startdate"=>date("Y-m-d H:i:s"),
				),
			);
			$loadModel = ClassRegistry::init('Order');
			$loadModel->save($save_data,false);

		}
		if($post["after_status"]=="working"){
			//「作業中(入金済)」の場合、

			$save_data=array(
				"Order"=>array(
					"id"=>$post["id"],
					"payment_status"=>2,
					"payment_exitdate"=>date("Y-m-d H:i:s"),
				),
			);
			$loadModel = ClassRegistry::init('Order');
			$loadModel->save($save_data,false);

		}
	}
}
