<?php
class _Doc_DatabaseReference extends Model{

	public $validate=array(
		"Database"=>array(
			"name"=>array(
				"a1"=>array(
					"rule"=>array("notBlank"),
					"message"=>"nothing database name",
				),
				"a2"=>array(
					"rule"=>array("numberSingle"),
					"message"=>"Please enter database name with half-width alphanumeric characters.",
				),
			),
		),
	);
}

?>