<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/20							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	LP用フリーページ管理用モデル(master)				*/
/*	Freepage.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Freepage extends AppModel {

	public $useDbConfig="db_master";

	public $name="Freepage";

	public $xss_omit=true;//XSS対策を外す

//	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"ページタイトルが未入力です",
			),
		),
		"permalink"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"ページURLが未入力です",
			),
			array(
				"rule"=>array("check_permalink"),
				"required"=>true,
				"message"=>"ページURLはすでに他のページで使用されています",
			),
		),
	);
	//ページURLが既に使用されていないかどうか
	public function check_permalink(){
		return true;
	}
}
