<?php $title="ライブラリの検索結果";?>
<?php include("common/header.php"); ?>

<div class="wrapper">
	<a href="javascript:history.back();"><h2 class="mtitle">授乳室マップ</h2></a>
	<h2 class="subttl m10"><!--js処理--></h2>

	<div class="waiting"></div>
	<div class="contents_area hidden">
		<p class="serch_result_text"><b>全0件</b><span>-うち0件表示-</span></p>
	</div>
	<!--//.contents_area-->
	
	<div class="pager mt10 ">
		<ul class="float pager_area">

		</ul>
	</div>
</div>
<script type="text/javascript">
$(function(){

	//ＵＲＬパラメータから地区ID取得とページ番号取得
	var arg  = new Object;
	url = location.search.substring(1).split('&');
	for(i=0; url[i]; i++) {
		var k = url[i].split('=');
		arg[k[0]] = k[1];
	}
	var ditrict_id = arg.id;
	
	if('page' in arg){
		var page_num = arg.page;
	}else{
		var page_num = 1;
	}
	
		
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
				cid:"5",					//カテゴリー指定【個別設定】
				page:page_num,
			},
			success:function(data){

				$(".contents_area").animate({
					"opacity":1,
					"-webkit-opacity":1,
					"-moz-opacity":1,
					"-ms-opacity":1,
					"-o-opacity":1,
				},500);

				$(".waiting").animate({
					"opacity":0,
					"-webkit-opacity":0,
					"-moz-opacity":0,
					"-ms-opacity":0,
					"-o-opacity":0,
				},300);

				var result=JSON.parse(data);
				console.log(result);
				
				
				var item_count = Object.keys(result).length - 4;				
			
				for(var i = 0; i < item_count; i++){		
					//一部Jsonパース
					var caption = JSON.parse(result[i]["Contents"].caption);//console.log(caption);
										
					$(".copy_base .item .s01 h3").text(result[i]["Contents"].title);
					$(".copy_base .item .s01 p").text(caption.text1);
					$(".copy_base .item .s00 img").attr("src",result[i]["Contents"].content);
					$(".copy_base *[content_link]").attr("href",$(".copy_base *[content_link]").attr("hrefs")+"?id="+result[i]["Contents"].id);

					$('.contents_area').append($(".copy_base").html());
				}

				//ページャー処理
				$(".serch_result_text b").text("全 "+result.totalcount+" 件");
				$(".serch_result_text span").text("-うち"+item_count+"件表示-");

				if(result.totalpage>1){

						if(page_num!=1){
							$('.copy_pager a').html("&lt;");
							$(".copy_pager *[content_link]").attr("href","category_06_arealist.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)-1) );
							
							$('.pager_area').append($(".copy_pager").html());	
						}
										
						//表示はページャの5個まで
						if(page_num>2){
							if(result.totalpage-page_num+1 > 3){var view_limit = 3;}else{var view_limit = result.totalpage-page_num+1;}
						}
						else if(page_num>1){
							if(result.totalpage-page_num+1 > 4){var view_limit = 4;}else{var view_limit = result.totalpage-page_num+1;}
						}
						else{
							if(result.totalpage-page_num+1 > 5){var view_limit = 5;}else{var view_limit = result.totalpage-page_num+1;}
						}
						
						if(page_num>2){
							
							$('.copy_pager a').html( (parseInt(page_num)-2) );
							$(".copy_pager *[content_link]").attr("href","category_06_arealist.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)-2) );
							$('.pager_area').append($(".copy_pager").html());
	
						}
						if(page_num>1){
							
							$('.copy_pager a').html( (parseInt(page_num)-1) );
							$(".copy_pager *[content_link]").attr("href","category_06_arealist.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)-1) );
							$('.pager_area').append($(".copy_pager").html());
	
						}						
						
						for(i=0;i<view_limit; i++){
						
							if(i==0){  $('.copy_pager li').addClass("active");  }
							else{  $('.copy_pager li').removeClass("active");  }
							
							$('.copy_pager a').html( (parseInt(page_num)+i) );
							$(".copy_pager *[content_link]").attr("href","category_06_arealist.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)+i) );
							
							$('.pager_area').append($(".copy_pager").html());				
						}
						
						if( page_num < result.totalpage){
							$('.copy_pager a').html("&gt;");
							$(".copy_pager *[content_link]").attr("href","category_06_arealist.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)+1) );
							
							$('.pager_area').append($(".copy_pager").html());	
						}
						
				}	
	
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
				<div class="s00" style=""><img src=""></div>
				<div class="s01">
					<h3>店舗名</h3>
					<p class="subc">説明テキスト</p>
				</div>
			</div>
			</a>
		</div>
	</div>

	<div class="copy_pager" style="display:none;">
						<li class="pager"><a content_link></a> </li>
	</div>

<?php include("common/footer.php"); ?>