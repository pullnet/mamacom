<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	メールフォーマット(定型文)用モデル(master)			*/
/*	Mailformat.php							*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Mailformat extends AppModel {

	public $useDbConfig="db_master";

	public $name="Mailformat";

	//バリデーション
	public $validate=array(
		'name' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'フォーマット名が入力されていません。',
			),
		),
		'code' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'フォーマットコードが入力されていません。',
			),
		),

		'subject' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"メール件名が入力されていません。",
			),
		),
		'message' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				"message"=>"メール本文が入力されていません。",
			),
		),
	);

}
