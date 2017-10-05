<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　コラボ参加ステータス編集</div>
<h1>コラボ参加ステータス編集</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Collabostatuslist",array(
		"inputDefaults"=>array(
			"Div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	echo $this->Form->hidden("id");
	echo $this->Form->hidden("default",array("value"=>0));
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>ステータス名</th>
		<td>
			<?php echo $this->Form->input("name",array("error"=>false)); ?>
			<?php echo $this->Form->error("name"); ?>
		</td>
	</tr>
	<tr>
		<th>ステータスコード</th>
		<td>
			<?php echo $this->Form->input("code",array("class"=>"short","error"=>false)); ?>
			<?php echo $this->Form->error("code"); ?>
		</td>
	</tr>
	</table>

	<div class="center mb20">
		<?php echo $this->Form->submit("ステータスを設定する",array("div"=>false,"class"=>"buttons")); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
