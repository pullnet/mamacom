<?php $title="トップページ";?>
<?php $active_index = true;?>
<?php include("common/header.php"); ?>

<style>
/* 点滅 */
.blinking{
	-webkit-animation:blink 1s ease-in-out infinite alternate;
    -moz-animation:blink 1s ease-in-out infinite alternate;
    animation:blink 1s ease-in-out infinite alternate;
}
@-webkit-keyframes blink{
    0% {opacity:0.3;}
    100% {opacity:1;}
}
@-moz-keyframes blink{
    0% {opacity:0.3;}
    100% {opacity:1;}
}
@keyframes blink{
    0% {opacity:0.3;}
    100% {opacity:1;}
}
</style>


<div class="toppage">

	<div class="sec00 blinking" style="padding:10px;margin:20px 10px;border:solid 1px #B00;text-align:center;border-radius: 10px;">
		<div style="color:#B00;font-size:18px;">通信エラーが発生しました。</div>
        <div style="">電波の良いところで再度試して下さい。</div>
	</div>

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

		
<?php include("common/footer.php"); ?>





