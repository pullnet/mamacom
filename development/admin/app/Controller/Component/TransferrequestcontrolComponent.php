<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/01/26							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	振込管理用コンポーネント					*/
/*	TransferrequestcontrolComponent.php				*/
/* ------------------------------------------------------------------- 	*/

class TransferrequestcontrolComponent extends Component{

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
				"id"=>振込完了対象の受注ID
			),
		);
		*/
		$this->wwwurl=$this->Loadbasic->load("wwwurl");

		foreach($array as $a_){
			
			if($a_["id"]){
				//まず受注情報の中身を取得...
				$loadModel = ClassRegistry::init('Order');
				$loadModel->bindModel(array(
					"hasOne"=>array(
						"Contentbuffer",
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

				//発注ユーザーの情報を取得
				$in_userdata=$loadModel->find("first",array(
					"conditions"=>array(
						"User.id"=>$result["Order"]["input_user_id"],
					),
				));
				//受注ユーザーの情報も取得...
				$out_userdata=$loadModel->find("first",array(
					"conditions"=>array(
						"User.id"=>$result["Order"]["output_user_id"],
					),
				));
				$result["Inuser"]=$in_userdata["User"];
				$result["Outuser"]=$out_userdata["User"];


				//まずステータス変更ｗ
				$savedata=array(
					"Order"=>array(
						"id"=>$a_["id"],
						"order_status"=>"transfer_complete",
					),
				);
				$loadModel = ClassRegistry::init('Order');
				$loadModel->save($savedata,false);

				///ログも保存する
				$log_caption=array(
					"type"=>"change_status",
					"order_status"=>array(
						"before"=>"transfer_request",
						"after"=>"transfer_complete",
					),
				);
				$savedata_log=array(
					"Orderlog"=>array(
						"id"=>"",
						"order_id"=>$a_["id"],
						"change_date"=>date("Y-m-d H:i:s"),
						"user_id"=>$this->authdata["User"]["id"],
						"changeuser_status"=>2,
						"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
						"unread_output"=>1,//発注者は関係ないので既読にする
					),
				);
				$loadModel = ClassRegistry::init('Orderlog');
				$loadModel->save($savedata_log,false);

				//メール送信...
				$this->_sendmail($a_,$result);

			}
		}

	}
	//☆メール送信処理用
	private function _sendmail($post,$result){
		
		//「振込完了」の場合
		if($result["Order"]["libraryorderset_id"]){
			$sub_content_title=h($result["Contentbuffer"]["Libraryorderset"]["title"]);
		}
		else if($result["Order"]["collaboparty_id"]){
			$sub_content_title=h($result["Contentbuffer"]["Collabopartyset"]["title"]);
		}

		//振込依頼完了通知メールを

		$mail_params=array(
			"code"=>"order_transfer_request_complete",
			"from"=>$result["Inuser"]["mailaddress"],
			"user_id"=>$result["Inuser"]["id"],
			"order_id"=>$result["Order"]["id"],
			"vars"=>array(
				"content_title"=>h($result["Contentbuffer"]["Content"]["title"]),
				"sub_content_title"=>$sub_content_title,
				"user_name"=>h($result["Inuser"]["nickname"]),
				"order_number"=>$result["Order"]["number"],
				"pricetotal"=>"￥".number_format(($result["Order"]["hope_price"]*$result["Order"]["order_count"])*(1-$result["Order"]["commission"]*0.01)),
				"transfer_date"=>date("Y年m月d日 H時i分"),
				"order_url"=>$this->wwwurl.$result["Inuser"]["username"]."/order/receive_detail/".$result["Order"]["number"],
			),
		);
		$this->Sendmail->send($mail_params);
	}
}
