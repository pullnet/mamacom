<?php
class _Oven_Component extends Model{

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