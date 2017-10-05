<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("コラボス運営メッセージ管理",array("controller"=>"talk","action"=>"originalmsg")); ?>　＞　
メッセージの新規登録・編集</div>
<h1>メッセージの新規登録・編集</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Originalmsg",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	?>
	<table cellspacing="0" cellpadding="0" class="mb30">
	<tr>
		<th colspan="2">メッセージ内容</th>
	</tr>
	<tr>
		<td colspan="2">
			<?php
			echo $this->Form->textarea("message",array("class"=>"high","required"=>false,"error"=>false)); 
			echo $this->Form->error("message");
			?>
		</td>
	</tr>
	<tr>
		<th colspan="2">メッセージ内容(ショート文)</th>
	</tr>
	<tr>
		<p>※htmlタグ使用不可</p>
		<td colspan="2">
			<?php
			echo $this->Form->textarea("message_short",array("class"=>"high_2","required"=>false,"error"=>false)); 
			echo $this->Form->error("message_short");
			?>
		</td>
	</tr>
	</table>

	<div class="center">
		<?php echo $this->Form->submit("メッセージを登録",array("div"=>false,"class"=>"buttons")); ?>
	</div>

	<?php echo $this->Form->end(); ?>
</div>