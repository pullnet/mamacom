<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	管理アカウント(ログイン時)モデル				*/
/*	Adminlogin.php							*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Adminlogin extends AppModel {
	public $name="Adminlogin";

	public $useTable=false;//テーブルとの関連を無くす

	//バリデーション
	public $validate=array(
		'username' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'ユーザーネームが入力されていません。',
			),
		),
		'password' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"パスワードが入力されていません。",
			),
		),
	);
}
