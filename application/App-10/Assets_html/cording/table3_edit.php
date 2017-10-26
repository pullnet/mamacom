<?php
$title="Table3の登録・編集.";
include("common/header.php");
?>
<div class="body">
	<form class="submit_form">
		<input type="hidden" name="id">
		<div class="absolute_area">
			<div class="tr">
				<div class="t_cell">
					<div class="m10">
						<dl class="form">
							<dt class="need">レコード名</dt>
							<dd>
								<input type="text" name="name">
								<div class="error-message" name="name"></div>
							</dd>
							<dt class="need">コード</dt>
							<dd>
								<div class="right">
									<input type="text" name="code" class="w150">
								</div>
								<div class="error-message" name="code"></div>
							</dd>
							<dt>備考欄</dt>
							<dd>
								<textarea type="text" name="caption" class="h300"></textarea>
							</dd>
						</dl>
						<div class="error-message total"></div>
					</div>
				</div>
			</div>
			<div class="tr h50 controls">
				<div class="t_cell">
					<ul class="float m5">
						<li><a href="table3_list.php" class="buttons">戻る</a></li>
						<li class="f_right"><input type="submit" value="確認画面へ" class="buttons submit_btn"></li>
					</ul>
				</div>
			</div>
		</div>
	</form>
</div><!--//.body-->
<script type="text/javascript">
$(function(){

	//URL LIST...
	var url_get_table3="v2/get_table3";

	var url_submit="v2/edit_table3_pre";
	var url_redirect="table3_confirm.php";

	//table3 cash check...
	var post_cash=JSession.read("post_cash");

	var get=Params.get();
	if(get!=null){
		if(get["id"]){

			var post={
				access_token:JSession.read("token_"+API.authcode)
			};

			$.ajax({
				url:API.domain+url_get_table3+"/"+get["id"],
				type:"post",
				data:post,
				success:function(data){
					var result=JSON.parse(data);
					$(".submit_form input[name=id]").val(result.Table3.id);
					$(".submit_form input[name=name]").val(result.Table3.name);
					$(".submit_form input[name=code]").val(result.Table3.code);
					$(".submit_form textarea[name=caption]").val(result.Table3.caption);

				}
			});
		}
	}
	else
	{
		if(post_cash!=null){
			$(".submit_form input[name=name]").val(post_cash.name);
			$(".submit_form input[name=code]").val(post_cash.code);
			$(".submit_form textarea[name=caption]").val(post_cash.caption);
		}
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

<?php include("common/footer.php"); ?>