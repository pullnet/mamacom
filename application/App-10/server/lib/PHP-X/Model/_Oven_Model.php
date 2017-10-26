<?php
class _Oven_Model extends Model{

	public $validate=array(
		"Controller"=>array(
			"name"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"Nothing Controller name.",
				),
			),

		),
	);

}
?>