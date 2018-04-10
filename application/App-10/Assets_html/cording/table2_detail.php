<?php
$title="Table2の詳細";
include("common/header.php"); ?>

<div class="m10">
	<div class="mb10">
		<a href="table2_list.php" class="underline">戻る</a>
	</div>

	<dl class="form table2_area">
		<dt>作成日</dt>
		<dd table2-createdate></dd>
		<dt>名前</dt>
		<dd table2-name></dd>
		<dt>項目名AAA</dt>
		<dd table2-colum_a></dd>
		<dt>サムネイル画像</dt>
		<dd>
		<div class="image_w80">
			<img src="" class="image_thumbnail image">
		</div>
		</dd>
		<dt>背景画像</dt>
		<dd><img src="" class="image_background image"></dd>
		<dt>選択項目BBB</dt>
		<dd table2-select_b></dd>
		<dt>その他備考欄</dt>
		<dd table2-caption></dd>

	</dl>
</div>
<script type="text/javascript">
$(function(){

	var url_get_table2="v1/get_table2";

	var get=Params.get();

	if(get["id"]){

		var post={
			access_token:JSession.read("token_"+API.authcode)
		};

		$.ajax({
			url:API.domain+url_get_table2+"/"+get["id"]+"/detail",
			type:"post",
			data:post,
			success:function(data){
				var result=JSON.parse(data);

				$(".table2_area *[table2-createdate]").text(result.Table2.create_date);
				$(".table2_area *[table2-name]").text(result.Table2.name);
				$(".table2_area *[table2-colum_a]").text(result.Table2.colum_a);
				$(".table2_area .image_thumbnail").attr("src",result.Table2.thumbnail_path);
				$(".table2_area .image_background").attr("src",result.Table2.background_path);
				$(".table2_area *[table2-select_b]").text(result.Table2.select_b);
				$(".table2_area *[table2-caption]").html(nl2br(result.Table2.caption));
			}
		});
	}
});
</script>
<?php include("common/footer.php"); ?>
