	<div class="userblock" style="z-index:3">
		<input type="checkbox" id="userblock_innersearch" style="display:none">
		<div class="innersearch">
			<div class="bs">
				<form method="get">
					<div class="float">
						<input type="text" name="keyword" class="keyword" placeholder="検索">
						<input type="image" src="images/icon_hag.png" class="image middle">
					</div>
				</form>
			</div>
		</div><!--//.innersearch-->
		<div class="data">
			<div class="table w100">
				<input type="checkbox" id="userdata_icon" style="display:none">
				<div class="t_cell top icon">
					<a href="profile.php"><img src="images/toppage/sample13.jpg"></a>
				</div>
				<div class="t_cell top info">
					<h1>yoshikawakayoko</h1>
					<p>職業 - ウェブ制作</p>
				</div>
				<div class="t_cell top setting">
					<a href="user_setting_baskc.php" class="buttons">ユーザー設定</a>
				</div>
			</div>
			<input type="checkbox" id="userdata_cap" style="display:none">
			<div class="cap">
				<div class="bs">
					はじめまして。ご覧いただき、誠にありがとうございます。WEBデザイナー兼ディレクターの吉川と申します。
					1歳半の子供をもつママでもあります＾＾お手伝いできることがありましたら、お気軽にお問い合わせ下さい。
				</div>
			</div>
		</div><!--//.data-->

		<div class="navi">
			<ul class="table">
				<li class="<?php if(@$active=="library"){ echo "active"; } ?>"><a href="library_list.php">ライブラリ</a></li>
				<li class="<?php if(@$active=="collabo"){ echo "active"; } ?>"><a href="collabo_list.php">コラボ</a></li>
				<li class="<?php if(@$active=="friendgroup"){ echo "active"; } ?>"><a href="friendgroup.php">仲間／グループ</a></li>
				<li class="<?php if(@$active=="profile"){ echo "active"; } ?>"><a href="profile.php">プロフィール</a></li>
			</ul>
		</div><!--//.navi-->
	</div><!--//.userblock-->

	<div class="userblock_dmy"></div>

<script type="text/javascript">
$(function(){

	var tops=$(window).scrollTop();

	userblock_head();
	$(window).on("scroll",function(){
		tops=$(window).scrollTop();
		userblock_head();
	});

	function userblock_head(){
		if(tops<150){
			$("#userblock_innersearch").prop("checked",false);
			$("#userdata_cap").prop("checked",false);
			$("#userdata_icon").prop("checked",false);
		}
		else
		{
			$("#userblock_innersearch").prop("checked",true);
			$("#userdata_cap").prop("checked",true);
			$("#userdata_icon").prop("checked",true);

		}
	}
});
</script>