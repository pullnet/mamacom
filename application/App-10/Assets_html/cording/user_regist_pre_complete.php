<?php
$title="会員仮登録完了";
include("common/header.php"); ?>
<div class="body">
	<form class="submit_form">
		<input type="hidden" name="service_secret">
		<input type="hidden" name="lisence_key">
		<div class="absolute_area">
			<div class="tr">
				<div class="t_cell">
					<div class="m10">
						<p class="mb20 h3">仮登録が完了しました。<br>
						次に、仮登録コードを入力してください</p>

						<input type="text" name="code" class="large" placeholder="ここに入れてください">
						<div class="error-message" name="code"></div>
						
						<p class="mt20">入力したら「本登録する」ボタンを押して本登録に進みます</p>

					</div>
				</div>
			</div>
			<div class="tr h50">
				<div class="t_cell middle">
					<div class="m5">
						<input type="submit" value="本登録する" class="buttons add submit_btn">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(function(){

	//URL list..
	var url_submit="v1a/user_registration";
	var url_redirect="user_regist_complete.php";

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
					//go next
					LSession.write("auth_"+API.authcode,result.auth);
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

});
</script>
<?php include("common/footer.php"); ?>

