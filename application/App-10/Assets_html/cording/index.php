<?php
$title="TOPページ";
include("common/header.php"); ?>
<div class="m10">
	アプリのテスト用ソース....
	<div class="auth">
		<p class="h3 mb10">ログイン中？</p>
		<p class="h3 mb10">ユーザー名:<br><span auth-username></span></p>
		<p class="h3 mb10">メールアドレス<br><span auth-mailaddress></span></p>
	</div>
	<div class="no_auth">
		<p>まだログインしていないです..</p>
	</div>
	<a href="table1_list.php" class="buttons">table1のリストへ...</a>
	<a href="table2_list.php" class="buttons">table2のリストへ...</a>
	<p class="auth">
		<a href="table3_list.php" class="buttons">table3のリストへ...</a>
	</p>
	<p class="no_auth">
		<a href="login.php" class="buttons preview">会員ログインへ</a>
	</p>
	<img src="images/sample.png" class="image">
</div>
<?php include("common/footer.php"); ?>
