<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link("メールフォーマット一覧",array("controller"=>"mailformat","action"=>"index")); ?>　＞　「<?php echo $result["Mailformat"]["name"]; ?>」の情報詳細</div>
	<h1>「<?php echo $result["Mailformat"]["name"]; ?>」の情報詳細</h1>
	<div class="main_content">
		<div class="gnavi">
			<ul class="float">
				<li><?php echo $this->Html->link("メールフォーマットの編集",array("controller"=>"mailformat","action"=>"edit",$result["Mailformat"]["id"])); ?></li>
				<!--<li><a href="mailformat_edit.html">送信履歴</a></li>-->
			</ul>
		</div><!--//.gnavi-->
		<h2>メールフォーマット情報</h2>
		<table cellspacing="0" cellpadding="0" class="mb20">
		<tr>
			<th>登録日</th>
			<td>
				<?php echo date("Y-m-d H:i",strtotime($result["Mailformat"]["createdate"])); ?>
			</td>
		</tr>
		<tr>
			<th>フォーマット名</th>
			<td colspan="3">
				<?php echo $result["Mailformat"]["name"]; ?>
			</td>
		</tr>
		<tr>
			<th>フォーマットコード</th>
			<td><?php echo $result["Mailformat"]["code"]; ?></td>
		</tr>
		<tr>
			<th>フォーマットカテゴリー</th>
			<td colspan="3">
				<?php echo @$format_category[$result["Mailformat"]["category"]]; ?>
			</td>
		</tr>
		<tr>
			<th>サブカテゴリー</th>
			<td><?php echo $result["Mailformat"]["sub_category"]; ?></td>
		</tr>
		<tr>
			<th>使用テンプレート</th>
			<td colspan="3">
				<?php echo $result["Mailtemplate"]["name"]; ?>
			</td>
		</tr>
		</table>

		<h2>送信メール情報</h2>
		<table cellspacing="0" cellpadding="0" class="mb20">
		<tr>
			<th>メール件名</th>
			<td><?php echo $result["Mailformat"]["subject"]; ?></td>
		</tr>
		<tr>
			<th>メール本文内容</th>
			<td>
				<?php
					echo nl2br($result["Mailtemplate"]["header"]."\n");
					echo nl2br($result["Mailformat"]["message"]."\n");
					echo nl2br($result["Mailtemplate"]["footer"]);
				?>
			</td>
		</tr>

		</table>
	</div>
