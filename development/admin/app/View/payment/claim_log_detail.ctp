<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("振込履歴",array("controller"=>"payment","action"=>"claim_log")); ?>　＞　
振込履歴詳細
</div>
<h1>振込履歴詳細</h1>
<div class="right">
	<ul class="float">
		<li class="mb10"><a onclick="window.print()" class="buttons">印刷する</a></li>
		<li class="f_right"><?php echo $this->Html->link("振込情報を取り消す",array("controller"=>"payment","action"=>"claim_cancel",$result["Orderclaim"]["id"]),array("class"=>"buttons","style"=>"background:#900;border:solid 1px #900")); ?></li>
	</ul>

</div>
<table cellspacing="0" cellpadding="0" class="mb30">
<tr>
	<th>振込情報番号</th>
	<td>
		<?php echo $result["Orderclaim"]["number"]; ?>
	</td>
</tr>
<tr>
	<th>作成日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Orderclaim"]["claim_date"])); ?>
	</td>
</tr>
<tr>
	<th>振込先ユーザー</th>
	<td>
		<?php echo h($result["User"]["nickname"]); ?>
	</td>
</tr>
<tr>
	<th>振込金額</th>
	<td>
		￥<?php echo number_format($result["Orderclaim"]["price"]); ?>
	</td>
</tr>
<tr>
	<th>振込先情報</th>
	<td>
		<?php
		if($result["User"]["paypool_json"]){
			$json_paypool=json_decode($result["User"]["paypool_json"],true);
			?>
			<dl>
				<dt>銀行名</dt>
				<dd>
					<?php echo h($json_paypool["name"]); ?>
				</dd>
				<dt>支店名</dt>
				<dd>
					<?php echo h($json_paypool["area"]); ?>
				</dd>
				<dt>口座種別</dt>
				<dd>
					<?php
					$types=array(
					0=>"普通",
					1=>"当座",
					);
					echo $types[$json_paypool["type"]]; ?>
				</dd>
				<dt>口座番号</dt>
				<dd>
					<?php echo h($json_paypool["number"]); ?>
				</dd>
				<dt>口座名義</dt>
				<dd>
					<?php echo h($json_paypool["user"]); ?>
				</dd>

			</dl>
			<?php
		}
		else
		{
		?>
			<p>まだ振込先情報が設定されていません</p>
		<?php
		}
		?>
	</td>
</tr>
<tr>
	<th>振込ステータス</th>
	<td>
		<?php
		$payment_status=array(
			0=>"振込中",
			1=>"振込済み",
		);
		echo $payment_status[$result["Orderclaim"]["payment_status"]];
		?>
	</td>
</tr>
</table>