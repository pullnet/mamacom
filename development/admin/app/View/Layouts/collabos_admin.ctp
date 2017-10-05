<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">

<?php echo $this->Html->css("style_type1"); ?>
<?php echo $this->Html->css("style_type2"); ?>
<?php echo $this->Html->css("admin"); ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

<title>collabos - 管理画面 - </title>
</head>
<body>

<div class="dammy_fixedmenu"></div>
<div class="collabos_header">
	<div class="base">
		<div class="area left">
			<?php echo $this->Html->link($this->Html->image("logo.png",array("alt"=>"COLLABOS")),"/",array("escape"=>false)); ?>
		</div>
		<div class="area center">
			管理者画面
		</div>
		<div class="area right">
			<?php
			if($logined==false)
			{
				echo $this->Html->link("ログイン",array("controller"=>"user","action"=>"login"));
			}
			else
			{
				echo $this->Html->link("ログアウト",array("controller"=>"user","action"=>"logout"));
			}
			?>
		</div>
        	<div class="floatclear"></div>
	</div>
</div>
<?php echo $this->Element("common/header_gnavi"); ?>
<div class="container">
	<div class="content float">
		<?php //echo $this->element("common/sidenav"); ?>
		<div class="main">
			<?php echo $this->fetch('content'); ?>
		</div><!--//.main-->
	</div><!--//.content-->
</div><!--//.container-->


<div id="popup">
	<div class="basejavar"></div>
</div>

<div class="footer">
    <div class="base">
        <div class="copylight"><span class="hidden520">Copyright </span>(C) PULL-NET Inc. All rights reserved.</div>
    </div><!--//.base-->
</div><!--//.footer-->

</body>
</html>
