<div class="bread">
	<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
	<?php echo $this->Html->link("入力エラー表示情報一覧",array("controller"=>"inputerror","action"=>"index")); ?>　＞　
	入力エラー表示情報登録・編集
</div>
<h1>入力エラー表示情報登録・編集</h1>


<?php
echo $this->Form->create("Inputerror",array(
	"inputDefaults"=>array(
		"div"=>false,
		"legend"=>false,
		"required"=>false,
		"label"=>false,
	),
));
echo $this->Form->hidden("id");
?>

<table cellspacing="0" cellpadding="0" class="mb20">
<tr>
	<th>適用コード</th>
	<td>
		<?php
			echo $this->Form->input("code",array("error"=>false));
			echo $this->Form->error("code");
		?>
	</td>
</tr>
<tr>
	<th>表示場所名</th>
	<td>
		<?php
			echo $this->Form->input("name",array("error"=>false));
			echo $this->Form->error("name");
		?>
	</td>
</tr>
<tr>
	<th>エラーメッセージ文</th>
	<td>
		<?php
			echo $this->Form->textarea("message",array("class"=>"high","error"=>false,"required"=>false));
			echo $this->Form->error("message");
		?>
	</td>
</tr>
</table>

<div class="center">
	<?php echo $this->Form->submit("設定する",array("div"=>false,"class"=>"buttons")); ?>
</div>

<?php echo $this->Form->end(); ?>