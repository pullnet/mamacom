<?php
$nohead=true;
include("common/header.php"); ?>

<style>
#XXXXXXXXX .login{
	border:solid 1px #ccc;
	margin:0px 30px;
	padding:20px;
}
#XXXXXXXXX .login dl dt{
	margin-bottom:5px;
	font-weight:bold;
}
#XXXXXXXXX .login dl dd{
	margin-bottom:10px;
}
</style>
<div class="absolute_area">
	<div class="tr">
		<div class="t_cell middle">
			<div class="login">
				<h1 class="center mb20">LOGIN</h1>
				<form class="submit_form">
					<div class="error-message" name="total"></div>
					<dl>
						<dt>ユーザー名</dt>
						<dd>
							<input type="text" name="username" placeholder="username...">
							<div class="error-message" name="username"></div>
						</dd>
						<dt>パスワード</dt>
						<dd>
							<input type="password" name="password">
							<div class="error-message" name="password"></div>
						</dd>
					</dl>

					<input type="submit" value="ログイン" class="buttons preview submit_btn">
				</form>
				<div class="center mt10">
					<a href="user_regist_step1.php" class="underline regist_btn">会員登録する</a>
				</div>
			</div>
		</div>
	</div>
	<div class="tr h50">
		<div class="t_cell middle">
			<div class="center">
				<a href="index.php" class="underline">TOPへ</a>
			</div>
		</div>

	</div>

</div>
<script type="text/javascript">
$(function(){
	//URL list..
	var url_submit="v1a/user_login";
	var url_redirect="index.php";

	$(".submit_btn").on("click",function(){

		$(".error-message").removeClass("active").text("");

		var post=$(".submit_form").Formdat();
		post.access_token=JSession.read("token_"+API.authcode);

		$.ajax({
			url:API.domain+url_submit,
			type:"post",
			data:post,
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					LSession.write("auth_"+API.authcode,result.Auth);
					location.href=url_redirect;
				}
				else{
					if(result.validate){
						var colums=Object.keys(result.validate);
						for(var us=0;us<colums.length;us++){
							$(".error-message[name="+colums[us]+"]").addClass("active").text(result.validate[colums[us]]);
						}
						$(".error-message.total").addClass("active").text("入力に誤りがあります。再度ご確認ください");
					}
				}
			}
		});

		return false;

	});

	//新規会員登録前処理(Sessionキャッシュの削除)
	$(".regist_btn").on("click",function(){
		var href=$(this).attr("href");

		JSession.delete("post_cash");

		location.href=href;
		return false;
	});
});
</script>
<?php include("common/footer.php"); ?>