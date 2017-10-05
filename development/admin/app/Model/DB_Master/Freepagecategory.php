<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/07							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	ページカテゴリー用モデル(master)				*/
/*	Freepagecategory.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Freepagecategory extends AppModel {

	public $useDbConfig="db_master";

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"カテゴリー名が設定されていません。",
			),
		),
		"permalink"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"カテゴリーURLが設定されていません。",
			),
		),
	);
}
