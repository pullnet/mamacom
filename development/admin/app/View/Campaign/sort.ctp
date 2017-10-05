<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("キャンペーン管理",array("controller"=>"campaign","action"=>"index")); ?>　＞　
キャンペーン情報表示並び替え
</div>
<h1>キャンペーン情報表示並び替え</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Campaignsort",array(

		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	echo $this->Form->hidden("id");
	?>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th>キャンペーン名</th>
		<th class="minishort">


		</th>
	</tr>
	</table>
	<div class="center">
		<?php echo $this->Form->submit("並び替えるする",array("div"=>false,"class"=>"buttons")); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>