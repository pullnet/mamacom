<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　振込管理</div>
<h1>振込管理</h1>
<?php
$payment_status=array(
	1=>"支払請求中",
	2=>"支払確認済み",
);
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	<div class="search">

	</div>

	<?php
	echo $this->Form->create("Order",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	?>
	<p class="h4 mb10">選択した注文情報の振込状況を <?php echo $this->Form->submit("振込済みにする",array("div"=>false,"class"=>"buttons")); ?></p>
	<table cellspacing="0" cellpadding="0" class="tables list mb30">
	<tr>
		<th style="width:20px">✓</th>
		<th style="width:200px">振込依頼日/注文番号</th>
		<th style="width:150px">振込金額/振込状況</th>
		<th style="width:200px">受注日／納品日／検品日</th>
		<th>注文内容</th>
		<th style="width:150px">振込先情報</th>
		<th style="width:150px">発注者/受注者</th>
	</tr>
	<?php
	$count=0;
	foreach($result as $r_){
		$cd_data=json_decode($r_["Contentbuffer"]["buffer"],true);

		$count++;
	?>
	<tr style="background:<?php if($r_["Order"]["order_status"]=="transfer_complete"){ echo "#e0e0e0";} ?>">
		<td class="center">
			<?php
			if($r_["Order"]["order_status"]=="transfer_request"){
			?>
			<label>
				<?php echo $this->Form->input("Order.check.".$count,array("type"=>"checkbox","class"=>"middle","value"=>$r_["Order"]["id"])); ?>
				<span style="margin-right:0px"></span>
			</label>
			<?php
			}
			?>
		</td>
		<td>
			<?php 
			if($r_["Order"]["claim_startdate"]){
				echo date("Y-m-d H:i",strtotime($r_["Order"]["claim_startdate"]));
			}
			?><br>
			<?php echo $this->Html->link(h($r_["Order"]["number"]),array("controller"=>"order","action"=>"detail",$r_["Order"]["id"]),array("class"=>"underline")); ?>
		</td>
		<td>
			<?php
			if($r_["Order"]["order_status"]=="transfer_complete"){
			?>
			<p class="h3"><?php echo "￥".number_format(($r_["Order"]["hope_price"]*$r_["Order"]["order_count"])*(1-$commission*0.01)); ?></p>
			<?php
			}
			else
			{
			?>
			<p class="h3 red"><?php echo "￥".number_format(($r_["Order"]["hope_price"]*$r_["Order"]["order_count"])*(1-$commission*0.01)); ?></p>
			<?php
			}
			?>
			<p>支払金額:<?php echo "￥".number_format($r_["Order"]["hope_price"]*$r_["Order"]["order_count"]); ?></p>
			<?php
			if($r_["Order"]["order_status"]=="transfer_request"){
				echo "<span class='red'>未振込</span>";
			}
			else if($r_["Order"]["order_status"]=="transfer_complete"){
				echo "振込済み";
			}
			?>
		</td>
		<td>
			<p><span style="background:#fcc;">受注</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["order_date"])); ?></p>
			<p><span style="background:#cfc;">納品</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["pre_forward_date"])); ?></p>
			<p><span style="background:#aef;">検品</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["forward_date"])); ?></p>
			<?php
			if(!@$r_["Order"]["claim_exitdate"]){
				if(date("d")<15){
					$claim_exitdate_plan=date("Y-m-t");
				}
				else
				{
					if(date("d")==31){
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 day"));
					}
					else
					{
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 month"));
					}
				}
			?>
			<p class="red"><span style="background:#c00;color:#fff">振予</span><?php echo date("Y-m-d",strtotime($claim_exitdate_plan)); ?></p>
			<?php
			}
			?>

		</td>
		<td>
			<p>種類:
			<?php
			if($r_["Order"]["libraryorderset_id"]){
				echo "ライブラリ発注";
			}
			else if($r_["Order"]["collaboparty_id"]){
				echo "コラボ参加";
			}
			?>
			</p>
			<p><?php echo h($cd_data["Content"]["title"]); ?></p>
			<p><?php
			if($r_["Order"]["libraryorderset_id"]){
				echo h($cd_data["Libraryorderset"]["title"]);
			}
			else if($r_["Order"]["collaboparty_id"]){
				echo h($cd_data["Collabopartyset"]["title"]);
			}
			?>
			</p>
		</td>
		<td>
			<?php
			$paydata=json_decode($r_["Inputuser"]["paypool_json"],true);
			if(@$paydata["name"] && @$paydata["number"]){
			?>
			<p><strong>銀行名:</strong><?php echo h(@$paydata["name"]); ?></p>
			<p><strong>支店名:</strong><?php echo h(@$paydata["area"]); ?></p>
			<p><strong>口座種別:</strong><?php if(@$paydata["type"]==0){ echo "普通"; }else if($paydata["type"]==1){ echo "当座"; } ?></p>
			<p><strong>口座番号:</strong><?php echo h(@$paydata["number"]); ?></p>
			<p><strong>口座名義:</strong><?php echo h(@$paydata["user"]); ?></p>
			<?php
			}
			else
			{
			?>
				<p>振込先未設定</p>
			<?php
			}
			?>
		</td>
		<td>
			<?php echo $r_["Outputuser"]["nickname"]."/".$r_["Inputuser"]["nickname"];; ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

	<?php echo $this->Form->end(); ?>

</div>