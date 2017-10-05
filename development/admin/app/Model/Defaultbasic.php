<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	サイト基本設定モデル						*/
/*	DefaultBasic.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Defaultbasic extends AppModel {
	public $name="Defaultbasic";

	public $useTable=false;//DBテーブルとの関連を一旦なくす

	//バリデーション
	public $validate=array(
		'mail_host' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'メールホスト名が入力されていません。',
			),
		),
		'mail_address' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"送信用メールアドレスが入力されていません。",
			),
		),
		'mail_sendname' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"送信者名が入力されていません。",
			),
		),
		'mail_port' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"ポート番号が入力されていません。",
			),
		),
		'wwwurl' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"一般サイトドメインが入力されていません。",
			),
		),
		'adminurl' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"管理サイトドメインが入力されていません。",
			),
		),
		'itemurl' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"コンテンツ管理用ドメインが入力されていません。",
			),
		),
		'apiurl' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"専用APIドメインが入力されていません。",
			),
		),
		'mail_username' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"アカウントが入力されていません。",
			),
		),
		'mail_password' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"パスワードが入力されていません。",
			),
		),

	);

}
