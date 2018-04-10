<?php
include_once(Router::url("Model")."AppModel.php");
class Table2 extends AppModel{

	public $validate=array(
		"Table2"=>array(
			"name"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"レコード名が入力されていません",
				),
			),
			"colum_a"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"項目名AAAAが入力されていません",
				),
				"a2"=>array(
					"rule"=>array("number"),
					"message"=>"項目名AAAAは半角数字で入力してください",
				),
			),
			"thumbnail"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"サムネイル画像がありませんので、設定してください",
				),
			),
		),
	);
}
?>