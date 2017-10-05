<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("検索キーワード一覧",array("controller"=>"keyword","action"=>"index")); ?>　＞　
検索キーワード編集
</div>
<h1>検索キーワード編集</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Keyword",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	echo $this->Form->hidden("id");
	?>
	<table cellspacing="0" cellpadding="0" class="mb30">
	<tr>
		<th>キーワード名</th>
		<td>
			<?php echo $this->Form->input("name",array("error"=>false)); ?>
			<?php echo $this->Form->error("name"); ?>
		</td>
	</tr>
	<tr>
		<th>キーワードURL</th>
		<td>
			<?php echo $this->Form->input("code",array("class"=>"short","error"=>false)); ?>
			<?php echo $this->Form->error("code"); ?>
		</td>
	</tr>

	</table>

	<div class="center">
		<?php echo $this->Form->submit("キーワードを設定",array("div"=>false,"class"=>"buttons")); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>