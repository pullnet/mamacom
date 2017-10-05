<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/22							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	グループ管理用モデル						*/
/*	Group.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppModel', 'Model');

class Group extends AppModel {
	public $name="Group";

//	public $useTable=false;//テーブル使用しない

	public $validate=array(
		"name"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"グループ名が入力されていません。",
			),
		),
		"permalink"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"グループURLが入力されていません。",
			),
		),
		"leader_user_id"=>array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				"message"=>"リーダーとなるユーザーが選択されていません。",
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
