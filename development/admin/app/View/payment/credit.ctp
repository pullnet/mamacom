<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　支払管理(クレジット決済)</div>
<h1>支払管理(クレジット決済)</h1>
<?php
$payment_status=array(
	1=>"決済待ち",
	2=>"決済開始",
);
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	<div class="search">
		<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
		<label for="shdk" class="toggle">検索フォーム</label>
		<div class="window">
			<?php
			echo $this->Form->create("",array(
				"type"=>"get",
				"url"=>array("controller"=>"payment","action"=>"index",1,"?"=>@$this->request->query),
				"inputDefaults"=>array(
					"div"=>false,
					"label"=>false,
					"legend"=>false,
					"required"=>false,
				),
			));
			?>
			<table cellspacing="0" cellpadding="0" class="mb10">
			<tr>
				<th>注文番号</th>
				<td>
					<?php echo $this->Form->input("keyword",array("value"=>@$this->request->query["keyword"])); ?>
				</td>
			</tr>
			<tr>
				<th>支払ステータス</th>
				<td>
					<?php echo $this->Form->select("payment_status",$payment_status,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["payment_status"])); ?>
				</td>
			</tr>

			</table>
			<div class="center">
				<input class="buttons" type="submit" value="検索する"/>
			</div>
			<?php echo $this->Form->end(); ?>
		</div><!--//.window-->
	</div><!--//.search-->

	<p class="h3">全<?php echo count($result); ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

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

	<div class="mb20">
		選択した支払情報を
		<?php echo $this->Form->submit("決済する",array("div"=>false,"class"=>"buttons add")); ?>
	</div>

	<style>
	table tr.default{
		background:#f0f0f0;
	}
	</style>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th style="width:40px">✓</th>
		<th class="micro">No</th>
		<th class="short">注文番号</th>
		<th class="minishort">請求金額</th>
		<th class="minishort">支払請求日</th>
		<th>ステータス</th>
		<th class="mini"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;

		$class="";
		if($r_["Order"]["payment_status"]==2){
			$class="background:#f0f0f0;";
		}
	?>
	<tr style="<?php echo $class; ?>">
		<td class="center">
			<?php
			if($r_["Order"]["payment_status"]!=2){
			?>
			<label class="center">
				<?php echo $this->Form->hidden("Order.check.".$count.".before_status",array("value"=>$r_["Order"]["payment_status"])); ?>
				<?php echo $this->Form->input("Order.check.".$count.".id",array("type"=>"checkbox","class"=>"middle","value"=>$r_["Order"]["id"])); ?>
				<span style="margin-right:0px;"></span>
			</label>
			<?php
			}
			?>
		</td>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo $r_["Order"]["number"]; ?></td>
		<td>￥<?php echo number_format($r_["Order"]["hope_price"]*$r_["Order"]["order_count"]); ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["payment_claimdate"])); ?></td>
		<td>
			<?php echo $payment_status[$r_["Order"]["payment_status"]]; ?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"payment","action"=>"credit_detail",$r_["Order"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
	<?php
	if($totalpage>=2){
	?>
	<div class="pager">
		<ul class="float">
			<?php
			if($page>=2){
			?>
			<li><?php echo $this->Html->link("<",array("controller"=>"order","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"order","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"order","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
</div>
