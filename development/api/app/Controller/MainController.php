<?php


App::uses('AppController', 'Controller');


class MainController extends AppController{

	public function index(){
		return json_encode(array(
			"error"=>"400 Bad Request",
		));
	}
}
?>