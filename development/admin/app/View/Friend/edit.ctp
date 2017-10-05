<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　仲間情報編集</div>
<h1>仲間情報編集</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Group",array(
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
		<th>仲間関係</th>
		<td>

		</td>
	</tr>
	<tr>
		<th>ステータス</th>
		<td>
			<?php echo $this->Form->select("status",array(0=>"申請中",1=>"承認許可",2=>"承認拒否"),array("class"=>"short","empty"=>false)); ?>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Form->submit("仲間情報を設定する",array("class"=>"buttons","div"=>false)); ?>
	</div>
<?php echo $this->Form->end(); ?>
</div>
