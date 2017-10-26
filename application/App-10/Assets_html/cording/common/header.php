<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style_type1.css">
<link rel="stylesheet" type="text/css" href="css/style_type2.css">
<link rel="stylesheet" type="text/css" href="css/style_typeapp.css">
<link rel="stylesheet" type="text/css" href="css/style_typeapp_responsive.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/option.js"></script>
<script type="text/javascript" src="js/api-sample.js"></script>
</head>
<body id="XXXXXXXXX">
<div class="body">
<input type="checkbox" id="alert-message" class="hidden">
<div class="alert-message">
	<p></p>
	<label for="alert-message" class="close">×</label>
</div>
<?php
if(!@$nohead){
?>
<header>
	<label for="side_menu" class="menu_btn">▼</label>
	<div class="title"><?php echo @$title; ?></div>
</header>
<div class="sidemenu">
	<input type="checkbox" id="side_menu" class="hidden">
	<label for="side_menu" class="bsj"></label>
	<div class="menu">
		<div class="m10">
			<div class="auth">
				<div class="user">
					<img src="" class="image image_usericon" auth-usericon>
					<h3 class="username" auth-username></h3>
				</div>
				<p><a href="index.php">TOPページ</a></p>
				<p><a href="uac_setting.php">会員情報変更</a></p>
				<p><label class="btn_logout">ログアウト</label></p>
			</div>
			<div class="no_auth">
				<p>まだログインしていないです....</p>
				<p><a href="index.php">TOPページ</a></p>
				<p><a href="login.php">ログイン</a></p>
				<p><a href="user_regist_step1.php" class="userregist_btn">新規会員登録</a></p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){

	var url_get_token="token/get_token";
	var token=JSession.read("token_"+API.authcode);
	if(token==null){
		$.ajax({
			url:API.domain+url_get_token,
			type:"post",
			data:{
				service_secret:API.service_secret,
				lisence_key:API.lisence_key
			},
			success:function(data){
				var result=JSON.parse(data);

				JSession.write("token_"+API.authcode,result.access_token);
			}
		});
	}
	var authdata=LSession.read("auth_"+API.authcode);

	var url_check_auth="v1a/check_auth";
	var url_logout="v1a/logout";

	if(authdata!=null){
		$(".auth").css("display","");
		$(".no_auth").css("display","none");

		$("*[auth-username]").text(authdata.username);
		$("*[auth-usericon]").text(authdata.user_icon_path);
		$("img[auth-usericon]").attr("src",authdata.user_icon_path);
		$("*[auth-mailaddress]").text(authdata.mailaddress);
	}
	else
	{
		$(".auth").css("display","none");
		$(".no_auth").css("display","");
	}

	//ログアウト
	$(".btn_logout").on("click",function(){

		$.ajax({
			url:API.domain+url_logout,
			type:"post",
			data:{
				access_token:JSession.read("token_"+API.authcode)
			},
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					LSession.delete("auth_"+API.authcode);
					location.href="login.php";
				}
			}
		});

	});

	//新規会員登録前処理(Sessionキャッシュの削除)
	$(".userregist_btn").on("click",function(){
		var href=$(this).attr("href");

		JSession.delete("post_cash");

		location.href=href;
		return false;
	});

});
</script>
<div class="hdmy"></div>
<?php
}
?>
