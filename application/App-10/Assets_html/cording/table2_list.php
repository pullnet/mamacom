<?php
$title="Table2のリスト";
include("common/header.php"); ?>

<div class="m10">
	<div class="mb10">
		<a href="index.php" class="underline">戻る</a>
	</div>
	<div class="mb10">
		<a href="table2_edit.php" class="buttons new btn_new">table2を新規登録</a>
	</div>
	<div id="source_listview" class="hidden">
		<div class="sec" data-id="{table2_id}">
			<ul class="table">
				<li style="width:125px;padding-right:10px;"><img src="" class="image image_thumbnail"></li>
				<li>
					<p>{table2_createdate}</p>
					<h3>{table2_name}</h3>
					<p style="color:#aaa">{table2_colum_a}</p>
					<p style="color:#aaa">{table2_select_b}</p>
					<ul class="float colum3">
						<li><a href="table2_edit.php?id={table2_id}" class="buttons edit">編集</a></li>
						<li><a href="table2_detail.php?id={table2_id}" class="buttons preview">詳細</a></li>
						<li><label for="delete_{table2_id}" class="buttons delete">削除</label></li>
					</ul>
					<div id="Modal">
						<input type="checkbox" id="delete_{table2_id}" class="checks">
						<label></label>
						<label for="delete_{table2_id}" class="basejavar"></label>
						<table class="window table dialog">
						<tr>
							<td class="hf head h3">
								Table2の削除
								<label for="delete_{table2_id}" class="f_right h3">×</label>
							</td>
						</tr>
						<tr>
							<td class="main top h4">
								{table2_name}を削除します<br>
								よろしいですか？
							</td>
						</tr>
						<tr>
							<td class="hf">
								<ul class="float">
									<li><label for="delete_{table2_id}" class="buttons clearbtn">キャンセル</label></li>
									<li class="f_right">
										<label class="buttons clearbtn add delete_table2" data-id="{table2_id}">削除する</label>
									</li>
								</ul>
							</td>
						</tr>
						</table>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="listview table2_listview"></div>
</div>

<script type="text/javascript">
$(function(){

	//URL LIST....
	var url_list_table2="v1/list_table2";
	var url_delete_table2="v1/delete_table2";

	//Table2リストの取得
	var post={
		access_token:JSession.read("token_"+API.authcode)
	};

	$.ajax({
		url:API.domain+url_list_table2,
		type:"post",
		data:post,
		success:function(data){
			var result=JSON.parse(data);

			var total=Object.keys(result).length;
			for(var s1=0;s1<total;s1++){
				set_table2(result[s1].Table2);
			}

		}	
	});
	
	function set_table2(data){

		$("#source_listview .image_thumbnail").attr("src",data.thumbnail);
		
		var source=$("#source_listview").html();
		source=source.replace(/{table2_id}/g ,data.id);
		source=source.replace(/{table2_createdate}/g ,data.create_date);
		source=source.replace(/{table2_name}/g ,data.name);
		source=source.replace(/{table2_colum_a}/g ,data.colum_a);
		source=source.replace(/{table2_select_b}/g ,data.select_b);
		$(".table2_listview").append(source);
	}

	//Table2の削除
	$("body").on("click",".delete_table2",function(){
		var id=$(this).attr("data-id");

		var post={
			access_token:JSession.read("token_"+API.authcode)
		};

		$.ajax({
			url:API.domain+url_delete_table2+"/"+id,
			type:"post",
			data:post,
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					if(result.message){
						JSession.write("alert",result.message);
					}
					location.href=location.href;
				}
			}
		});
	});

	//新規作成前処理(Sessionキャッシュの削除)
	$(".btn_new").on("click",function(){
		var hrefs=$(this).attr("href");

		JSession.delete("post_cash");

		location.href=hrefs;
		return false;
	});

});
</script>


<?php include("common/footer.php"); ?>
