<?php
$title="Table3のリスト...";
include("common/header.php");
?>
<div class="m10">
	<div class="mb10">
		<a href="index.php" class="underline">戻る</a>
	</div>
	<div class="mb10">
		<a href="table3_edit.php" class="buttons new btn_new">table3を新規登録</a>
	</div>
<style>
#XXXXXXXXX .search{
	background:#e0e0e0;
	padding:10px;
	margin-bottom:20px;
}
#XXXXXXXXX .search form{
	display:table;
	width:100%;
}
#XXXXXXXXX .search .keyword{
	border-bottom:none;
	height:40px;
}
#XXXXXXXXX .search .submit_btn{
	height:40px;
	padding:7px 0px;
	width:100%;
	display:block;
	margin:0px;
	background:#189;
	border-bottom:none;
}
#XXXXXXXXX .search .submit_btn img{
	height:100%;
}
</style>
	<div class="search">
		<form class="search_form" method="get">
			<ul class="table">
				<li><input type="text" name="keyword" class="keyword"></li>
				<li class="center" style="width:60px"><a class="submit_btn"><img src="images/icon_search.svg"></a></li>
			</ul>
		</form>
	</div><!--//.search_form-->

	<div id="source_listview" class="hidden">
		<div class="sec" data-id="{table2_id}">
			<p>{table3_createdate}</p>
			<h3>{table3_name}</h3>
			<p style="color:#aaa">{table3_code}</p>
			<ul class="float colum3">
				<li><a href="table3_edit.php?id={table3_id}" class="buttons edit">編集</a></li>
				<li><a href="table3_detail.php?id={table3_id}" class="buttons preview">詳細</a></li>
				<li><label for="delete_{table3_id}" class="buttons delete">削除</label></li>
			</ul>
			<div id="Modal">
				<input type="checkbox" id="delete_{table3_id}" class="checks">
				<label></label>
				<label for="delete_{table3_id}" class="basejavar"></label>
				<table class="window table dialog">
				<tr>
					<td class="hf head h3">
						Table3の削除
						<label for="delete_{table3_id}" class="f_right h3">×</label>
					</td>
				</tr>
				<tr>
					<td class="main top h4">
						{table3_name}を削除します<br>
						よろしいですか？
					</td>
				</tr>
				<tr>
					<td class="hf">
						<ul class="float">
							<li><label for="delete_{table3_id}" class="buttons clearbtn">キャンセル</label></li>
							<li class="f_right">
								<label class="buttons clearbtn add delete_table3" data-id="{table3_id}">削除する</label>
							</li>
						</ul>
					</td>
				</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="listview table3_listview"></div>

</div>
<div class="table3_active_area" style="background:#eee;height:60px;text-align:center;line-height:60px;">読み出し中？</div>

<script type="text/javascript">
var screen_height=$(window).height();
$(function(){
	var authdata=LSession.read("auth_"+API.authcode);

	if(authdata==null){
		location.href="index.php";
	}

	//URL List...
	var url_list_table3="v2/list_table3";
	var url_delete_table3="v2/delete_table3";
	var page_index=1;
	var foot_loading=true;

	//Table3リストの取得と表示...
	var get=Params.get();
	var getcode="";
	if(get!=null){
		$(".search input[name=keyword]").val(get["keyword"]);
		var getcode="?keyword="+get["keyword"];
	}

	var post={
		access_token:JSession.read("token_"+API.authcode)
	};

	$.ajax({
		url:API.domain+url_list_table3+getcode,
		type:"post",
		data:post,
		success:function(data){
			var result=JSON.parse(data);

			if(result.mode==400){
				$(".table3_active_area").css("display","none");

			}
			else
			{
				var total=Object.keys(result).length;
				for(var s1=0;s1<total;s1++){
					set_table3(result[s1].Table3);
				}
			}
			add_loading(1);
		}
	});

	function set_table3(data){

		$("#source_listview .image_thumbnail").attr("src",data.thumbnail);
		
		var source=$("#source_listview").html();
		source=source.replace(/{table3_id}/g ,data.id);
		source=source.replace(/{table3_createdate}/g ,data.create_date);
		source=source.replace(/{table3_name}/g ,data.name);
		source=source.replace(/{table3_code}/g ,data.code);
		$(".table3_listview").append(source);
	}

	//Table3の追加読み込み(最下部まで来たらAjaxからロード..)
	$(window).on("scroll",function(){
		add_loading();
	});

	function add_loading(mode){

		var scroll=$(window).scrollTop();
		var going=false;

		if(mode==1 && ($("body").height()-screen_height-120)<0){
			going=true;
		}
		if(mode!=1 && foot_loading==true && scroll>($("body").height()-screen_height-120)){
			going=true;
		}
		if(going==true){
			foot_loading=false;

			page_index++;

			//GETコード作成
			var getparam={
				page:page_index
			};
			var getcode2="";
			if(getcode){
				getcode2=getcode+"&"+$.param(getparam);
			}
			else
			{
				getcode2="?"+$.param(getparam);
			}

			var post={
				access_token:JSession.read("token_"+API.authcode)
			};

			$.ajax({
				url:API.domain+url_list_table3+getcode2,
				type:"post",
				data:post,
				success:function(data){
					var result=JSON.parse(data);

					if(result.mode==201){
						$(".table3_active_area").css("display","none");
					}
					else
					{
						var total=Object.keys(result).length;
						for(var s1=0;s1<total;s1++){
							set_table3(result[s1].Table3);
						}

						foot_loading=true;
					}
				}
			});
		}
	}

	//Table3の削除
	$("body").on("click",".delete_table3",function(){
		var id=$(this).attr("data-id");

		var post={
			access_token:JSession.read("token_"+API.authcode)
		};

		$.ajax({
			url:API.domain+url_delete_table3+"/"+id,
			type:"post",
			data:post,
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					JSession.write("alert","Table3を１件削除しました");
					location.href=location.href;
				}
			}
		});
	});

	//新規作成前処理(Sessionキャッシュの削除)
	$(".btn_new").on("click",function(){
		var href=$(this).attr("href");

		JSession.delete("post_cash");

		location.href=href;
		return false;
	});

	//検索Submit
	$(".submit_btn").on("click",function(){
		$(".search_form").submit();
	});
});
</script>

<?php include("common/footer.php"); ?>