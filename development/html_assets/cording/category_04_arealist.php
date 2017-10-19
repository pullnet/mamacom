<?php $title="ライブラリの検索結果";?>
<?php include("common/header.php"); ?>

<div class="wrapper">
	<a href="javascript:history.back();"><h2 class="mtitle">子育て支援室</h2></a>
	<h2 class="subttl m10"><!--js処理--></h2>
	<p class="serch_result_text"><b>全0件</b><span>-うち0件表示-</span></p>

	<div class="contents_area">
		
		
	</div>
	<!--//.contents_area-->
	
	<div class="pager mt10 ">
		<ul class="float">
			<li class="active"> <a href="#">1</a> </li>
			<li class=""> <a href="#">2</a> </li>
			<li class=""> <a href="#">3</a> </li>
			<li class=""> <a href="#">4</a> </li>
			<li class=""> <a href="#">5</a> </li>
			<li><a href="#">&gt;</a></li>
		</ul>
	</div><!--//.wrapper-->
</div>

<?php include("common/footer.php"); ?>



<script type="text/javascript">
$(function(){


	//パラメータから地区ID取得
	var arg  = new Object;
	url = location.search.substring(1).split('&');
	for(i=0; url[i]; i++) {
		var k = url[i].split('=');
		arg[k[0]] = k[1];
	}
	var ditrict_id = arg.id;
		
		
	//地区の処理
	var url_method="category/ditrict_name";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				id:ditrict_id,
			},
			success:function(data){
				var result=JSON.parse(data);
				//console.log(result[0].name);
				
				$(".subttl").text(result[0].name);
				
			}
		});
	}
	else{
		view_error_page();
	}
	
	//コンテンツの処理
	var url_method="contents/contents_list";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				id:ditrict_id,
				cid:"3",//カテゴリー指定
			},
			success:function(data){
				
				var result=JSON.parse(data);
				//console.log(result);
				
				var item_count = Object.keys(result).length;				
			
				for(var i = 0; i < item_count; i++){		
					//一部Jsonパース
					var caption = JSON.parse(result[i]["Contents"].caption);//console.log(caption);
					
					//テンプレに記入					
					$(".copy_base .item .s01 h3").text(result[i]["Contents"].title);
					$(".copy_base .item .s01 p").text(caption.text1);
					$(".copy_base .item .s00 img").attr("src",result[i]["Contents"].content);
					$(".copy_base *[content_link]").attr("href",$(".copy_base *[content_link]").attr("hrefs")+"?id="+result[i]["Contents"].id);
							
					//書き換え処理
					$('.contents_area').append($(".copy_base").html());
				}

				//ページャー処理保留
				//$(".serch_result_text b").text("全 "+item_count+" 件");

			}
		});
	}
	else{
		view_error_page();
	}	
	

});
</script>

	<div class="copy_base" style="display:none;">
		<div class="item">
			<a hrefs="shop_detail.php" content_link>
			<div class="bs">
				<div class="s00" style=""><img src="images/risbon.png"></div>
				<div class="s01">
					<h3>店舗名</h3>
					<p class="subc">説明テキスト</p>
				</div>
			</div>
			</a>
		</div>
	</div>
