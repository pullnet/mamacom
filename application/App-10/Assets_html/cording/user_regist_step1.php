<?php
$title="新規会員登録";
include("common/header.php"); ?>
<div class="body">
	<form class="submit_form">
		<input type="hidden" name="service_secret">
		<input type="hidden" name="lisence_key">
		<div class="absolute_area">
			<div class="tr">
				<div class="t_cell">
					<div class="m10">
						<dl class="form">
							<dt class="need">メールアドレス</dt>
							<dd>
								<input type="text" name="mailaddress">
								<div class="error-message" name="mailaddress"></div>
							</dd>
							<dt class="need">ご希望のユーザー名</dt>
							<dd>
								<input type="text" name="username" placeholder="username....">
								<div class="error-message" name="username"></div>
							</dd>
							<dt class="need">ご希望のパスワード</dt>
							<dd>
								<input type="password" name="password">
								<div class="error-message" name="password"></div>
							</dd>
							<dt>アイコン画像</dt>
							<dd>
								<div class="mb10">
									<div class="image_w70">
										<img src="images/sample.png" class="image image_output_view">
									</div>
								</div>
								<input type="hidden" name="user_icon" class="image_output_input">
								<input type="hidden" name="user_icon_path" class="image_output_path">
								<input type="hidden" name="user_icon_changed" class="image_output_changed">
								<label for="edit_image" class="buttons new">アイコン画像を選択</label>
							</dd>
						</dl>
						<div class="error-message total"></div>
					</div>
				</div>
			</div>
			<div class="tr h50 controls">
				<div class="t_cell middle">
					<div class="m5">
						<ul class="float">
							<li><a href="index.php" class="buttons">戻る</a></li>
							<li class="f_right"><input type="submit" value="確認画面へ" class="buttons submit_btn"></li>
						</ul>
					</div>
				</div>


			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	
	//URL list
	var url_submit="v1a/user_regist_pre";
	var url_redirect="user_regist_step2.php";

	var post_cash=JSession.read("post_cash");

	if(post_cash!=null){
		$(".submit_form .image_output_view").attr("src",post_cash.user_icon_path);
		$(".submit_form input[name=mailaddress]").val(post_cash.mailaddress);
		$(".submit_form input[name=username]").val(post_cash.username);
		$(".submit_form input[name=user_icon]").val(post_cash.user_icon);
		$(".submit_form input[name=user_icon_path]").val(post_cash.user_icon_path);
		$(".submit_form input[name=user_icon_changed]").val(post_cash.user_changed);
	}

	//SUBMIT...

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
					JSession.write("post_cash",result.cash);
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
<?php include("part/edit_image.php"); ?>
<?php include("common/footer.php"); ?>
