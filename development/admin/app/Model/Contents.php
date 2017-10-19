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

class Contents extends AppModel {
	public $name="Content";

	//バリデーション
	public $validate=array(
		'title' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => 'タイトルが入力されていません。',
			),
		),
		'category_id' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "カテゴリーが設定されていません。",
			),
		),
		'district_id' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "地区が設定されていません。",
			),
		),
		"postnumber"=>array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"郵便番号が入力されていません。",
			),			
			"a2" => array(
				"rule"=>"Numeric",
				"required"=>true,
				"message"=>"郵便番号は半角数字で入力してください",
			),
		),
		'address1' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "都道府県が設定されていません。",
			),
		),		
		'address2' => array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "住所が入力されていません。",
			),
		),
		"tel"=>array(
			"a1" => array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"電話番号が入力されていません。",
			),			
			"a2" => array(
				"rule"=>"alphaNumeric",
				"required"=>true,
				"message"=>"電話番号は半角数字とハイフンで入力してください",
			),
		),
	);
}
