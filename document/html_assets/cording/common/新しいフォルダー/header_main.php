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
	<div class="header">
		<h1 class="logo">
			<a href="index.php"><img src="images/main_logo.png"></a>
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
		<div class="window">
			<div class="bs">
				<div class="userdata">
					<img src="images/toppage/sample13.jpg">
					Username_aaa さん
				</div>
				<hr>
				<p><a href="mypage.php">マイページ</a></p>
				<?php
				/*
				<p><a href="uacsetting_basic.php">ユーザー設定</a></p>
				*/
				?>
				<p class="float"><a href="message_list.php">メッセージ<span class="f_right">00</span></a></p>
				<p class="float"><a href="receive_list.php">受注一覧<span class="f_right">00</span></a></p>
				<p class="float"><a href="ordering_list.php">発注一覧<span class="f_right">00</span></a></p>
				<?php
				/*
				<p class="float"><a href="collaboparty_list.php">コラボ参加表明者一覧<span class="f_right">00</span></a></p>
				<p><a href="collaboparting_list.php">参加表明したコラボ一覧</a></p>
				*/
				?>

				<p><a href="login.php">ログアウト</a></p>
				<p><a href="member_list.php">メンバーを探す</a></p>
				<p><a href="tutorial.php">ご利用ガイド</a></p>
				<p><a href="tutorial.php">お問い合わせ</a></p>
			</div>
		</div><!--//.window-->
	</div>
	<div class="header_dmy"></div>