<?php
class _Oven_Controller extends Model{

	public $validate=array(
		"Controller"=>array(
			"name"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"Controller name has not been entered.",
				),
				"a2"=>array(
					"rule"=>array("numberSingle"),
					"message"=>"Please enter Controller name with half-width alphanumeric characters.",
				),
			),
			"inheritance_controller"=>array(
				"a1"=>array(
					"rule"=>array("numberSingle"),
					"message"=>"Please enter inheritance controller name with half-width alphanumeric characters.",
				),
			),
			"uses"=>array(
				"a1"=>array(
					"rule"=>array("numberSingle"),
					"message"=>"Please enter uses list with half-width alphanumeric characters.",
				),
			),
			"components"=>array(
				"a1"=>array(
					"rule"=>array("numberSingle"),
					"message"=>"Please enter components list with half-width alphanumeric characters.",
				),
			),
		),
	);

}
?>