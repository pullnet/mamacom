<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("注文情報一覧",array("controller"=>"order","action"=>"index")); ?>　＞　
一括メール送信
</div>
<div class="main_content">
	<h1>一括メール送信</h1>

	<?php
	echo $this->Form->create("Ordermail",array(
		"inputDefaults"=>$inputDefaults,
	));
?>
<table class="mb20">
<tr>
	<th>送信メールフォーマット</th>
	<td>
		<?php echo h($next_post[0]["format_name"]); ?>
	</td>
</tr>
</table>

<h2>一括メール通知一覧</h2>
<?php
	foreach($next_post as $key=>$np_){
	?>
<table class="mb20">
<tr>
	<th>送信先</th>
	<td>
		<?php echo h($np_["from"])."(".h($np_["fromuser"]).")"; ?>
	</td>
</tr>
<tr>
	<th>メール件名</th>
	<td>
		<?php echo $this->Form->input("Ordermail.".$key.".output.subject"); ?>
	</td>
</tr>
<tr>
	<th>メール本文</th>
	<td>
		<?php echo $this->Form->textarea("Ordermail.".$key.".output.message",array("style"=>"height:400px")); ?>
	</td>
</tr>
</table>
<?php
}
?>
<a onclick="history.back()" class="underline">戻る</a>
<div class="center">
	<?php echo $this->Form->submit("一括メール送信する",array("div"=>false,"class"=>"buttons")); ?>
</div>

<?php echo $this->Form->end(); ?>
</div>


