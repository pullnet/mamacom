<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/30							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	注文ステータス設定用モデル(master)				*/
/*	OrderstatuslistModel.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Orderstatuslist extends AppModel {
	public $useDbConfig="db_master";

	public $name="Orderstatuslist";

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"ステータス名が未入力です",
			),
		),
		"code"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"ステータスコードが未入力です",
			),
		),
	);
}
