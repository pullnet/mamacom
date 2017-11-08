<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/13
//
//	HighlightHelper
//	HighlightHelper.php
//
//--------------------------------------------------

class HighlightHelper extends Helper{

	public $color=array(
		"background"=>"#222",
		"string"=>"#fff",
		"comment"=>"#1c8",
		"keyword"=>"#f2777a",
		"default"=>"#fb8",
		"html"=>"#9cf",
	);

	public function __construct(){
		ini_set("highlight.string",$this->color["string"]);
		ini_set("highlight.comment",$this->color["comment"]);
		ini_set("highlight.keyword",$this->color["keyword"]);
		ini_set("highlight.default",$this->color["default"]);
		ini_set("highlight.html",$this->color["html"]);
	}
	public function set_color($array){

		foreach($array as $key=>$a_){
			ini_set("highlight.".$key,$a_);
		}
	}
	public function view($string,$option=array()){

		$option_str="";
		foreach($option as $key=>$o_){
		
			$option_str.=" ".$key.'="'.$o_.'"';
		}
		return '<div '.$option_str.'>'.highlight_string($string,true)."</div>";
	}
	public function file($file,$option=array()){
		$option_str="";
		foreach($option as $key=>$o_){
		
			$option_str.=" ".$key.'="'.$o_.'"';
		}
		return '<div '.$option_str.'>'.highlight_file("../wdata/highlight/".$file,true)."</div>";
	}
}