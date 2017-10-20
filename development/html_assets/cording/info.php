<?php $title="お知らせ";?>
<?php $active_info = true;?>
<?php include("common/header.php"); ?>

<style>
.s01 .block{
	padding:4%;
}
</style>



<div class="wrapper category_01">
	<a href="index.php"><h2 class="mtitle">お知らせ</h2></a>

	<div class="infor_area">
		<!--js処理-->
	</div>

	<!--//.wrapper-->
</div>

<style>
.footer_dmy{
	height:50px;
}
</style>

<?php include("common/footer.php"); ?>









<script type="text/javascript">
$(function(){

	//コンテンツの処理
	var url_method="information/information_list";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				article_limit:"3",
			},
			success:function(data){
				
				var result=JSON.parse(data);
				console.log(result);
				
				var item_count = Object.keys(result).length;				
			
				for(var i = 0; i < item_count; i++){		
					
					//テンプレに記入
					$(".copy_base_info h3").text(result[i]["Information"].title);
					$(".copy_base_info .block").html(result[i]["Information"].caption);
					$(".copy_base_info .block").html(result[i]["Information"].caption);
					//$(".copy_base_info .post_date").text("更新日："+result[i]["Information"].post_date);
					
					//書き換え処理
					$('.infor_area').append($(".copy_base_info").html());
				}

			}
		});
	}
	else{
		view_error_page();
	}
	

});
</script>

	<div class="copy_base_info" style="display:none;">
			<div class="item">
				<div class="bs">
					<div class="s01">
						<h3></h3>
						<div class="block"></div>
						<p class="post_date"></div>
					</div>
				</div>
			</div>
	</div>
	
	
	
<style>
.category_01 .bs h3 {
    font-size: 16px;
    line-height: 1.3;
    text-align: center;
    color: #FFF;
    background-color: #FF6486;
    padding: 8px;
}
body{
		background-color: #FFD0DB;
}
.item .post_date{
		text-align:center;
		margin:2px 5px 0;
		font-size:10px;
}

</style>
