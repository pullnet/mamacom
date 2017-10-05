<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　コラボス運営メッセージ管理</div>
<h1>コラボス運営メッセージ管理</h1>
<?php
if(isset($alert)){
?>
<div class="error-message mb10"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	<div class="right mb20">
		<?php echo $this->Html->link("メッセージ新規追加",array("controller"=>"talk","action"=>"originalmsg_add"),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="list mb30">
	<tr>
		<th class="micro">No.</th>
		<th class="short">送信日</th>
		<th>送信メッセージ前文</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=0;
	foreach($result_m as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo $r_["Message"]["send_date"]; ?></td>
		<td><?php echo $r_["Message"]["message"]; ?></td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"talk","action"=>"originalmsg_detail",$r_["Message"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
</div>
