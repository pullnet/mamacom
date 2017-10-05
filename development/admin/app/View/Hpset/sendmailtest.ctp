<h1>メール送信確認テスト</h1>
<?php
echo $this->Form->create("test",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
?>
<p class="center">送信先のアドレスを入力して下さい</p>
<div><?php echo $this->Form->input("sendemail"); ?></div>

<div class="center mt20 mb20">
<?php echo $this->Form->submit("送信確認する",array("class"=>"buttons short","div"=>false)); ?>
</div>

<?php echo $this->Form->end(); ?>