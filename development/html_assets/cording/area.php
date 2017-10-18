<?php include("common/header.php"); ?>
<div class="wrapper">
	<a href="index.php"><h2 class="mtitle">○○区</h2></a>
	<div class="m5">
		<ul class="float colum2">
			<li class="category_02">
				<a href="category_02_arealist.php"><img src="images/top_banner02.jpg" alt="バナー"></a>
			</li>
			<li class="category_03">
				<a href="category_03_arealist.php"><img src="images/top_banner03.jpg" alt="バナー"></a>
			</li>
			<li class="category_04">
				<a href="category_04_arealist.php"><img src="images/top_banner04.jpg" alt="バナー"></a>
			</li>
			<li class="category_05">
				<a href="category_05_arealist.php"><img src="images/top_banner05.jpg" alt="バナー"></a>
			</li>
			<li class="category_06">
				<a href="category_06_arealist.php"><img src="images/top_banner06.jpg" alt="バナー"></a>
			</li>
			<li class="category_07">
				<a href="category_07.php"><img src="images/top_banner07.jpg" alt="地元ママ応援！地域のポータルサイト"></a>
			</li>
		</ul>
	</div>
</div>



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
	//console.log(ditrict_id);
	
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
				console.log(result[0].name);
				
				$(".mtitle").text(result[0].name);
				$(".category_02 a").attr("href", "category_02_arealist.php"+"?id="+result[0].id);
				$(".category_03 a").attr("href", "category_03_arealist.php"+"?id="+result[0].id);
				$(".category_04 a").attr("href", "category_04_arealist.php"+"?id="+result[0].id);
				$(".category_05 a").attr("href", "category_05_arealist.php"+"?id="+result[0].id);
				$(".category_06 a").attr("href", "category_06_arealist.php"+"?id="+result[0].id);
				$(".category_07 a").attr("href", "category_07_arealist.php"+"?id="+result[0].id);
				
			}
		});
	}
	else{
		view_error_page();
	}

});
</script>


<?php include("common/footer.php"); ?>
