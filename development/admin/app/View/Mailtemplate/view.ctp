<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link("メールテンプレート一覧",array("controller"=>"mailtemplate","action"=>"index")); ?>　＞　「<?php echo $result["Mailtemplate"]["name"]; ?>」の情報詳細</div>
	<h1>「<?php echo $result["Mailtemplate"]["name"]; ?>」の情報詳細</h1>
	<div class="main_content">
		<div class="gnavi">
			<ul class="float">
				<li><?php echo $this->Html->link("テンプレートを編集",array("controller"=>"mailtemplate","action"=>"edit",$result["Mailtemplate"]["id"]),array("class"=>"butttons")); ?></li>
			</ul>
		</div><!--//.gnavi-->

		<table cellspacing="0" cellpadding="0" class="mb20">
		<tr>
			<th>登録日</th>
			<td><?php echo date("Y-m-d H:i",strtotime($result["Mailtemplate"]["createdate"])); ?></td>
			<th>更新日</th>
			<td>2015年00月00日 00:00</td>
		</tr>
		<tr>
			<th>テンプレート名</th>
			<td colspan="3"><?php echo $result["Mailtemplate"]["name"]; ?></td>
		</tr>
		<tr>
			<th>メール本文</th>
			<td colspan="3">
				<?php echo nl2br($result["Mailtemplate"]["header"]); ?>
				<br>
				<br>
				<p style="color:#292">～～※ここにメールフォーマット文が入ります～～</p>
				<br>
				<br>
				<?php echo nl2br($result["Mailtemplate"]["footer"]); ?>
			</td>
		</tr>
	</table>
</div>
