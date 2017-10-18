<?php $title="トップページ";?>
<?php $active_index = true;?>
<?php include("common/header.php"); ?>

<div style="display:none">

<div class="test_mess_box mt20" style="display:none"></div>

<div>
<ul>
<li class="mt20"><button id="token_test">tokenテスト</button></li>
<li class="mt20"><button id="token">○○テスト</button></li>
<li class="mt20"><button id="token">○○テスト</button></li>
</ul>
</div>

<script type="text/jscript">

$('#token_test').on('click', function() {
	
	var url_method="token/get_token_test";
	var token=JSession.read("token");
	
	if(token==null){
		
		$('.test_mess_box').css('display','block');
		$('.test_mess_box').text("sessionにトークンがありません");
		console.log("sessionにトークンがありません");
		
	}
	else{
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
			},
			success:function(data){
				var result=JSON.parse(data);
				
				console.log(result.enable+" "+result.error);
				
				if(result.enable){
				$('.test_mess_box').css('display','block');
				$('.test_mess_box').text("アクセスが許可されています。");				
				}
				else{
				$('.test_mess_box').css('display','block');	
				$('.test_mess_box').text("アクセスが許可されていません。"+result.error);				
				}

			}
		});
	}
});

</script>

</div>





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
			<h3><span class="ttl_img"><img src="images/top_news_ttl.jpg" alt="お知らせ情報"></span></h3>
            <p class="mb5"><span class="icon_new">2017.09.01 </span> <a href="info.php">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</a></p>
			<p class="mb5"><span class="icon_new">2017.09.01 </span> <a href="info.php">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</a></p>
			<p class="mb5"><span>2017.09.01 </span> <a href="info.php">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</a></p>
		</div>
	</div>
		
<?php include("common/footer.php"); ?>