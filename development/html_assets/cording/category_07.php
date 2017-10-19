<?php $title="ライブラリの検索結果";?>
<?php include("common/header.php"); ?>

<div class="wrapper">
	<a href="index.php"><h2 class="mtitle">地元ママ応援！<br>地域のポータルサイト</h2></a>
	
	<p class="m10 h3">下記より地区をお選びください</p>
	
	<div class="contents_area">
	</div>
	
</div>


<script type="text/javascript">
$(function(){
	
	//地区の処理
	var url_method="category/ditrict_list";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token
			},
			success:function(data){
				var result=JSON.parse(data);
				
				var ditrict_count = Object.keys(result).length;
				for(var i = 0; i < ditrict_count; i++){
					
					$(".contents_source h3").text(result[i].name);
					$(".contents_source *[content_link]").attr("href",$(".contents_source *[content_link]").attr("hrefs")+"?id="+result[i].id);
					
					//書き換え処理
					$('.contents_area').append($(".contents_source").html());
				}

			}
		});
	}
	else{
		view_error_page();
	}	

});
</script>

	<div class="contents_source" style="display:none">
		<div class="item">
			<a hrefs="category_07_arealist.php" content_link>
					<h3></h3>
			</a>
		</div>
	</div><!--//.contents_source-->

<?php include("common/footer.php"); ?>