<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/16							*/
/*									*/
/*	Collabos_ver2.0(管理用)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ・ライブラリ共通情報モデル				*/
/*	Contents.php							*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Contact extends AppModel {
	public $name="Contact";
	public $useTable=false;
	
	//バリデーション
	public $validate=array(
	
		'post_mail' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => 'メールアドレスが入力されていません。',
			),
			"a2"=>array(
				"rule"=>"email",
				"message"=>"メールアドレスを入力して下さい。",
			),
		),
		'post_name1' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "お名前が入力されていません",
			),
		),
		'post_name2' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "お名前が入力されていません",
			),
		),
		"post_text"=>array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"お問い合わせ内容が入力されていません。",
			),
		),
		'post_subject' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "件名が設定されていません。",
			),
		),
	);
}
