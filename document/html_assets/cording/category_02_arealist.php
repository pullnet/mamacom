<?php $title="ライブラリの検索結果";?>
<?php include("common/header.php"); ?>

<div class="wrapper">
	<a href="category_02.php"><h2 class="mtitle">アレルギー対応店</h2></a>
	<h2 class="m10">○○区</h2>
	<p class="serch_result_text">全35件<span>-うち20件表示-</span></p>

	<div class="contents_area">
		<a href="shop_detail.php">
		<div class="item">
			<div class="bs">
				<div class="s00" style="background-image:url(images/risbon.png);background-size:cover;background-position:center;" ></div>
				<div class="s01">
					<h3>PATISSERIE LIBO(リスボン)</h3>
					<p class="subc">千林で３０年近く愛されてきた洋菓子店。味と伝統を守りつつ、新しい味に挑戦中！季節ごとに色々なスイーツを味わえる。</p>
				</div>
			</div>
			</a>
		</div>
		<!--//.item-->
		<?php
		for($v1=0;$v1<5;$v1++){
		?>
		<div class="item">
		<a href="shop_detail.php">
			<div class="bs">
				<div class="s00"></div>
				<div class="s01">
					<h3>店名テキスト</h3>
					<p class="subc">説明テキストが入ります。</p>
				</div>
			</div>
		</a>
		</div>
		<!--//.item-->
		<?php
		}
		?>
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
