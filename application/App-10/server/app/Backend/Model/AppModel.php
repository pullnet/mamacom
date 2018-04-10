<?php

class AppModel extends Model{

	public $components=array(
		"Session",
	);

	public function beforeSave($data){
		$auth=$this->Session->read("aacceed5d8r9g8d4dfa6d5e9aa8hj8j");

		if(!@$data[$this->model]["id"]){
			$data[$this->model]["create_date"]=date("Y-m-d H:i:s");
			$data[$this->model]["create_user_id"]=@$auth["User"]["id"];
		}
		$data[$this->model]["refresh_date"]=date("Y-m-d H:i:s");
		$data[$this->model]["refresh_user_id"]=@$auth["User"]["id"];

		return $data;
	}
}
?>