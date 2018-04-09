<?php
$title="Table3の登録・編集(確認画面)";
include("common/header.php");
?>
<div class="body">
	<div class="absolute_area">
		<div class="tr">
			<div class="t_cell">
				<div class="m10">
					<p class="mb20 h3">下記の内容で登録します。よろしいか？</p>
					<dl class="form table3_source">
						<dt>レコード名</dt>
						<dd table3-name></dd>
						<dt>コード</dt>
						<dd table3-code></dd>
						<dt>備考欄</dt>
						<dd table3-caption></dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="tr h50 controls">
			<div class="t_cell">
				<ul class="float m5">
					<li><a href="table3_edit.php" class="buttons">戻る</a></li>
					<li class="f_right"><a class="buttons submit_btn">登録する</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//.body-->
<script type="text/javascript">
$(function(){

	//URL LIST...
	var url_table3_recode="v2/edit_table3";
	var url_redirect="table3_list.php";

	var post_cash=JSession.read("post_cash");

	if(post_cash){

		$(".table3_source *[table3-name]").text(post_cash.name);
		$(".table3_source *[table3-code]").text(post_cash.code);
		$(".table3_source *[table3-caption]").html(nl2br(post_cash.caption));
	}
	else
	{
		history.back();
	}

	$(".submit_btn").on("click",function(){

		var postdata=post_cash;
		postdata.access_token=JSession.read("token_"+API.authcode);

		$.ajax({
			url:API.domain+url_table3_recode,
			type:"post",
			data:postdata,
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					JSession.delete("post_cash");
					JSession.write("alert","Table3の登録が完了しました");
					location.href=url_redirect;
				}
			}
		});
		return false;
	});
});
</script>

<?php include("common/footer.php"); ?>