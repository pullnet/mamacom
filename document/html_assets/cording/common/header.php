<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style_type1.css">
<link rel="stylesheet" type="text/css" href="css/style_type2.css">
<link rel="stylesheet" type="text/css" href="css/style_csmp.css">
<script type="text/javascript">
	//iphone用css
	var wnu=window.navigator.userAgent;
	if(wnu.indexOf("iPhone")>0)
	{
		document.write('<link rel="stylesheet" type="text/css" href="css/style_iphone.css">');
	}
</script>
<link rel="stylesheet" type="text/css" href="css/style_csmp_sideways.css">
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1.0">
<!--<meta name="viewport" content="width=640px,maximum-scale=1,user-scalable=0">-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/default_m.js"></script>
</head>
<body>
<?php
if(!@$nohead){
?>
	<div class="header">
		<h1 class="logo">
			<a href="index.php"><img src="images/header_logo.png"></a>
            <!--<p><?php/* echo $title;*/ ?></p>-->
		</h1>
		<div class="menubtn">
			<label for="header_menu" class="btn">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<div class="header_menu">
		<input type="checkbox" id="header_menu" style="display:none">
		<label for="header_menu" class="bsj"></label>
		<div class="window">
			<div class="bs">
				<div class="userdata">
					<span class="user_icon"><img src="images/sidemenu_usericon.jpg"></span>
					<span class="user_name">Username_aaa さん<br><a href="setting.php">設定</a><span>
				</div>
				<p><a href="index.php"><img src="images/sidemenu_01.jpg" alt="ホーム"></a></p>
				<p><a href="category_01.php"><img src="images/sidemenu_02.jpg" alt="緊急・お役立ち"></a></p>
				<p><a href="info.php"><img src="images/sidemenu_03.jpg" alt="お知らせ"></a></p>
				<p><a href="contact.php"><img src="images/sidemenu_04.jpg" alt="お問い合わせ"></a></p>
				<p class="httl">地域情報</p>
				<div class="area_list">
					<p><a href="area.php">都島区<?php /* <img src="images/sidemenu_11.jpg" alt="都島区">*/ ?></a></p>
					<p><a href="area.php">城東区<?php /* <img src="images/sidemenu_12.jpg" alt="城東区">*/ ?></a></p>
					<p><a href="area.php">北区<?php /* <img src="images/sidemenu_13.jpg" alt="北区">*/ ?></a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
					<p><a href="area.php">○○○区</a></p>
			</div>
		</div><!--//.window-->
	</div>
	<div class="header_dmy"></div>
<?php
}
?>