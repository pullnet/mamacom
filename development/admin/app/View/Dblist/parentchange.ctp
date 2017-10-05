<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link($view["title"]."一覧",array()); ?>　＞　
<?php echo $this->Html->link($view["title"]."詳細",array()); ?>　＞　
親カテゴリー変更</div>
<h1>親カテゴリー変更</h1>

<div class="main_content">

	<h2><?php echo $view["subtitle2"]; ?>情報</h2>
	<?php echo $this->Form->create($view["models"],array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	echo $this->Form->hidden("id");
	echo $this->Form->hidden($view["model_parent"].".id");
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>登録日</th>
		<td colspan="3"><?php echo date("Y-m-d H:i",strtotime($post[$view["models"]]["createdate"])); ?></td>
	</tr>

	<tr>
		<th>対象カテゴリー名</th>
		<td colspan="3"><?php echo $post[$view["models"]]["name"]; ?></td>
	</tr>
	<tr>
		<th>DB管理名</th>
		<td colspan="3"><?php echo $view["title"]; ?></td>
	</tr>
	<tr>
		<th>現行親カテゴリー名</th>
		<td colspan="3"><?php echo $post[$view["model_parent"]]["name"]; ?></td>
	</tr>
	</table>

	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>変更親カテゴリー</th>
		<td colspan="3">
			<?php echo $this->Form->select($view["models_parentid"],$parent_list,array("empty"=>false,"error"=>false)); ?>
			<?php echo $this->Form->error($view["models_parentid"]); ?>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Form->submit("変更する",array("class"=>"short","div"=>false)); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
