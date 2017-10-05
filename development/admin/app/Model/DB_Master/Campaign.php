<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/28							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	キャンペーン用モデル(master)					*/
/*	Campaign.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Campaign extends AppModel {
	public $useDbConfig="db_master";

	public $name="Campaign";

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"キャンペーン名がありません。",
			),
		),
	);
}
