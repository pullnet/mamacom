<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/03/02							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	入力エラー表示情報用モデル(master)				*/
/*	Inputerror.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Inputerror extends AppModel {

	public $useDbConfig="db_master";

	public $validate=array(
		"code"=>array(
			"a1"=>array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"適用コードが入力されていません。",
			),
		),
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"表示場所名が入力されていません。",
			),
		),
		"message"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"エラーメッセージ文が入力されていません。",
			),
		),
	);
}
