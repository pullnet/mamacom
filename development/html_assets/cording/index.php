<?php $title="トップページ";?>
<?php $active_index = true;?>
<?php include("common/header.php"); ?>


<div class="toppage">

	<div class="sec01">
		<div class=""><img src="images/top_main01.jpg" alt="トップメインイメージ" class="image"></div>
	</div>
    
    <div class="sec02">
		<a href="category_01.php"><img src="images/top_banner01.jpg" alt="緊急お役立ち"></a>
	</div>
	<div class="sec03">
		<ul class="" id="categorylistblock">
			<li>
				<a href="category_02.php"><img src="images/top_banner02.jpg" alt="バナー"></a>
			</li>
			<li>
				<a href="category_03.php"><img src="images/top_banner03.jpg" alt="バナー"></a>
			</li>
			<li>
				<a href="category_04.php"><img src="images/top_banner04.jpg" alt="バナー"></a>
			</li>
			<li>
				<a href="category_05.php"><img src="images/top_banner05.jpg" alt="バナー"></a>
			</li>
			<li>
				<a href="category_06.php"><img src="images/top_banner06.jpg" alt="バナー"></a>
			</li>
			<li>
				<a href="category_07.php"><img src="images/top_banner07.jpg" alt="地元ママ応援！地域のポータルサイト"></a>
			</li>
		</ul>
	</div>
	<div class="sec04">	
    <div class="news_box">
			<h3><a href="info.php" content_link><span class="ttl_img"><img src="images/top_news_ttl.jpg" alt="お知らせ情報"></span></a></h3>

		</div>
	</div>
		
<?php include("common/footer.php"); ?>



<script type="text/javascript">
$(function(){


	//コンテンツの処理
	var url_method="information/information_list";
	var token=JSession.read("token");
	
	//if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				article_limit:"3",
				info_id:"0",
			},
			success:function(data){
				
				var result=JSON.parse(data);
				console.log(result);
				
				var item_count = Object.keys(result).length;				
			
				for(var i = 0; i < item_count; i++){		
					
					//テンプレに記入					
					$(".copy_base_info span").text(result[i]["Information"].post_date);
					$(".copy_base_info a").text(result[i]["Information"].title);
					$(".copy_base_info a").text(result[i]["Information"].title);
					$(".copy_base_info *[content_link]").attr("href",$(".copy_base_info *[content_link]").attr("hrefs")+"?id="+result[i]["Information"].id);

					//newアイコン処理　　　　　
					//更新月が1か月経過でアイコンを消す（1か月：1555200000ミリ秒）
					var today_date =new Date();
					var new_icon_date = today_date.getTime() - 1555200000;
					var update_date = Date.parse(result[i]["Information"].post_date);
				
					if(new_icon_date < update_date){
						$(".copy_base_info span").addClass('icon_new');	
					}
					else{
						$(".copy_base_info span").removeClass('icon_new');
					}
					
					
					//書き換え処理
					$('.news_box').append($(".copy_base_info").html());
				}

			},
			error: function(){
		       view_error_page();
    		}
		});
	//}
	//else{
	//	view_error_page();
	//}
	

});
</script>

	<div class="copy_base_info" style="display:none;">
      <p class="mb5">
				<span class=""></span>
				<a hrefs="info.php" content_link></a>
			</p>
	</div>






