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
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/option.js"></script>
<script type="text/javascript" src="js/api-sample.js"></script>

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
				<!--js処理-->
				</div>
		</div><!--//.window-->
	</div>
	<div class="header_dmy"></div>
<?php
}
?>

<script type="text/javascript">
$(function(){

	var url_get_token="token/get_token";
	var token=JSession.read("token");
	
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
				JSession.write("token",result.access_token);

			}
		});
	}
});
</script>


<script type="text/javascript">
$(function(){
	
	//地区の処理
	var url_method="category/ditrict_list";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token
			},
			success:function(data){
				var result=JSON.parse(data);
				
				var ditrict_count = Object.keys(result).length;
				for(var i = 0; i < ditrict_count; i++){
					
					$(".contents_source2 a").text(result[i].name);
					$(".contents_source2 *[content_link]").attr("href",$(".contents_source2 *[content_link]").attr("hrefs")+"?id="+result[i].id);
					
					//書き換え処理
					$('.area_list').append($(".contents_source2").html());
				}

			}
		});
	}
	else{
		view_error_page();
	}	

});
</script>

	<div class="contents_source2" style="display:none">
		<p><a hrefs="area.php" content_link></a></p>
	</div><!--//.contents_source-->	