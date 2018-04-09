<?php
include_once(Router::url("Model")."AppModel.php");
class Table1 extends AppModel{

	public $validate=array(
		"Table1"=>array(
			"name"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"required"=>true,
					"message"=>"お名前が入力されていません",
				),
			),
			"colum_a1"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"required"=>true,
					"message"=>"項目名AAAが入力されていません",
				),
				"a2"=>array(
					"rule"=>array("numberSingle"),
					"required"=>true,
					"message"=>"項目名AAAは半角英数字で入力してください",
				),
			),
		),
	);
}
?>