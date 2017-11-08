<!DOCTYPE html>
<html>
<head>
<?php
echo $this->Html->css_lib(array(
	"style_type1",
	"style_type2",
	"style_phpx_oven",
));

?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body id="phpx_lib">
<header class="header">
	<h1>PHP-X OVEN</h1>
	<div class="set_btm">
		<label for="header_setting">▼</label>
	</div>
	<div class="setting">
	</div>
</header>
<?php echo $this->fetch_lib("content"); ?>
</body>
</html>