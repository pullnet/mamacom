<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("振込管理",array("controller"=>"transferrequest","action"=>"index")); ?>　＞　
振込管理詳細
</div>
<h1>振込管理詳細</h1>
<?php
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	<table cellspacing="0" cellpadding="0" class="tables mb30">
	<tr>
		<th>注文番号</th>
		<td><?php echo $this->Html->link($result["Order"]["number"],array("controller"=>"order","action"=>"detail",$result["Order"]["id"]),array("class"=>"underline")); ?></td>
	</tr>
	<tr>
		<th>発注日</th>
		<td><?php echo date("Y-m-d H:i",strtotime($result["Order"]["order_date"])); ?></td>
	</tr>
	<tr>
		<th>注文形態</th>
		<td>
			<?php
			if($result["Order"]["libraryorderset_id"]){
				echo "ライブラリ発注";
			}
			else if($result["Order"]["collaboparty_id"]){
				echo "コラボ参加";
			}
			?>
		</td>
	</tr>
	<tr>
		<th>注文内容</th>
		<td>

			<p><?php echo $result["Contentbuffer"]["Content"]["title"]; ?></p>
			<p>
			<?php
			if($result["Order"]["libraryorderset_id"]){
				echo $result["Contentbuffer"]["Libraryorderset"]["title"];
			}
			else if($result["Order"]["collaboparty_id"]){
				echo $result["Contentbuffer"]["Collabopartyset"]["title"];
			}
			?>
			</p>

		</td>
	</tr>
	<tr>
		<th>受注ユーザー</th>
		<td>
		<?php echo h($result["User"]["nickname"]); ?>
		</td>
	</tr>
	<tr>
		<th>発注ユーザー</th>
		<td>
		<?php echo h($result["Owner"]["nickname"]); ?>
		</td>
	</tr>
	<tr>
		<th>振込金額</th>
		<td>
			<p class="h2 red"><?php echo "￥".number_format(($result["Order"]["hope_price"]*$result["Order"]["order_count"])*(1-$commission*0.01)); ?></p>
			<p>支払金額:<?php echo "￥".number_format($result["Order"]["hope_price"]*$result["Order"]["order_count"]); ?></p>
		</td>
	</tr>
	<tr>
		<th>振込先情報</th>
		<td>
			<?php
			$paydata=json_decode($result["User"]["paypool_json"],true);
			$type=array(
				0=>"普通",
				1=>"当座",
			);
			?>
			<p><strong>銀行名:</strong><?php echo @$paydata["name"]; ?></p>
			<p><strong>支店名:</strong><?php echo @$paydata["area"]; ?></p>
			<p><strong>口座種別:</strong><?php echo @$type[$paydata["type"]]; ?></p>
			<p><strong>口座番号:</strong><?php echo @$paydata["number"]; ?></p>
			<p><strong>口座名義:</strong><?php echo @$paydata["user"]; ?></p>


		</td>
	</tr>
	<tr>
		<th>振込状況</th>
		<td>
			<p class="mb20"><?php
			if($result["Order"]["order_status"]=="transfer_request"){
				echo "未振込";
			}
			else if($result["Order"]["order_status"]=="transfer_complete"){
			echo "振込済み";
				}
			?>
			</p>

			<?php
			if($result["Order"]["order_status"]=="transfer_request"){
				echo $this->Html->link("振込済みに変更する",array("controller"=>"transferrequest","action"=>"transfer_completed",$result["Order"]["id"]),array("class"=>"buttons"));
			}
			?>
		</td>
	</tr>
	</table>
</div>