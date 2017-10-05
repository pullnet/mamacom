<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　サイト基本設定</div>
	<h1>振込口座情報設定</h1>
	<?php
		if(isset($alert)){
	?>
	<div class="alert-message"><?php echo $alert; ?></div>
	<?php
		}
	?>

	<div class="main_content">
		<?php echo $this->Element("common/hpset_gnavi"); ?>
		<?php echo $this->Form->create("Defaultother",array(
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
			<th>振込口座情報</th>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<th>銀行名</th>
					<td>
						<?php echo $this->Form->input("pool_bank_name",array("error"=>false)); ?>
						<?php echo $this->Form->error("pool_bank_name"); ?>
					</td>
				</tr>
				<tr>
					<th>口座支店名</th>
					<td>
						<?php echo $this->Form->input("pool_bank_areaname",array("error"=>false)); ?>
						<?php echo $this->Form->error("pool_bank_areaname"); ?>
					</td>
				</tr>
				<tr>
					<th>口座種別</th>
					<td>
						<?php echo $this->Form->input("pool_bank_type",array("error"=>false)); ?>
						<?php echo $this->Form->error("pool_bank_type"); ?>
					</td>
				</tr>
				<tr>
					<th>口座番号</th>
					<td>
						<?php echo $this->Form->input("pool_bank_number",array("error"=>false)); ?>
						<?php echo $this->Form->error("pool_bank_number"); ?>
					</td>
				</tr>
				<tr>
					<th>口座名義</th>
					<td>
						<?php echo $this->Form->input("pool_bank_caption",array("error"=>false)); ?>
						<?php echo $this->Form->error("pool_bank_caption"); ?>
					</td>
				</tr>
				<tr>
					<th>その他備考</th>
					<td>
						<?php echo $this->Form->textarea("pool_bank_other",array("class"=>"high mb0")); ?>
					</td>
				</tr>
				</table>
			</td>
		</td>
	</tr>
	<tr>
		<th>設定手数料</th>
		<td>
			<?php echo $this->Form->input("commission",array("class"=>"mini","default"=>15)); ?> %
		</td>
	</tr>
	</table>

	<div class="center mt20 mb20">
		<?php echo $this->Form->submit("振込口座情報を更新する",array("class"=>"buttons","div"=>false)); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
