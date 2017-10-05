<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	サイト公開情報設定モデル					*/
/*	Defaultopeninfo.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Defaultopeninfo extends AppModel {
	public $name="Defaultbasic";

	public $useTable=false;//DBテーブルとの関連を一旦なくす

	//バリデーション
	public $validate=array(
		'company_name' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '運営会社名が入力されていません。',
			),
		),
		'company_owner' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '店舗運営責任者情報が入力されていません。',
			),
		),
		'security_owner' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '店舗セキュリティ責任者が入力されていません。',
			),
		),
		'capital' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '資本金が入力されていません。',
			),
		),
		'postnumber' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '郵便番号が入力されていません。',
			),
		),
		'address1' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '市区町村が入力されていません。',
			),
		),
		'address2' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '丁目番地が入力されていません。',
			),
		),
		'tel' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'お問い合わせTELが入力されていません。',
			),
		),
		'fax' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => 'お問い合わせFAXが入力されていません。',
			),
		),
		'shopemail' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '連絡先メールアドレスが入力されていません。',
			),
		),
		'url' => array(
			array(
				"rule"=>"notBlank",
				"required"=> true,
				'message' => '運営会社HPが入力されていません。',
			),
		),
	);

}
