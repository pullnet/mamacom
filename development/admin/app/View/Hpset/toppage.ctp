<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　トップページ設定</div>
<h1>トップページ設定</h1>
	<?php
		if(isset($alert))
		{
	?>
	<div class="alert-message"><?php echo $alert; ?></div>
	<?php
		}
	?>
<div class="main_content">
	<?php echo $this->Element("common/hpset_gnavi"); ?>

	<?php
	echo $this->Form->create("Defaulttoppage",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	?>
		<table cellspacing="0" cellpadding="0">
		<tr>
			<th>トップページスペース</th>
		</tr>
		<tr>
			<td>
				<?php echo $this->Form->textarea("html_top",array("class"=>"high")); ?>
			</td>
		</tr>
		<tr>
			<th>会員ログイン時トップページスペース</th>
		</tr>
		<tr>
			<td>
				<?php echo $this->Form->textarea("html_top_logined",array("class"=>"high")); ?>
			</td>
		</tr>
		</table>
		<div class="center mt20 mb20">
			<?php echo $this->Form->submit("トップページ情報を設定する",array("div"=>false,"class"=>"short")); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>