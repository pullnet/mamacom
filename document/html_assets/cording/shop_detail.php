<?php $title="コラボ詳細";?>
<?php include("common/header.php"); ?>

<div class="wrapper">

	<div class="content_detail">

		<input type="radio" name="aaa" id="content_detail" style="display:none" checked>
		<input type="radio" name="aaa" id="collabo_list" style="display:none">
		<input type="radio" name="aaa" id="owner_data" style="display:none">

		<div class="head">
			<div class="type collabo">new</div>
			<h1 class="mtitle">店舗や施設名が入ります</h1>
<!--		<div class="option">
				<span>公開中</span>
				<span>お気に入り12</span>
				<span>カテゴリー名テキストテキスト</span>
			</div>-->
			<ul class="tab float">
				<li><label for="content_detail" class="detail">写真</label></li>
				<li><label for="collabo_list" class="collabo">詳細内容</label></li>
				<li><label for="owner_data" class="owner">店舗情報</label></li>
			</ul>
		</div><!--//.head-->
		<div class="head_dmy"></div>

		<div class="pageview type_detail">
			<div class="sec">
				<img src="images/test_img.jpg">
			</div>
			<div class="sec">
				<ul class="float colum2">
					<li>
						<p><img src="images/test_img.jpg"></p>
					</li>
					<li>
						<p><img src="images/test_img.jpg"></p>
					</li>
				</ul>
			</div>
		</div>
		<div class="pageview type_collabo_list">
			<div class="collabo_list">
				<p class="h4">セクション01</p>
				<p class="mb20">詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。</p>
				<p class="h4">セクション02</p>
				<p class="mb20">詳細テキストがはいります。詳細テキストがはいります。詳細テキストがはいります。</p>				
			</div>
		</div>
		<div class="pageview type_owner_data">
			<ul class-"userdata">
				<p class="h4">住所</p>
				<p class=""></p>
				<p class="">〒542-0081</p>
				<p class="mb20">大阪市中央区南船場3-10-26-吉川ビル6F</p>
				<p class="h4">電話番号</p>
				<p class="tell_num">06-6243-7757</p>
				<p class="tell_time mb20">【受付時間】10:00 ～ 19:00</p>
				<p class="mb20"><img src="images/tel_contact.jpg"></p>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1640.551089385948!2d135.50019798359426!3d34.67737054755507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e71a32b707fb%3A0xf0f000748564653a!2z44CSNTQyLTAwODEg5aSn6Ziq5bqc5aSn6Ziq5biC5Lit5aSu5Yy65Y2X6Ii55aC077yT5LiB55uu77yR77yQ4oiS77yS77yWIOWQieW3neODk-ODqw!5e0!3m2!1sja!2sjp!4v1499932905576" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
			</ul>

		</div>
	</div><!--//.content_detail-->


<!--//.wrapper--></div>


<?php include("common/footer.php"); ?>