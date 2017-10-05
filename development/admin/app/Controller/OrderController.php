<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/09							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	注文管理用コントローラ						*/
/*	OrderController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class OrderController extends AppController {

	public $uses=array(
		"Order",
		"Orderlog",
		"User",
		"Mailformat",
		"Maillog",
	);
	public $components=array(
		"Db",
		"Loadbasic",
		"Ordercontrol",
		"Sendmail",
		"Ordermailset",
	);
	//★注文管理一覧
	public function index($page=1){
		$this->set("orderstatus",$this->Db->orderstatus());
		$this->set("payment",$this->Db->payment());

		//メールフォーマット一覧作成
		$mf_buff=$this->Mailformat->find("list",array(
			"conditions"=>array(
				"Mailformat.category"=>"order",
			),
			"fields"=>array("sub_category"),
		));
		$mail_format_buff=$this->Mailformat->find("all",array(
			"conditions"=>array(
				"Mailformat.category"=>"order",
			),
			"fields"=>array("code","name","category","sub_category"),
		));

		$mail_format=array();
		foreach($mf_buff as $mb_){
			foreach($mail_format_buff as $mfb_){
				if($mfb_["Mailformat"]["sub_category"]==$mb_){
					$mail_format[$mb_][$mfb_["Mailformat"]["code"]]=$mfb_["Mailformat"]["name"];
				}
			}
		}
		$this->set("mail_format",$mail_format);


		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);

		if(@$this->request->query){
			$query=$this->request->query;

			if(@$query["keyword"]){
				$cond_keyword=array(
					"Order.number LIKE"=>"%".$query["keyword"]."%",
				);
				$cond_userlist=array(
					"User.nickname LIKE"=>"%".$query["keyword"]."%",
				);

				$get_userlist=$this->User->find("list",array(
					"conditions"=>array(
						$cond_userlist,
					),
					"fields"=>array("id"),
				));

				$get_orderlist=$this->Order->find("list",array(
					"conditions"=>array(
						"Or"=>array(
							"Order.input_user_id"=>$get_userlist,
							"Order.output_user_id"=>$get_userlist,
						),
					),
					"fields"=>array("id"),
				));

			}
			if(@$query["type"]){
				if($query["type"]==1){
					$cond_type=array(
						"NOT"=>array(
							"Order.libraryorderset_id"=>null,
						),
					);
				}
				else if($query["type"]==2){
					$cond_type=array(
						"NOT"=>array(
							"Order.collaboparty_id"=>null,
						),
					);
				}
			}

			if(@$query["order_status"]){
				$cond_order_status=array(
					"Order.order_status"=>$query["order_status"],
				);

			}

		}

		$this->Order->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
			"belongsTo"=>array(
				"User"=>array(
					"foreignKey"=>"output_user_id",
				),
				"Inputuser"=>array(
					"className"=>"User",
					"foreignKey"=>"input_user_id",
				),
			),
			"hasMany"=>array(
				"Orderlog",
			),
		));
		if(@$get_orderlist){
			$cond=array(
				"Order.id"=>$get_orderlist,
				@$cond_type,
				@$cond_order_status,
			);
		}
		else
		{
			$cond=array(
				@$cond_keyword,
				@$cond_type,
				@$cond_order_status,
			);
		}
		$result=$this->Order->find("all",array(
			"conditions"=>$cond,
			"order"=>array("Order.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
			"recursive"=>2,
		));
		$ind=0;
		foreach($result as $r_){
			$sort=json_decode($r_["Contentbuffer"]["buffer"],true);
			$result[$ind]["Contentbuffer"]=$sort;
			$ind++;
		}
		$this->set("result",$result);

		$totalcount=$this->Order->find("count",array(
			"conditions"=>array(
				@$cond_keyword,
				@$cond_type,
				@$cond_order_status,
			),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);


		if($this->request->data){
			$post=$this->request->data;

			$juge=false;

			foreach($post["Orderselect"]["check"] as $p_){
				if($p_){
					$juge=true;
				}
			}

			if(!$juge){
				$this->Session->write("alert","最低１つ以上は受注情報を選択してください");
				$this->redirect(array("controller"=>"order","action"=>"index",$page,"?"=>$this->request->query));
			}

			if($post["Orderselect"]["type"]=="change_status"){

				if(!$post["Orderselect"]["change_orderstatus"]){
					$this->Session->write("alert","変更するステータスが選択されていません");
					$this->redirect(array("controller"=>"order","action"=>"index",$page,"?"=>$this->request->query));
				}

				if($post["Orderselect"]["auto_sendmail"]==1){
					//メール送信付きでステータス変更
					$this->Session->write("post",$post);
					$this->redirect(array("controller"=>"order","action"=>"sendmail"));
				}
				else
				{
					//メール送信なしでステータス変更

				}

				foreach($post["Orderselect"]["check"] as $p_){
					if($p_){
						$buff=$this->Order->find("first",array(
							"conditions"=>array(
								"Order.id"=>$p_,
							),
						));

						$params[]=array(
							"id"=>$p_,
							"before_status"=>$buff["Order"]["order_status"],
							"after_status"=>$post["Orderselect"]["change_orderstatus"],
							"auto_sendmail"=>$post["Orderselect"]["auto_sendmail"],
						);

						$this->Ordercontrol->change_status($params);
					}
				}
			}
			else if($post["Orderselect"]["type"]=="sendmail"){

				if(!$post["Orderselect"]["send_mailformat"]){
					$this->Session->write("alert","送信するメールフォーマットが選択されていません");
					$this->redirect(array("controller"=>"order","action"=>"index",$page,"?"=>$this->request->query));
				}


				//メール送信のみ
				$this->Session->write("post",$post);
				$this->redirect(array("controller"=>"order","action"=>"sendmail"));

			}

			$this->Session->write("alert","ステータス変更が完了しました");
			$this->redirect(array("controller"=>"order","action"=>"index",$page,"?"=>$this->request->query));


		}
	}
	//★注文詳細画面
	public function detail($id){
		$this->set("orderstatus",$this->Db->orderstatus());
		$this->set("payment",$this->Db->payment());
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
		$this->set("credit_company",$this->Db->credit_company());
		$this->set("paymentstatus",array(1=>"支払請求中",2=>"支払確認済み",3=>"決済エラー"));

		//メールフォーマット一覧作成
		$mf_buff=$this->Mailformat->find("list",array(
			"conditions"=>array(
				"Mailformat.category"=>"order",
			),
			"fields"=>array("sub_category"),
		));
		$mail_format_buff=$this->Mailformat->find("all",array(
			"conditions"=>array(
				"Mailformat.category"=>"order",
			),
			"fields"=>array("code","name","category","sub_category"),
		));

		$mail_format=array();
		foreach($mf_buff as $mb_){
			foreach($mail_format_buff as $mfb_){
				if($mfb_["Mailformat"]["sub_category"]==$mb_){
					$mail_format[$mb_][$mfb_["Mailformat"]["code"]]=$mfb_["Mailformat"]["name"];
				}
			}
		}
		$this->set("mail_format",$mail_format);

		$this->Order->bindModel(array(
			"hasOne"=>array(
				"Contentbuffer",
			),
		));
		$result=$this->Order->find("first",array(
			"conditions"=>array(
				"Order.id"=>$id,
			),
		));
		if($result["Order"]["libraryorderset_id"]){
			$result["Order"]["type"]="library";
		}
		else if($result["Order"]["collaboparty_id"]){
			$result["Order"]["type"]="collabo";
		}

		$result["Contentbuffer"]=json_decode($result["Contentbuffer"]["buffer"],JSON_UNESCAPED_UNICODE);
		$user_1=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$result["Order"]["input_user_id"],
			),
		));
		$user_2=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$result["Order"]["output_user_id"],
			),
		));
		$result["Inuser"]=$user_1["User"];
		$result["Outuser"]=$user_2["User"];
		$this->set("result",$result);

		//ログ情報を取得
		$logdata=$this->Orderlog->find("all",array(
			"conditions"=>array(
				"Orderlog.order_id"=>$result["Order"]["id"],
			),
			"order"=>array("Orderlog.change_date desc"),
		));
		$this->set("logdata",$logdata);


		if($this->request->data){
			$post=$this->request->data;

			if($post["Order"]["type"]=="price"){
				$savedata=array(
					"Order"=>array(
						"id"=>$id,
						"hope_price"=>$post["Order"]["hope_price"],
					),
				);
				$this->Order->save($savedata,false);

				unset($post["Order"]["type"]);
				$log_caption=array(
					"type"=>"edit",
					"edit"=>array(
						"before"=>$result["Order"],
						"after"=>$post["Order"],
					),
				);
				$save_log=array(
					"Orderlog"=>array(
						"id"=>"",
						"order_id"=>$id,
						"change_date"=>date("Y-m-d H:i:s"),
						"changeuser_status"=>2,
						"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
					),
				);

				$this->Orderlog->save($save_log,false);

				$this->Session->write("alert","価格を変更しました");
				$this->redirect(array("controller"=>"order","action"=>"detail",$id));
			}
			else if($post["Order"]["type"]=="payment"){

				$savedata=array(
					"Order"=>array(
						"id"=>$id,
						"payment"=>$post["Order"]["payment"],
					),
				);
				if($post["Order"]["payment"]==1){
					$savedata["Order"]["credit_json"]=json_encode($post["Order"]["credit"],JSON_UNESCAPED_UNICODE);
				}

				$this->Order->save($savedata,false);

				unset($post["Order"]["type"]);
				$log_caption=array(
					"type"=>"edit",
					"edit"=>array(
						"before"=>$result["Order"],
						"after"=>$post["Order"],
					),
				);
				$save_log=array(
					"Orderlog"=>array(
						"id"=>"",
						"order_id"=>$id,
						"change_date"=>date("Y-m-d H:i:s"),
						"changeuser_status"=>2,
						"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
					),
				);

				$this->Orderlog->save($save_log,false);

				$this->Session->write("alert","支払方法を変更しました");
				$this->redirect(array("controller"=>"order","action"=>"detail",$id));

			}
			else if($post["Order"]["type"]=="count"){
				$savedata=array(
					"Order"=>array(
						"id"=>$id,
						"order_count"=>$post["Order"]["order_count"],
					),
				);
				$this->Order->save($savedata,false);

				unset($post["Order"]["type"]);
				$log_caption=array(
					"type"=>"edit",
					"edit"=>array(
						"before"=>$result["Order"],
						"after"=>$post["Order"],
					),
				);
				$save_log=array(
					"Orderlog"=>array(
						"id"=>"",
						"order_id"=>$id,
						"change_date"=>date("Y-m-d H:i:s"),
						"changeuser_status"=>2,
						"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
					),
				);

				$this->Orderlog->save($save_log,false);

				$this->Session->write("alert","発注数を変更しました");
				$this->redirect(array("controller"=>"order","action"=>"detail",$id));
			}
			else if($post["Order"]["type"]=="hope_delivary"){
				$savedata=array(
					"Order"=>array(
						"id"=>$id,
						"hope_delivary"=>$post["Order"]["hope_delivary"],
					),
				);
				$this->Order->save($savedata,false);

				unset($post["Order"]["type"]);
				$log_caption=array(
					"type"=>"edit",
					"edit"=>array(
						"before"=>$result["Order"],
						"after"=>$post["Order"],
					),
				);
				$save_log=array(
					"Orderlog"=>array(
						"id"=>"",
						"order_id"=>$id,
						"change_date"=>date("Y-m-d H:i:s"),
						"changeuser_status"=>2,
						"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
					),
				);

				$this->Orderlog->save($save_log,false);

				$this->Session->write("alert","希望納期を変更しました");
				$this->redirect(array("controller"=>"order","action"=>"detail",$id));
			}
			else if($post["Order"]["type"]=="caption"){

				$savedata=array(
					"Order"=>array(
						"id"=>$id,
						"caption"=>$post["Order"]["caption"],
					),
				);
				$this->Order->save($savedata,false);

				unset($post["Order"]["type"]);
				$log_caption=array(
					"type"=>"edit",
					"edit"=>array(
						"before"=>$result["Order"],
						"after"=>$post["Order"],
					),
				);
				$save_log=array(
					"Orderlog"=>array(
						"id"=>"",
						"order_id"=>$id,
						"change_date"=>date("Y-m-d H:i:s"),
						"changeuser_status"=>2,
						"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
					),
				);

				$this->Orderlog->save($save_log,false);

				$this->Session->write("alert","その他備考欄を変更しました");
				$this->redirect(array("controller"=>"order","action"=>"detail",$id));

			}
			else if($post["Order"]["type"]=="change_status"){

				$params=array(
					array(
						"id"=>$result["Order"]["id"],
						"before_status"=>$result["Order"]["order_status"],
						"after_status"=>$post["Order"]["change_orderstatus"],
						"auto_sendmail"=>$post["Order"]["auto_sendmail"],
					),
				);

				$this->Ordercontrol->change_status($params);


				$this->Session->write("alert","ステータス変更が完了しました");
				$this->redirect(array("controller"=>"order","action"=>"detail",$result["Order"]["id"]));

			}
			else if($post["Order"]["type"]=="sendmail"){


				if(!$post["Order"]["send_mailformat"]){
					$this->Session->write("alert","送信するメールフォーマットが選択されていません");
					$this->redirect(array("controller"=>"order","action"=>"detail",$result["Order"]["id"]));
				}
				$post_buff["Orderselect"]=$post["Order"];
				$post_buff["Orderselect"]["check"][0]=$result["Order"]["id"];


				//メール送信のみ
				$this->Session->write("post",$post_buff);
				$this->redirect(array("controller"=>"order","action"=>"sendmail"));

			}

		}
	}
	//★支払特別権限設定
	public function special_payment($id){

		$result=$this->Order->find("first",array(
			"conditions"=>array(
				"Order.id"=>$id,
			),
		));
		$this->set("result",$result);
		if($this->request->data){
			$post=$this->request->data;

			$this->Order->save($post,false);
			unset($post["Order"]["id"]);
			$log_caption=array(
				"type"=>"edit",
				"edit"=>array(
					"before"=>$result["Order"],
					"after"=>$post["Order"],
				),
			);
			$save_log=array(
				"Orderlog"=>array(
					"id"=>"",
					"change_date"=>date("Y-m-d H:i:s"),
					"changeuser_status"=>2,
					"order_id"=>$id,
					"caption"=>json_encode($log_caption,JSON_UNESCAPED_UNICODE),
					"unread_user"=>1,
					"unread_owner"=>1,
					"unread_admin"=>1,
				),
			);
			$this->Orderlog->save($save_log,false);

			$this->Session->write("alert","支払特別権限を設定しました。");
			$this->redirect(array("controller"=>"order","action"=>"detail",$id));
		}
		else
		{
			$this->request->data=$result;
		}
	}
	public function sendmail(){
		if($this->Session->read("post")){
			$post_0=$this->Session->read("post");

			foreach($post_0["Orderselect"]["check"] as $p_){
				if($p_){
					$this->Order->bindModel(array(
						"hasMany"=>array(
							"Orderlog",
						),
						"hasOne"=>array(
							"Contentbuffer",
						),
						"belongsTo"=>array(
							"Inuser"=>array(
								"className"=>"User",
								"foreignKey"=>"input_user_id",
							),
							"Outuser"=>array(
								"className"=>"User",
								"foreignKey"=>"output_user_id",
							),
						),
					));
					$order_data=$this->Order->find("first",array(
						"conditions"=>array(
							"Order.id"=>$p_,
						),
						"recursive"=>2,
					));
					$order_data["Contentbuffer"]=@json_decode(@$order_data["Contentbuffer"]["buffer"],true);
					$next_post[]=$this->Ordermailset->mailset($order_data,$post_0["Orderselect"]["send_mailformat"]);
				}
			}

			if($this->request->data){
				$post=$this->request->data;
				foreach($post["Ordermail"] as $key=>$p_){
					$next_post[$key]["template"]=$p_["output"];
					$next_post[$key]["no_format"]=true;

					$this->Sendmail->send($next_post[$key]);

					$savedata=array(
						"Order"=>array(
							"id"=>$next_post[$key]["order_id"],
							"sendmail_status"=>2,//メール送信ステータスを1に
						),
					);
					$this->Order->save($savedata,false);
				}

				$this->Session->delete("post");

				$this->Session->write("alert","メール送信が完了しました");
				$this->redirect(array("controller"=>"order","action"=>"index"));
			}
			else
			{

				$this->request->data["Ordermail"]=$next_post;
				$this->set("next_post",$next_post);
			}
		}
		else
		{
			$this->redirect("/");
		}
	}

	//★送信メール一覧
	public function maillog($id){

		$result=$this->Order->find("first",array(
			"conditions"=>array(
				"Order.id"=>$id,
			),
		));
		$this->set("result",$result);

		$maillog=$this->Maillog->find("all",array(
			"conditions"=>array(
				"Maillog.order_id"=>$id,
			),
		));
		$this->set("maillog",$maillog);

	}
	//★送信メール詳細
	public function maillog_detail($id){


		$this->Maillog->bindModel(array(
			"belongsTo"=>array(
				"Order",
			),
		));
		$result=$this->Maillog->find("first",array(
			"conditions"=>array(
				"Maillog.id"=>$id,
			),
		));
		$this->set("result",$result);
	}
	//★受注情報削除
	public function delete($id){
		$this->autoRender=false;

		$this->Order->bindModel(array(
			"hasMany"=>array(
				"Orderlog"=>array(
					"dependent"=>true,
				),
				"Contentbuffer"=>array(
					"dependent"=>true,
				),
			),
		),false);
		$this->Order->delete($id);

		$this->Session->write("alert","注文情報を削除しました");
		$this->redirect(array("controller"=>"order","action"=>"index"));
	}
	//★受注ログ削除
	public function log_delete($order_id,$id){
		$this->autoRender=false;

		$this->Orderlog->delete($id);

		$this->Session->write("alert","注文履歴を１件削除しました");
		$this->redirect(array("controller"=>"order","action"=>"detail",$order_id));

	}
}
