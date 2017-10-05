<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	管理アカウント(登録管理用)モデル(master)			*/
/*	Admin.php							*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Admin extends AppModel {

	public $useDbConfig="db_master";

	public $name="Admin";

	//バリデーション
	public $validate=array(
		'username' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'ユーザーネームが入力されていません。',
			),
		),
		'password_1' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"パスワードが入力されていません。",
			),
		),
		'password_2' => array(
			array(
				"rule"=>array("check_pw"),
				"required"=> true,
				"message"=>"入力したパスワードが確認用のと異なっています。",
			),

			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"パスワード(確認用)が入力されていません。",
			),
		),
		'name' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"管理者名が入力されていません。",
			),
		),
	);

	public function check_pw(){
		if($this->data["Admin"]["password_1"]==$this->data["Admin"]["password_2"])
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
