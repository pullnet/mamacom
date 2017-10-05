<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("注文情報一覧",array("controller"=>"order","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("注文情報詳細",array("controller"=>"order","action"=>"detail",$result["Order"]["id"])); ?>　＞　
<?php echo $this->Html->link("メール通知履歴",array("controller"=>"order","action"=>"maillog",$result["Order"]["id"])); ?>　＞　
メール通知履歴_詳細
</div>
<div class="main_content">
	<h1>メール通知_詳細</h1>

<table>
<tr>
	<th>送信日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Maillog"]["send_date"])); ?>
	</td>
</tr>
<tr>
	<th>メール送信先</th>
	<td>
		<?php echo $result["Maillog"]["mailaddress"]; ?>
	</td>
</tr>
<tr>
	<th>メール件名</th>
	<td>
		<?php echo $result["Maillog"]["subject"]; ?>
	</td>
</tr>
<tr>
	<th>メール本文</th>
	<td>
		<?php echo nl2br($result["Maillog"]["message"]); ?>
	</td>
</tr>
</table>
</div>