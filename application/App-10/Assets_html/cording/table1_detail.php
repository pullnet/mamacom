<?php
$title="Table1の詳細";
include("common/header.php"); ?>

<div class="m10">
	<div class="mb10">
		<a href="table1_list.php" class="underline">戻る</a>
	</div>
	<dl class="form table1_area">
		<dt>作成日</dt>
		<dd table1-create_date></dd>
		<dt>名前</dt>
		<dd table1-name></dd>
		<dt>項目名AAA</dt>
		<dd table1-colum_a1></dd>
		<dt>項目名BBB</dt>
		<dd table1-colum_a2></dd>
		<dt>公開設定</dt>
		<dd table1-status></dd>
		<dt>その他説明</dt>
		<dd table1-caption></dd>
	</dl>
</div>

<script type="text/javascript">
$(function(){

	var url_get_table1="v1/get_table1";

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


				$(".table1_area *[table1-create_date]").text(result.Table1.create_date);
				$(".table1_area *[table1-name]").text(result.Table1.name);
				$(".table1_area *[table1-colum_a1]").text(result.Table1.colum_a1);
				$(".table1_area *[table1-colum_a2]").text(result.Table1.colum_a2);
				$(".table1_area *[table1-status]").text(result.Table1.status);
				$(".table1_area *[table1-caption]").html(nl2br(result.Table1.caption));
			}
		});


	}
});
</script>
<?php include("common/footer.php"); ?>
