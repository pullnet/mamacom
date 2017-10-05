<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/21							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	仲間管理用モデル						*/
/*	Friend.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Friend extends AppModel {
	public $name="Friend";

//	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"from_user_id"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"申請ユーザーが選択されていません。",
			),
		),
		"to_user_id"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"受取ユーザーが選択されていません。",
			),
			array(
				"rule"=>array("check_userid"),
				"required"=>true,
				"message"=>"同じユーザーが選択されています。",
			),
		),
	);
	//ページURLが既に使用されていないかどうか
	public function check_userid(){
		if($this->data["Friend"]["from_user_id"]==$this->data["Friend"]["to_user_id"])
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
