<?php
$title="新規会員登録(確認画面)";
include("common/header.php"); ?>
<div class="body">
	<div class="absolute_area">
		<div class="tr">
			<div class="t_cell">
				<div class="m10">
					<p class="mb20">下記の内容で会員登録します。よろしいですか？</p>
					<dl class="form userregist_area">
						<dt>メールアドレス</dt>
						<dd user-mailaddress></dd>
						<dt>ご希望のユーザー名</dt>
						<dd user-username></dd>
						<dt>ご希望のパスワード</dt>
						<dd>****</dd>
						<dt>アイコン画像</dt>
						<dd>
							<div class="mb10">
								<div class="image_w70">
									<img src="images/sample.png" class="image image_icon">
								</div>
							</div>
						</dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="tr h50 controls">
			<div class="t_cell middle">
				<div class="m5">
					<ul class="float">
						<li><a href="user_regist_step1.php" class="buttons">戻る</a></li>
						<li class="f_right"><label class="buttons submit_btn">会員登録する</label></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){

	//URL list

//	var get_userregist_cash="v1/get_userregist_cash"
	var url_submit="v1a/user_regist_pre2";
	var url_redirect="user_regist_pre_complete.php";

	var post_cash=JSession.read("post_cash");

	if(post_cash!=null){
		$(".userregist_area .image_icon").attr("src",post_cash.user_icon_path);

		$(".userregist_area *[user-mailaddress]").text(post_cash.mailaddress);
		$(".userregist_area *[user-username]").text(post_cash.username);
	}
	else
	{
		history.back();
	}

	//SUBMIT...
	$(".submit_btn").on("click",function(){

		var postdata=post_cash;
		postdata.access_token=JSession.read("token_"+API.authcode);

		$.ajax({
			url:API.domain+url_submit,
			type:"post",
			data:postdata,
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					JSession.delete("post_cash");
					location.href=url_redirect;
				}
			}
		});
	});

});
</script>
<?php include("common/footer.php"); ?>
