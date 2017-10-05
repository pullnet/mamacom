<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	DBリスト設定用モデル						*/
/*	DblistModel.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Dblist extends AppModel {
	public $name="Dblist";

	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"名前が未入力です",
			),
		),
	);
}
