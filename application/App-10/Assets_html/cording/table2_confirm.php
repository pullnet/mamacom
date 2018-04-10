<?php $title="Table2の登録・編集(確認画面)"; ?>
<?php include("common/header.php"); ?>
<div class="body">
	<div class="absolute_area">
		<div class="tr">
			<div class="t_cell">
				<div class="m10">
					<p class="h3 mb20">下記の内容で保存します。よろしいですか？</p>

					<dl class="form table2_detail_area" style="display:none">
						<dt>レコード名</dt>
						<dd table2-name></dd>
						<dt>項目名AAAA</dt>
						<dd table2-colum_a></dd>
						<dt>サムネイル画像</dt>
						<dd>
							<div class="image_w80">
								<img src="" class="image image_thumbnail">
							</div>
						</dd>
						<dt>背景画像1</dt>
						<dd>
							<div class="mb20">
								<img src="" class="image image_background">
							</div>
						</dd>
						<dt>選択項目BBB</dt>
						<dd table2-select_b></dd>
						<dt>その他備考欄</dt>
						<dd table2-caption></dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="tr h50 controls">
			<div class="t_cell">
				<ul class="float m5">
					<li><a href="table2_edit.php" class="buttons backs">戻る</a></li>
					<li class="f_right"><label class="buttons submit_btn">登録する</label></li>
				</ul>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">
$(function(){

	//URL LIST...

	var url_get_table2_select_b="v1/get_table2_select_b";
	var url_submit="v1/edit_table2";
	var url_redirect="table2_list.php";

	var select_b;

	//・select_aの選択項目を取得
	var post={
		access_token:JSession.read("token_"+API.authcode)
	};

	$.ajax({
		url:API.domain+url_get_table2_select_b,
		type:"post",
		async:false,
		data:post,
		success:function(data){
			var result=JSON.parse(data);
			select_b=result;

		}
	});

	//SessionからGET
	var post_cash=JSession.read("post_cash");

	if(post_cash!=null){

		$(".table2_detail_area *[table2-name]").text(post_cash.name);
		$(".table2_detail_area *[table2-colum_a]").text(post_cash.colum_a);
		$(".table2_detail_area *[table2-select_b]").text(select_b[post_cash.select_b]);
		$(".table2_detail_area *[table2-caption]").html(nl2br(post_cash.caption));
		$(".image_thumbnail").attr("src",post_cash.thumbnail_path);
		$(".image_background").attr("src",post_cash.background_path);

		$(".table2_detail_area").css("display","");
	}
	else
	{
		history.back();
	}

	//・SUBMIT...
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
					JSession.write("alert",result.message);
					location.href=url_redirect;
				}
			}
		});
		return false;
	});
	
});
</script>

<?php include("common/footer.php"); ?>