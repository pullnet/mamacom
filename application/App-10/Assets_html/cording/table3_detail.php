<?php
$title="Table3の詳細";
include("common/header.php"); ?>

<div class="m10">
	<div class="mb10">
		<a href="table3_list.php" class="underline">戻る</a>
	</div>
	<dl class="form table3_area">
		<dt>作成日</dt>
		<dd table3-create_date></dd>
		<dt>名前</dt>
		<dd table3-name></dd>
		<dt>コード</dt>
		<dd table3-code></dd>
		<dt>その他備考欄</dt>
		<dd table3-caption></dd>
	</dl>
</div>

<script type="text/javascript">
$(function(){

	//URL List..
	var url_get_table1="v2/get_table3";

	var get=Params.get();
	if(get["id"]){

		var post={
			access_token:JSession.read("token_"+API.authcode)
		};

		$.ajax({
			url:API.domain+url_get_table1+"/"+get["id"]+"/detail",
			type:"post",
			data:post,
			success:function(data){
				var result=JSON.parse(data);

				$(".table3_area *[table3-create_date]").text(result.Table3.create_date);
				$(".table3_area *[table3-name]").text(result.Table3.name);
				$(".table3_area *[table3-code]").text(result.Table3.code);
				$(".table3_area *[table3-caption]").html(nl2br(result.Table3.caption));
			}
		});


	}
});
</script>
<?php include("common/footer.php"); ?>
