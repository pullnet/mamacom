<div class="bread">
	<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
	<?php echo $this->Html->link("送信メールログ一覧",array("controller"=>"mail","action"=>"index")); ?>　＞　
	送信メールログ詳細
</div>
<h1>送信メールログ詳細</h1>


<table>
<tr>
	<th>送信日</th>
	<td><?php echo date("Y-m-d H:i",strtotime($result["Maillog"]["send_date"])); ?></td>
</tr>
<tr>
	<th>送信先</th>
	<td>
	<?php
		echo h(@$result["Touser"]["nickname"])."<br>";
		$address=explode("|",$result["Maillog"]["mailaddress"]);
		echo $address[0];
	?>
	</td>
</tr>
<tr>
	<th>送信者</th>
	<td>
	<?php
	if($result["Maillog"]["createstatus"]==0){
		echo h(@$result["Fromuser"]["nickname"]);
	}
	else
	{
		echo "コラボス運営";
	}
	?>
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
