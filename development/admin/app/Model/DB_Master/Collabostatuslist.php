<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/04/01							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ参加ステータス設定用モデル(master)			*/
/*	CollabostatuslistModel.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Collabostatuslist extends AppModel {

	public $useDbConfig="db_master";

	public $name="Collabostatuslist";

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"ステータス名が未入力です",
			),
		),
	);
}
