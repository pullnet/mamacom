<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	メールテンプレート用モデル(master)				*/
/*	Mailtemplate.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Mailtemplate extends AppModel {

	public $useDbConfig="db_master";

	public $name="Mailtemplate";

	//バリデーション
	public $validate=array(
		'name' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'テンプレート名が入力されていません。',
			),
		),
	);

}
