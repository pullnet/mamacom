<?php

//phpのファイルをhtmlにするためのコンパイラ..(htmlフォルダーに入ります)

@mkdir("html");
@mkdir("html/css");
@mkdir("html/js");
@mkdir("html/images");
@mkdir("html/option");


$rooturl="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["REQUEST_URI"])."/";

//***.php -> ***.html

$filelist=glob("cording/*.php");

//print_r($_SERVER);

foreach($filelist as $f_){
	if($f_!="run.php"){
		$url="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["REQUEST_URI"])."/".$f_;

		$res=file_get_contents($url);

		$res=str_replace(".php",".html",$res);

		file_put_contents("html/".pathinfo($url,PATHINFO_FILENAME).".html",$res);
	}
}

//css setting
$csslist=glob("cording/css/*.css");

foreach($csslist as $c_){
	$url=$rooturl.$c_;
	$res=file_get_contents($url);

	file_put_contents("html/css/".basename($c_),$res);
}

//js setting
$jslist=glob("cording/js/*.js");

foreach($jslist as $j_){
	$url=$rooturl.$j_;
	$res=file_get_contents($url);

	file_put_contents("html/js/".basename($j_),$res);
}

//image setting
$imglist=glob("cording/images/*");

foreach($imglist as $i_){
	$url=$rooturl.$i_;
	copy($url,"html/images/".basename($i_));
}

//optioin data setting
$optlist=glob("cording/option/*");

foreach($optlist as $o_){
	$url=$rooturl.$o_;
	copy($url,"html/option/".basename($o_));
}

echo "コンパイル完了";
?>