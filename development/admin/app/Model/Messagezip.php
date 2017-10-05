<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/04/08							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	メッセージフィールド用モデル					*/
/*	Messagefield.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Messagezip extends AppModel {
	public $name="Messagezip";

//	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"data_tag"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"添付データがありません。",
			),
		),
	);
}
