<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">

<?php echo $this->Html->css("style_type1"); ?>
<?php echo $this->Html->css("style_type2"); ?>
<?php echo $this->Html->css("admin"); ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

<title>mamacom - 管理画面 - </title>
</head>
<body>

<div class="dammy_fixedmenu"></div>
<div class="collabos_header">
	<div class="base">
		<div class="area left">
			<?php echo $this->Html->link($this->Html->image("logo.png",array("alt"=>"mamacom")),"/",array("escape"=>false)); ?>
		</div>
		<div class="area center">
			管理者画面
		</div>
		<div class="area right">
			<?php echo $this->Html->link("ログイン",array("controller"=>"main","action"=>"login")); ?>
		</div>
        	<div class="floatclear"></div>
	</div>
</div>

<div class="container">
	<?php echo $this->fetch('content'); ?>
</div><!--//.container-->

<div class="footer">
    <div class="base">
        <div class="copylight"><span class="hidden520">Copyright </span>(C) mamacom. All rights reserved.</div>
    </div><!--//.base-->
</div><!--//.footer-->

</body>
</html>
