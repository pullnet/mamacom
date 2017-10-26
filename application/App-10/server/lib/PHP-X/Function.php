<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	Function
//	Function.php
//
//--------------------------------------------------

$glob_buffer=array();

//debug
function debug($array){

	$e = new Exception;
	$arys = $e->getTrace();
	echo '<div class="error-block">';
	print_r('<p style="font-weight:bold;">Debug : '.$arys[0]["file"]."(line ".$arys[0]["line"].")</p>");
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	echo "</div>";

}
//html sanitise
function h($string,$mode="html"){
	if($mode=="html"){
		return htmlspecialchars($string);
	}
	else if($mode=="php"){
		
		$sanitize_code=array(
			"<?"=>"&lt;?",
			"?>"=>"?&gt;",
		);

		foreach($sanitize_code as $key=>$s_){
			$string=str_replace($key,$s_,$string);
		}

		return $string;
	}
	else if($mode=="script"){

		$sanitize_code=array(
			"<script"=>"&lt;script",
			"</script>"=>"<//script&gt;",
		);

		foreach($sanitize_code as $key=>$s_){
			$string=str_replace($key,$s_,$string);
		}

		return $string;
	}
}
//phpx_date(A.D 2038 after enable)
function phpx_date($output=null,$input=null,$modify=null){
	global $timezone;

	if($input){
		$date=new DateTime("@".$input);
	}
	else
	{
		$date=new DateTime();
	}

	$date->setTimezone(new DateTimeZone(@$timezone));

	if($modify){
		$date->modify($modify);
	}

	if($output){
		return $date->format($output);
	}
	else
	{
		return $date->format("Y-m-d H:i:s");
	}
}
//phpx_strtotime(A.D 2038 after enable)
function phpx_strtotime($input=null){
	global $timezone;
	
	if($input){
		try{
			$date=new DateTime($input);
		}
		catch(Exception $e_){
			return null;
		}
	}
	else
	{
		$date=new DateTime();
	}

	$date->setTimezone(new DateTimeZone(@$timezone));

	$strtotime=$date->format("U");
	return $strtotime;
}
//phone number
function number_phone($string,$devicetype="normal"){
	if($devicetype=="normal"){
		$phone_view=substr($string,0,3)."-".substr($string,3,4)."-".substr($string,7);
	}
	else if($devicetype="freedial"){
		$phone_view=substr($string,0,2)."-".substr($string,2,4)."-".substr($string,6);
	}
	return $phone_view;
}
//postnumber
function number_post($string,$language="jp"){
	if($language=="jp"){
		$post_view="〒".substr($string,0,3)."-".substr($string,3);
	}
	else
	{

	}
	return $post_view;
}
//deep directory search
function glob_deep($path,$filter=null){
	global $glob_buffer;
	$glob_buffer=array();

	return _glob_deep($path,null,$filter);
}
function _glob_deep($path,$before=array(),$filter=null){
	global $glob_buffer;

	if(@$filter!="file"){
		$glob_buffer[]=$path;
	}

	$dir=glob($path."/*");
	foreach($dir as $key=>$d_){
		if($d_){
			if(is_dir($d_)){
				$buff=_glob_deep($d_,$glob_buffer,$filter);
			}
			else
			{
				if(@$filter!="directory"){
					$glob_buffer[]=$d_;
				}
			}
		}
	}

	rsort($glob_buffer);
	return $glob_buffer;
}
//2017 original json_encode
function JSON_ENC($params,$mode=true){

	if($mode){
		return json_encode($params,JSON_UNESCAPED_UNICODE);
	}
	else
	{
		return json_encode($params);
	}
}
//2017 original json_decode
function JSON_DEC($params,$mode=true){

	if($mode){
		return json_decode($params,true);
	}
	else
	{
		return json_decode($params);
	}

}
//search
function search($buff,$first,$last){

	$output=array();
	for($s1=0;$s1<10000;$s1++){
		$start_int=strpos($buff,$first);
		$exit_int=strpos($buff,$last)-$start_int+strlen($last);

		$get_buff=substr($buff,$start_int,$exit_int);

		if($start_int){
			$output[$get_buff]=$get_buff;

		}
		else
		{
			break;
		}
		$buff=substr($buff,$start_int+$exit_int);
	}
	return $output;
}
//Router
class Router{
	public function url($name){
		if($name=="data"){
			return "../wdata/";
		}
		else if($name=="url"){
			return $params["url"];
		}
		else if($name=="Controller"){
			return "../app/Backend/Controller/";
		}
		else if($name=="Component"){
			return "../app/Backend/Component/";
		}
		else if($name=="Model"){
			return "../app/Backend/Model/";
		}
		else if($name="lib/Controller"){
			return "../lib/PHP-X/Controller/";
		}
		else if($name="lib/wdata"){
			return "../lib/PHP-X/wdata/";
		}
	}
}

?>