<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("支払管理(クレジット決済)",array("controller"=>"payment","action"=>"credit")); ?>　＞　
支払情報詳細(クレジット決済)
</div>
<h1>支払情報詳細(クレジット決済)</h1>
<?php
if(isset($alert)){
?>

	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}

if($result["Order"]["libraryorderset_id"]){
	$type="library";
}
else if($result["Order"]["collaboparty_id"]){
	$type="collabo";
}
?>
<table cellspacing="0" cellpadding="0">
<tr>
	<th>注文番号</th>
	<td>
		<?php echo $this->Html->link($result["Order"]["number"],array("controller"=>"order","action"=>"detail",$result["Order"]["id"]),array("class"=>"underline")); ?>
	</td>
</tr>
<tr>
	<th>注文日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Order"]["order_date"])); ?>
	</td>
</tr>
<tr>
	<th>注文形態</th>
	<td>
		<?php
		if($type=="library"){
			echo "ライブラリ発注";
		}
		else if($type=="collabo"){
			echo "コラボ参加";
		}
		?>
	</td>
</tr>
<tr>
	<th>請求金額</th>
	<td>
		<p class="h3">￥<?php echo number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]); ?></p>
		<p>(手数料分:￥<?php echo number_format(($result["Order"]["hope_price"]*$result["Order"]["order_count"])*($commission*0.01)); ?>)</p>
	</td>
</tr>
<tr>
	<th>請求先</th>
	<td>
		<?php echo $this->Html->link($result["User"]["nickname"],array("controller"=>"users","action"=>"view",$result["User"]["id"]),array("class"=>"underline")); ?>
	</td>
</tr>

</table>
