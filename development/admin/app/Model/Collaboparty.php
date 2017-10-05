<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ参加表明情報						*/
/*	Collaboparty.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Collaboparty extends AppModel {

//	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"hope_price"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"希望予算が未入力です",
			),
			array(
				"rule"=>"alphaNumeric",
				"required"=>true,
				"message"=>"希望予算は半角数字で入力してください",
			),
		),
	);
}
