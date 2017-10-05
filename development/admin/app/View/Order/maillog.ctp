<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("注文情報一覧",array("controller"=>"order","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("注文情報詳細",array("controller"=>"order","action"=>"detail",$result["Order"]["id"])); ?>　＞　
メール通知履歴
</div>
<div class="main_content">
	<h1>メール通知履歴</h1>


	<table class="list">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">送信日</th>
		<th class="short">送信先</th>
		<th>送信件名</th>
		<th class="minishort"></th>
	</tr>
<?php
$count=0;
foreach($maillog as $m_){
	$count++;
?>
<tr>
	<td class="center"><?php echo $count; ?></td>
	<td><?php echo date("Y-m-d H:i",strtotime($m_["Maillog"]["send_date"])); ?></td>
	<td><?php echo h($m_["Maillog"]["mailaddress"]); ?></td>
	<td><?php echo h($m_["Maillog"]["subject"]); ?></td>
	<td>
		<?php echo $this->Html->link("詳細",array("controller"=>"order","action"=>"maillog_detail",$m_["Maillog"]["id"]),array("class"=>"buttons")); ?>
	</td>
</tr>
<?php
}
?>
	</table>

</div>