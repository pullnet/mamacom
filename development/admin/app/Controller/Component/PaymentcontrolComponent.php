<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/09							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	支払管理用コンポーネント					*/
/*	PaymentcontrolComponent.php					*/
/* ------------------------------------------------------------------- 	*/

class PaymentcontrolComponent extends Component{

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
				//コンテンツバッファはjsonデコードして再度入れ直す
				$contenbuffer=json_decode($result["Contentbuffer"]["buffer"],true);
				$result["Contentbuffer"]=$contenbuffer;

				//メール通知の送信先
				$loadModel = ClassRegistry::init('User');
				if($result["Order"]["libraryorderset_id"]){
					//ライブラリの場合は発注ユーザーの情報を取得
					$userdata=$loadModel->find("first",array(
						"conditions"=>array(
							"User.id"=>$result["Order"]["output_user_id"],
						),
					));
					//オーナー情報も取得
					$ownerdata=$loadModel->find("first",array(
						"conditions"=>array(
							"User.id"=>$result["Order"]["input_user_id"],
						),
					));
				}
				else if($result["Order"]["collaboparty_id"]){
					//コラボの場合は受注ユーザーの情報を取得
					$userdata=$loadModel->find("first",array(
						"conditions"=>array(
							"User.id"=>$result["Order"]["input_user_id"],
						),
					));
					//オーナー情報も取得
					$ownerdata=$loadModel->find("first",array(
						"conditions"=>array(
							"User.id"=>$result["Order"]["output_user_id"],
						),
					));

				}
				$result["User"]=$userdata["User"];
				$result["Owner"]=$ownerdata["User"];

				//まずステータス変更ｗ
				if($a_["after_status"]=="working"){
					$psa=2;
				}
				else if($a_["after_status"]=="paybefore_workquery"){
					$psa=1;
				}
				$savedata=array(
					"Order"=>array(
						"id"=>$a_["id"],
						"order_status"=>$a_["after_status"],
						"payment_status"=>$psa,
					),
				);
				$loadModel = ClassRegistry::init('Order');
				$loadModel->save($savedata,false);
				

				//ログも残す
				$log_caption=array(
					"type"=>"change_status",
					"order_status"=>array(
						"before"=>$result["Order"]["order_status"],
						"after"=>$a_["after_status"],
					),
				);
				$save_log=array(
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
				$loadModel->save($save_log,false);
				

				//その他の特殊な操作はコチラ
				$this->_option($a_,$result);

				//メール送信...
				$this->_sendmail($a_,$result);

			}
		}

	}
	//☆メール送信処理用
	private function _sendmail($post,$result){
		
		//各ステータスごとでのメール内容を割り振る

		if($post["after_status"]=="working"){

			foreach($result["Orderlog"] as $r_){
				$l_json=json_decode($r_["caption"],true);

				if($l_json["type"]=="change_status"){
					if($l_json["order_status"]["after"]=="working"){
						$payment_startdate=date("Y-m-d H:i",strtotime($r_["change_date"]));
					}
				}
			}


			//「支払済み」の場合
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
						"ordernumber"=>$result["Order"]["number"],
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
					"from"=>h($result["Owner"]["mailaddress"]),
					"user_id"=>$result["Owner"]["id"],
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
					"from"=>$result["User"]["mailaddress"],
					"user_id"=>$result["User"]["id"],
					"order_id"=>$result["Order"]["id"],
					"vars"=>array(
						"order_number"=>$result["Order"]["number"],
						"username"=>h($result["User"]["nickname"]),
						"content_title"=>h($result["Contentbuffer"]["Content"]["title"]),
						"sub_content_title"=>$result["Contentbuffer"]["Collabopartyset"]["title"],
						"total_price"=>"￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]),
						"payment_paydate"=>date("Y年m月d日 H時i分"),
						"payment_claimdate"=>date("Y年m月d日 H時i分",strtotime($payment_startdate)),
						"orderurl"=>$this->wwwurl.$result["User"]["username"]."/order/receive_detail/".$result["Order"]["number"]
					),
				);
				$this->Sendmail->send($mail_params);


			}
		}
	}
	//☆オプション動作用
	private function _option($post,$result){

		if($post["after_status"]=="working"){
			//「支払確認済み」の場合...
			$savedata=array(
				"Order"=>array(
					"id"=>$result["Order"]["id"],
					"payment_exitdate"=>date("Y-m-d H:i:s"),
				),
			);
			$loadModel = ClassRegistry::init('Order');
			$loadModel->save($savedata,false);
		}

	}
}
