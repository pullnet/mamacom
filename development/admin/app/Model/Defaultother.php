<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/08							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	サイトその他情報設定モデル					*/
/*	Defaultother.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Defaultother extends AppModel {
	public $name="Defaultother";

	public $useTable=false;//DBテーブルとの関連を一旦なくす

	//バリデーション
	public $validate=array(
		'pool_bank_name' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '銀行名が入力されていません。',
			),
		),
		'pool_bank_areaname' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '支店名が入力されていません。',
			),
		),
		'pool_bank_type' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '口座種別が入力されていません。',
			),
		),
		'pool_bank_number' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '口座番号が入力されていません。',
			),
		),
	);

}
