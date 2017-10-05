<?php
echo $this->Html->script("ace.js");
echo $this->Html->script("ace_advance.js");
?>
<div class="bread">
	<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
	<?php echo $this->Html->link("キャンペーン管理",array("controller"=>"campaign","action"=>"index")); ?>　＞　
	キャンペーン編集
</div>
<h1>キャンペーン編集</h1>
<div class="main_content">

	<?php
	echo $this->Form->create("Campaign",array(

		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	echo $this->Form->hidden("id");
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>キャンペーン名</th>
		<td>
			<?php
				echo $this->Form->input("name",array("error"=>false));
				echo $this->Form->error("name");
			?>
		</td>
	</tr>
	<tr>
		<th>htmlコード</th>
		<td>
			<?php echo $this->Form->textarea("html",array("id"=>"html_data","style"=>"display:none")); ?>
			<div class="ace_textarea" id="html_textarea"></div>
		</td>
	</tr>
	<tr>
		<th>スマホ用htmlコード</th>
		<td>
			<?php echo $this->Form->textarea("smp_html",array("id"=>"smp_html_data","style"=>"display:none")); ?>
			<div class="ace_textarea" id="smp_html_textarea"></div>
		</td>
	</tr>
	<tr>
		<th>公開設定</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("open_status",array(0=>"公開",1=>"非会員のみ",2=>"会員のみ",3=>"非公開"),array("default"=>0,"legend"=>false)); ?>
			</div>
		</td>
	</tr>
	</table>
	<div class="center">
		<?php echo $this->Form->submit("キャンペーン情報を設定",array("div"=>false,"class"=>"buttons")); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>

<script type="text/javascript">
	aceeditor({
		textarea:"html_textarea",
		textdata:"html_data",
	});
	aceeditor({
		textarea:"smp_html_textarea",
		textdata:"smp_html_data",
	});
</script>