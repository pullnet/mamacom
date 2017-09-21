<?php $title="メッセージ一覧";?>
<?php $active_message_list = true;?>
<?php include("common/header.php"); ?>

<div class="wrapper">

	<h2 class="mtitle">メッセージ一覧</h2>
<style>
.msgfield_list{
	margin:10px;
}
.msgfield_list .item{
	display:block;
	padding:10px 0;
	border-bottom:solid 1px #ccc;
	margin-bottom:10px;
}
.msgfield_list .item .table{
	width:100%;
}
.msgfield_list .item .icon{
	width:70px;
	padding-right:10px;
}
.msgfield_list .item .icon p{
	border:solid 1px #ccc;
}
.msgfield_list .item .icon p img{
	display:block;
}
.msgfield_list .item .type{
	display:inline-block;
	background:#999;
	color:#FFF;
	width:70px;
	border-radius:5px;
	text-align:center;
	padding:2px 0px;
	margin-bottom:3px;
}
.msgfield_list .item .type.normal{
	background:#17c;
}
.msgfield_list .item .type.collabo{
	background:#d80;
}
.msgfield_list .item .type.group{
	background:#096;
}
.msgfield_list .item .buttons{
	padding:0px;
	line-height:45px;
}
.msgfield_list .item .new_msg{
	color:#999;
}

</style>
	<div class="msgfield_list">
		<a href="message_talk.php" class="item">
			<ul class="table">
				<li class="icon"><p><img src="images/iconpeople.png"></p></li>
				<li>
					<span class="type normal">個人</span>
					<h3>User_test さん</h3>
					<p class="new_msg">新着メッセージ：こんにちは。User_testです。</p>
				</li>
			</ul>
		</a><!--//.item-->
		<a href="message_talk.php" class="item">
			<ul class="table">
				<li class="icon"><p><img src="images/iconpeople.png"></p></li>
				<li>
					<span class="type system">運営</span>
					<span></span>
					<h3>mamaコム(仮)運営より</h3>
					<p class="new_msg">新着メッセージ:ようこそ！mamaコム(仮)へ。mamaコム(仮)は…</p>
				</li>
			</ul>
		</a><!--//.item-->
		<a href="message_talk.php" class="item">
			<ul class="table">
				<li class="icon"><p><img src="images/iconpeople.png"></p></li>
				<li>
					<span class="type group">全体</span>
					<h3>「アレルギー対応店」についてのご意見・ご要望</h3>
					<p class="new_msg">新着メッセージ：テキストが入ります。</p>
				</li>
			</ul>
		</a><!--//.item-->

	</div><!--//.msgfield_list-->
<!--//.wrapper--></div>

<?php include("common/footer.php"); ?>