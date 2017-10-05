<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/16							*/
/*									*/
/*	Collabos_ver2.0(管理用)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ・ライブラリ共通情報モデル				*/
/*	Content.php							*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppModel', 'Model');

class Content extends AppModel {
	public $name="Content";

	//バリデーション
	public $validate=array(
		'title' => array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => 'タイトルが入力されていません。',
			),
		),
		'caption' => array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "概要文が入力されていません。",
			),
		),
		'contentscategory_id' => array(
			array(
				"rule"=>array("select_cc"),
				"required"=>true,
				'message' => "カテゴリーが未設定のままです。",
			),
		),
		'caption_short' => array(
			array(
				"rule"=>"notBlank",
				"required"=>true,
				'message' => "一覧画面用説明文が入力されていません。",
			),
			array(
				"rule"=>array("maxLength",250),
				"required"=>true,
				'message' => "説明文が長すぎます。(250文字以内でお願いします)",
			),
		),
		"permalink"=>array(
			array(
				"rule"=>array("check_shorturl_useenabled"),
				"required"=>true,
				'message' => "専用URLがすでに使用されています。別の候補を入力して下さい",
			),
		),
		'shorturl_status' => array(
			array(
				"rule"=>array("check_shorturl_status"),
				"required"=>true,
				'message' => "ショートURLを利用するには専用URLを指定する必要があります。",
			),
		),
		"thumbnail"=>array(
			array(
				"rule"=>array("check_thumbnail"),
				"required"=>true,
				'message' => "サムネイル情報が未設定です。",
			),
		),
	);


	//独自バリデーション
	//コンテンツカテゴリー判定用
	public function select_cc()
	{
		if($this->data["Content"]["contentscategory_id"])
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	//コラボ説明文判定用
	public function check_caption_collabo()
	{
		if($this->data["Content"]["status"]==1)
		{
			if($this->data["Content"]["caption_collabo"])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
	}
	public function check_shorturl_status()
	{
		if($this->data["Content"]["permalink"])
		{
			return true;
		}
		else
		{
			if($this->data["Content"]["shorturl_status"]==1)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}
	public function check_shorturl_useenabled()
	{

		if($this->data["Content"]["permalink"])
		{
			if($this->data["Content"]["shorturl_useenabled"])
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	public function check_thumbnail()
	{
		if($this->data["Additem"][0]["content"])
		{
			return true;
		}
		else
		{
			return false;
		}

	}

}
