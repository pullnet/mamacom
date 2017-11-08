<?php
//-----------------------------------------------------------------------------
//
//	2017.09.01
//	Masato Nakatsuji
//
//	V1aController
//
//-----------------------------------------------------------------------------

class V1aController extends Controller{

	public $layout=false;
	public $autoRender=false;

	public $uses=array(
		"User",
		"Userprov",
		"Userregist",
		"Userregistration",
	);
	public $components=array(
		"RestAPI",
		"Session",
		"Auth",
	);
	public function beforeFilter(){
		parent::beforeFilter();

		session_start();
		header("Access-Control-Allow-Origin:*");
		if(!@$this->RestAPI->check_accessToken("private")){
			echo JSON_ENC($this->RestAPI->error);
			exit;
		}

		//認証OKならば、POSTからトークン消す
		unset($_POST["access_token"]);
	}
	//-----------------------------------------------------------------------------

	// ここから会員登録用...

	//-----------------------------------------------------------------------------
	//会員仮登録
	public function user_regist_pre(){
		if(@$_POST){
			$post=array("Userregist"=>$_POST);

			$juge=$this->Userregist->validates($post);


			if($juge){

				$output=array(
					"code"=>201,
					"message"=>"validation error",
					"validate"=>$juge["Userregist"],
				);

				echo JSON_ENC($output);
				return;
			}
			else
			{
		
				$output=array(
					"mode"=>200,
					"cash"=>$post["Userregist"],
				);

				echo JSON_ENC($output);
			}
		}
	}
	//会員仮登録(レコード登録)
	public function user_regist_pre2(){
		if($_POST){
			$cash=array("Userregist"=>$_POST);

			try{
				$this->transam("begin",array(
					"Userprov",
				));
				$save_prov=array(
					"Userprov"=>array(
						"id"=>"",
						"code"=>substr(hash("sha256",phpx_date("YmdHis").$cash["Userregist"]["username"]),0,6),
						"mailaddress"=>$cash["Userregist"]["mailaddress"],
						"username"=>$cash["Userregist"]["username"],
						"user_data"=>JSON_ENC(array(
							"mailaddress"=>$cash["Userregist"]["mailaddress"],
							"username"=>$cash["Userregist"]["username"],
							"password"=>$cash["Userregist"]["password"],
							"user_icon"=>$cash["Userregist"]["user_icon"],
						)),
					),
				);

				$res=$this->Userprov->save($save_prov);

				if(!$res){
					$this->transam("rollback");
				}

				$this->transam("commit");

			}catch(Exception $e_){
				$this->transam("rollback");
			}
		
			if($cash["Userregist"]["user_icon_changed"]){
				@mkdir("Content");
				@mkdir("Content/usericon");
				copy($cash["Userregist"]["user_icon_path"],"Content/usericon/".$cash["Userregist"]["user_icon"]);
				
			}

			$output=array(
				"mode"=>200,
			);

			echo JSON_ENC($output);
		}
	}
	//会員本登録
	public function user_registration(){
		if($_POST){
			$post=array(
				"Userregistration"=>$_POST,
			);

			$check=$this->Userprov->find("first",array(
				"conditions"=>array(
					"Userprov.code"=>$post["Userregistration"]["code"],
				),
			));
			if($check){
				$post["Userregistration"]["jugement"]=1;
			}
			$juge=$this->Userregistration->validates($post);

			if($juge){

				$output=array(
					"code"=>201,
					"message"=>"validation error",
					"validate"=>$juge["Userregistration"],
				);

				echo JSON_ENC($output);
				return;

			}
			else
			{

				try{
					$udt=$check["Userprov"]["user_data"];

					$this->transam("begin",array(
						"User",
					));

					$save_user=array(
						"User"=>array(
							"id"=>"",
							"mailaddress"=>$udt["mailaddress"],
							"username"=>$udt["username"],
							"password"=>$this->Auth->password($udt["password"]),
							"user_icon"=>$udt["user_icon"],
						),
					);

					$res=$this->User->save($save_user);

					if(!$res){
						$this->transam("rollback");
					}

					$this->transam("commit");

				}catch(Exception $e_){
					$this->transam("rollback");
				}

				$this->Userprov->delete($check["Userprov"]["id"]);


				//できたら会員情報
				$authdata=$res;

				$authdata["User"]["user_icon_path"]=$this->params["root"]."wdata/Content/usericon/".$authdata["User"]["user_icon"];

				unset($authdata["User"]["create_date"]);
				unset($authdata["User"]["create_user_id"]);
				unset($authdata["User"]["refresh_date"]);
				unset($authdata["User"]["refresh_user_id"]);
				unset($authdata["User"]["password"]);

				$output=array(
					"mode"=>200,
					"auth"=>$authdata["User"],
				);

				echo JSON_ENC($output);
			}
		}
	}
	//ログアウト
	public function logout(){
		$this->Auth->logout(false);

		$output=array(
			"mode"=>200,
		);
		echo JSON_ENC($output);
	}
	//ログイン
	public function user_login(){

		if($_POST){

			$post=array("User"=>$_POST);


			$juge=$this->User->validates($post);
			if($juge){
				$output=array(
					"mode"=>201,
					"message"=>"validation error",
					"validate"=>$juge["User"],
				);
				echo JSON_ENC($output);
				return;
			}
			else
			{

				if($this->Auth->login($post)){
					$authdata=$this->User->find("first",array(
						"conditions"=>array(
							"User.username"=>$post["User"]["username"],
						),
					));

					$authdata["User"]["user_icon_path"]=$this->params["root"]."wdata/Content/usericon/".$authdata["User"]["user_icon"];

					unset($authdata["User"]["create_date"]);
					unset($authdata["User"]["create_user_id"]);
					unset($authdata["User"]["refresh_date"]);
					unset($authdata["User"]["refresh_user_id"]);
					unset($authdata["User"]["password"]);

					$output=array(
						"mode"=>200,
						"Auth"=>$authdata["User"],
					);
					echo JSON_ENC($output);
					return;
				}
				else
				{
					$output=array(
						"mode"=>201,
						"message"=>"validation error",
						"validate"=>array(
							"total"=>"入力頂いたアカウントではログインできません",
						),
					);
					echo JSON_ENC($output);
					return;


				}

			}
		}
	}
	//会員情報変更
	public function user_setting(){

		if($_POST){

			$post=array("User"=>$_POST);

			if(!$post["User"]["password"]){
				unset($this->User->validate["User"]["password"]);
				unset($post["User"]["password"]);
			}

			$juge=$this->User->validates($post);

			if($juge){

				$output=array(
					"mode"=>201,
					"message"=>"validation error",
					"validate"=>$juge["User"],
				);
				echo JSON_ENC($output);
				return;
			}
			else
			{

				try{

					$this->transam("begin",array(
						"User",
					));

					if(@$post["User"]["password"]){
						$post["User"]["password"]=$this->Auth->password($post["User"]["password"]);
					}

					$res=$this->User->save($post);

					if(!$res){
						$this->transam("rollback");
					}

					$this->transam("commit");

				}catch(Exception $e_){
					$this->transam("rollback");
				}

				if($post["User"]["user_icon_changed"]==1){
					@mkdir("Content");
					@mkdir("Content/usericon");
					copy($post["User"]["user_icon_path"],"Content/usericon/".$post["User"]["user_icon"]);
				}

				unset($res["User"]["create_date"]);
				unset($res["User"]["create_user_id"]);
				unset($res["User"]["refresh_date"]);
				unset($res["User"]["refresh_user_id"]);
				unset($res["User"]["password"]);

				$res["User"]["user_icon_path"]=$this->params["root"]."wdata/Content/usericon/".$res["User"]["user_icon"];

				$output=array(
					"mode"=>200,
					"Auth"=>$res["User"],
				);
				echo JSON_ENC($output);
				return;
			}
		}
	}
}
?>