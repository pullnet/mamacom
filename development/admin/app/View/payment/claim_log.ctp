<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
振込履歴
</div>

<?php
if(isset($alert)){
?>
<div class="error-message"><?php echo $alert; ?></div>
<?php
}
?>

<h1>振込履歴</h1>
<div class="search">
	<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
	<label for="shdk" class="toggle">検索フォーム</label>
	<div class="window">
		<?php
		echo $this->Form->create("",array(
			"type"=>"get",
			"url"=>array("controller"=>"payment","action"=>"claim_log",1,"?"=>@$this->request->query),
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
			<th>振込状況</th>
			<td>
				<?php echo $this->Form->select("payment_status",array(1=>"振込中",2=>"振込済み"),array("class"=>"mini","value"=>@$this->request->query["paypool"],"empty"=>"---")); ?>
			</td>
		</tr>
		</table>
		<div class="center">
			<?php echo $this->Form->submit("検索する",array("class"=>"buttons","div"=>false)); ?>
		</div>
	<?php echo $this->Form->end(); ?>
	</div><!--//.window-->
</div><!--//.search-->

<?php
echo $this->Form->create("Orderclaim",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
?>
<p class="mb10">選択した振込情報を
<?php echo $this->Form->select("payment_status",$payment_status,array("class"=>"short","empty"=>false)); ?> 
<?php echo $this->Form->submit("変更する",array("div"=>false,"class"=>"buttons")); ?>
</p>
<style>
.active{
	background:#f0f0f0;
}
</style>
<table cellspacing="0" cellpadding="0" class="list mb30">
<tr>
	<th class="micro">✔</th>
	<th class="minishort">発行日</th>
	<th>振込番号</th>
	<th class="minishort">金額(利益)</th>
	<th class="mini">振込状況</th>
	<th class="mini"></th>
</tr>
<?php
$count=0;
foreach($claimlog as $c_){
	$count++;
?>
<tr class="<?php if($c_["Orderclaim"]["payment_status"]==1){ echo "active"; } ?>">
	<td class="center">
		<?php
		if($c_["Orderclaim"]["payment_status"]==0){
		?>
		<label>
			<?php echo $this->Form->input("Orderclaim.select.".$count,array("type"=>"checkbox","value"=>$c_["Orderclaim"]["id"],"class"=>"middle")); ?>
			<span style="margin-right:0px"></span>
		</label>
		<?php
		}
		?>
	</td>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($c_["Orderclaim"]["claim_date"])); ?>
	</td>
	<td>
		<?php echo $c_["Orderclaim"]["number"];?>
	</td>
	<td>
		￥<?php echo number_format($c_["Orderclaim"]["price"]);?>
	</td>
	<td>
		<?php echo $payment_status[$c_["Orderclaim"]["payment_status"]]; ?>
	</td>
	<td>
		<?php echo $this->Html->link("詳細",array("controller"=>"payment","action"=>"claim_log_detail",$c_["Orderclaim"]["id"]),array("class"=>"buttons")); ?>
	</td>
</tr>
<?php
}
?>
</table>
<?php
echo $this->Form->end();
?>