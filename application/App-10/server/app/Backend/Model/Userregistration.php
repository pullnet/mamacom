<?php
include_once(Router::url("Model")."AppModel.php");
class Userregistration extends AppModel{


	public $validate=array(
		"Userregistration"=>array(
			"code"=>array(
				"a3"=>array(
					"rule"=>array("check_code"),
					"message"=>"仮登録コードは間違っているか、またはコードが入力されていません",
				),
			),
		),
	);
	public function check_code(){
		if(@$this->data["Userregistration"]["jugement"]){
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>