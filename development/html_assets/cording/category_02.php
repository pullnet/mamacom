<?php $title="ライブラリの検索結果";?>
<?php include("common/header.php"); ?>
<div class="wrapper">
	<a href="index.php"><h2 class="mtitle">アレルギー対応店</h2></a>
	
	<div class="waiting"></div>
	<div class="contents_area hidden">
		<p class="m10 h3">下記より地区をお選びください</p>
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
			<a hrefs="category_02_arealist.php" content_link>
				<h3></h3>
			</a>
		</div>
	</div><!--//.contents_source-->

<?php include("common/footer.php"); ?>
