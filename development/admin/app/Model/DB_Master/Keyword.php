<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/13							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	検索キーワード管理用モデル(master)				*/
/*	keyword.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Keyword extends AppModel {

	public $useDbConfig="db_master";

	public $name="Keyword";

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"キーワード名が入力されていません。",
			),
		),
	);
}
