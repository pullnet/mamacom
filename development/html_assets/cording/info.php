<?php $title="お知らせ";?>
<?php $active_info = true;?>
<?php include("common/header.php"); ?>

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
	
	//パラメータからコンテンツID取得
	var arg  = new Object;
	url = location.search.substring(1).split('&');
	for(i=0; url[i]; i++) {
		var k = url[i].split('=');
		arg[k[0]] = k[1];
	}
	var post_id = arg.id;	
	var article;
	
	if (typeof(post_id) == "undefined"){
		post_id=0;
		article=50;
	}
	else{
		article=1;
	}

	//コンテンツの処理
	var url_method="information/information_list";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				article_limit:article,
				info_id:post_id,
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
  border-radius: 5px 5px 0px 0px / 5px 5px 0px 0px;
}
body{
		background-color: #FFD0DB;
}
.item .post_date{
		text-align:center;
		margin:2px 5px 0;
		font-size:10px;
}

.s01 .block{
	padding:4%;
	padding-bottom:5%;
  border-radius: 0px 0px 5px 5px / 0px 0px 5px 5px;
}

</style>

<?php include("common/footer.php"); ?>