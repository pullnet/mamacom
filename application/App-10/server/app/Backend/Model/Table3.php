<?php
include_once(Router::url("Model")."AppModel.php");
class Table3 extends AppModel{

	public $validate=array(
		"Table3"=>array(
			"name"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"レコード名が入力されていません",
				),
			),
			"code"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"コードが入力されていません",
				),
				"a2"=>array(
					"rule"=>array("number"),
					"message"=>"コードは半角数字で入力してください",
				),
			),
		),
	);
}
?>