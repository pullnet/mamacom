<?php
$params=array(
	"name"=>"bbbb",
	"category"=>"AAAA",
	"title"=>"API名テキストテキストテキストbbbb",
	"endpoint"=>$this->params["root"]."a1/bbbb",
	"caption"=>"説明文テキストテキストテキストテキスト\nテキストテキストテキストテキストテキストテキスト",
	"method"=>"post",
	"encoding"=>"UTF-8",
	"autholity"=>"base64_encode({service_secret}:{lisence_key})",
	"output"=>"json",
	"testForm"=>array(
		"service_secret"=>"xxxxxxxxxxxxxxxxxx",
		"lisence_key"=>"xxxxxxxxxxxxxx",
	),
	"Request"=>array(
		
	),
	"Response"=>array(
		"aaa"=>array(
			"name"=>"出力名テキストaaa",
			"type"=>"text",
		),
		"bbb"=>array(
			"name"=>"出力名テキストbbb",
			"type"=>"text",
		),
	),
);
?>