<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("振込管理",array("controller"=>"payment","action"=>"claim")); ?>　＞　
ユーザー未支払情報一覧
</div>
<h1>ユーザー未支払情報一覧</h1>

<table cellspacing="0" cellpadding="0" class="mb30">
<tr>
	<th>ユーザー名</th>
	<td>
		<?php echo h($result["User"]["nickname"]); ?>
		(<?php echo h($result["User"]["username"]); ?>)
	</td>
</tr>
</table>

<h2>未支払情報一覧</h2>

<table cellspacing="0" cellpadding="0" class="list mb30">
<tr>
	<th class="micro">No</th>
	<th class="short">支払確認日</th>
	<th>注文情報</th>
	<th class="minishort">金額(利益)</th>
</tr>
<?php
$count=0;
foreach($orderlist as $o_){
	$count++;
?>
<tr>
	<td class="center"><?php echo $count; ?></td>
	<td><?php echo date("Y-m-d H:i",strtotime($o_["Order"]["payment_paydate"])); ?></td>
	<td>
		<?php echo h($o_["Order"]["number"]); ?>
	</td>
	<td>
		<?php
			$totalprice_all=$o_["Order"]["hope_price"]*$o_["Order"]["order_count"];
			$totalprice=$o_["Order"]["hope_price"]*$o_["Order"]["order_count"]*(1-($commission*0.01));
		?>
		<p class="h3 red">￥<?php echo number_format($totalprice); ?></p>
		<p>(総売上:￥<?php echo number_format($totalprice_all); ?>)</p>
	</td>
</tr>
<?php
}
?>
</table>
