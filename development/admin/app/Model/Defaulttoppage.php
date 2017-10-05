<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/10							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	サイトトップページ用モデル					*/
/*	Defaulttoppage.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Defaulttoppage extends AppModel {
	public $name="Defaulttoppage";

	public $useTable=false;//DBテーブルとの関連を一旦なくす

	//バリデーション
	public $validate=array(
		
	);

}
