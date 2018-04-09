<?php
$title="Table1のリスト";
include("common/header.php"); ?>

<div class="m10">
	<div class="mb10">
		<a href="index.php" class="underline">戻る</a>
	</div>
	<a href="table1_edit.php" class="buttons new">table1を新規登録</a>

	<div id="source_listview" class="hidden">
		<div class="sec" data-id="{table1_id}">
			<p>{table1_createdate}</p>
			<h3>{table1_name}</h3>
			<p style="color:#aaa">{table1_status}</p>
			<ul class="float colum3">
				<li><a href="table1_edit.php?id={table1_id}" class="buttons edit">編集</a></li>
				<li><a href="table1_detail.php?id={table1_id}" class="buttons preview">詳細</a></li>
				<li><label for="delete_{table1_id}" class="buttons delete">削除</label></li>
			</ul>
			<div id="Modal">
				<input type="checkbox" id="delete_{table1_id}" class="checks">
				<label></label>
				<label for="delete_{table1_id}" class="basejavar"></label>
				<table class="window table dialog">
				<tr>
					<td class="hf head h3">
						Table1の削除
						<label for="delete_{table1_id}" class="f_right h3">×</label>
					</td>
				</tr>
				<tr>
					<td class="main top h4">
						{table1_name}を削除します<br>
						よろしいですか？
					</td>
				</tr>
				<tr>
					<td class="hf">
						<ul class="float">
							<li><label for="delete_{table1_id}" class="buttons clearbtn">キャンセル</label></li>
							<li class="f_right">
								<label class="buttons clearbtn add delete_table1" data-id="{table1_id}">削除する</label>
							</li>
						</ul>
					</td>
				</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="listview table1_listview"></div>
</div>
<script type="text/javascript">
$(function(){

	//URL list

	var url_list_table1="v1/list_table1";
	var url_delete_table1="v1/delete_table1";

	//table1の一覧取得
	var post={
		access_token:JSession.read("token_"+API.authcode)
	};

	$.ajax({
		url:API.domain+url_list_table1,
		type:"post",
		data:post,
		success:function(data){
			var result=JSON.parse(data);

			var total=Object.keys(result).length;
			for(var s1=0;s1<total;s1++){
				
				set_table1(result[s1].Table1);
			}

		}	
	});

	function set_table1(data){
		
		var source=$("#source_listview").html();
		source=source.replace(/{table1_id}/g ,data.id);
		source=source.replace(/{table1_createdate}/g ,data.create_date);
		source=source.replace(/{table1_name}/g ,data.name);
		source=source.replace(/{table1_status}/g ,data.status);
		$(".table1_listview").append(source);
	}

	//table1のレコード削除
	$("body").on("click",".delete_table1",function(){
		var id=$(this).attr("data-id");

		var post={
			access_token:JSession.read("token_"+API.authcode)
		};

		$.ajax({
			url:API.domain+url_delete_table1+"/"+id,
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
});
</script>
<?php include("common/footer.php"); ?>
