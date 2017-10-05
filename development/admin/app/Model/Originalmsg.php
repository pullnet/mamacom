<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2017/01/06							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボス運営メッセージ用モデル					*/
/*	Originamsg.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Originalmsg extends AppModel {
	public $name="Originalmsg";
	public $useTable=false;

	public $validate=array(
		"message"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"メッセージが入力されていません。",
			),
		),
	);
}
