<?php
include_once(Router::url("Model")."AppModel.php");
class User extends AppModel{

	public $validate=array(
		"User"=>array(
			"username"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"ユーザー名が入力されていません",
				),
				"a2"=>array(
					"rule"=>array("numberSingle"),
					"message"=>"ユーザー名は半角英数字で入力してください",
				),
			),
			"password"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"パスワードが入力されていません",
				),
				"a2"=>array(
					"rule"=>array("numberSingle"),
					"message"=>"パスワードは半角英数字で入力してください",
				),
			),
		),
	);
}
?>