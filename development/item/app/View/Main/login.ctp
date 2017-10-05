<div class="main">
<h1>コンテンツ管理用ログイン</h1>
<?php
echo $this->Form->create("Adminlogin",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
?>
<p>PW:<?php echo $this->Form->input("password",array("type"=>"password")); ?></p>
<p><?php echo $this->Form->submit("ログイン",array("div"=>false)); ?></p>
<?php echo $this->Form->end(); ?>
</div>

<style>
.main{
	width:400px;
	padding:10px;
	border:solid 1px #999;
	margin:30px auto;
}
.main h1{
	font-weight:normal;
	font-size:25px;
	text-align:center;
}
.main p{
	text-align:center;
}
.main input[type=password]{
	line-height:20px;
}
.main input[type=submit]{
	display:inline-block;
	padding:5px 10px;
}
</style>