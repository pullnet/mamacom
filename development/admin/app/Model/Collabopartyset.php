<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ参加設定用モデル						*/
/*	Collabopartyset.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Collabopartyset extends AppModel {
	public $name="Collabopartyset";

//	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"title"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"参加タイトルが未入力です",
			),
		),
		"contentscategory_id"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"コンテンツカテゴリーが未入力です",
			),
		),

		"min_price"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"予算(報酬額)の最小価格が未入力です",
			),
		),
	);
}
