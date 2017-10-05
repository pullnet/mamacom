<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	ライブラリ受注設定用モデル					*/
/*	Libraryorderset.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Libraryorderset extends AppModel {
	public $name="Libraryorderset";

//	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"title"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"受注タイトルが未入力です",
			),
		),
		"contentscategory_id"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"コンテンツカテゴリーが未入力です",
			),
		),
		"price_min"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"販売価格の最少額が未入力です",
			),
		),
	);
}
