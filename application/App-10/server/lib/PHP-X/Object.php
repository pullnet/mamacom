<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	object
//	object.php
//
//--------------------------------------------------
class Object{

	public function __construct($data){
		$this->params=$data->params;
		$this->request=new request();
		$this->request=$data->request;
		$this->database=$data->database;
	}
	public function o__refresh($data){
		$this->params=$data->params;
		$this->request=new request();
		$this->request=$data->request;
		$this->database=$data->database;

	}
}
class request{
	public $post;
	public $get;
}