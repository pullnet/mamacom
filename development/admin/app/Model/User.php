<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/09							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://www.collabos.jp						*/
/*									*/
/*	会員情報(基本)用モデル						*/
/*	User.php							*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class User extends AppModel {
	public $name="User";

	//バリデーション
	public $validate=array(
		'mailaddress' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '希望メールアドレスが入力されていません。',
			),
		),
		'username' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '希望ユーザー名が入力されていません。',
			),
		),
		'password_2' => array(
			array(
				"rule"=>array("pw_check"),
				"required"=> false,
				"message"=>"パスワードは確認用と同じものを入力してください。",
			),
		),
		"nickname"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"ニックネームが入力されていません",
			),
		),
/*
		"icontag"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"アイコン画像が設定されていません。",
			),
		),
		"postnumber"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"郵便番号が入力されていません。",
			),
		),
		"address1"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"市区町村が入力されていません。",
			),
		),
		"address2"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"丁目番地が入力されていません。",
			),
		),
*/
	);

	//独自バリデーション
	
	//★ユーザーネームが既に使用されていないかどうか
	public function username_avaliable()
	{
		if($this->data["User"]["username_checked"]==1){
			return true;
		}
		else{
			return false;
		}
	}
	//★パスワード入力時チェック
	public function pw_check()
	{
		if($this->data["User"]["password_1"])
		{

			if($this->data["User"]["password_1"]==$this->data["User"]["password_2"])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}

	}
	//★パスワード入力時チェック
	public function pw_check_1()
	{
		if($this->data["User"]["password_1"] || $this->data["User"]["password_2"])
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	//★ニックネームが既に使用されていないかどうか
	public function nickname_avaliable()
	{
		$result=$this->find("count",array(
			"conditions"=>array("User.nickname"=>$this->data["User"]["nickname"]),
		));

		if($result==0){
			return true;
		}
		else{
			return false;
		}
	}

}
