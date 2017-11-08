<?php
$title="会員情報の変更";
include("common/header.php"); ?>
<div class="body">
	<form class="submit_form">
		<input type="hidden" name="id">
		<div class="absolute_area">
			<div class="tr">
				<div class="t_cell">
					<div class="m10">
						<dl class="form">
							<dt class="need">メールアドレス</dt>
							<dd>
								<input type="text" name="mailaddress">
								<div class="error-message" name="mailaddress">
							</dd>
							<dt class="need">ユーザー名</dt>
							<dd>
								<input type="text" name="username">
								<div class="error-message" name="username">
							</dd>
							<dt>パスワード</dt>
							<dd>
								<p>※変更するときだけ入力してください</p>
								<input type="password" name="password">
								<div class="error-message" name="password">
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
				<div class="t_cell">
					<ul class="float m5">
						<li class="f_right"><input type="submit" value="変更する" class="buttons submit_btn"></li>
					</ul>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(function(){

	//URL LIST...
	var url_submit="v1a/user_setting";
	var url_redirect="uac_setting.php";
	var authbuff=LSession.read("auth_"+API.authcode);

	$(".submit_form input[name=id]").val(authbuff.id);
	$(".submit_form input[name=username]").val(authbuff.username);
	$(".submit_form input[name=mailaddress]").val(authbuff.mailaddress);
	$(".submit_form input[name=user_icon]").val(authbuff.user_icon);
	$(".submit_form input[name=user_icon_path]").val(authbuff.user_icon_path);
	$(".submit_form .image_output_view").attr("src",authbuff.user_icon_path);

	// SUBMIT...
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
					JSession.write("alert","会員情報を更新しました");
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
<?php include("part/edit_image.php"); ?>