<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
振込管理
</div>
<h1>振込管理</h1>

<div class="search">
	<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
	<label for="shdk" class="toggle">検索フォーム</label>
	<div class="window">
		<?php
		echo $this->Form->create("",array(
			"type"=>"get",
			"url"=>array("controller"=>"payment","action"=>"claim",1,"?"=>@$this->request->query),
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
			<th>振込先情報</th>
			<td>
				<?php echo $this->Form->select("paypool",array(1=>"有り",2=>"無し"),array("class"=>"mini","value"=>@$this->request->query["paypool"],"empty"=>"---")); ?>
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
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

<table cellspacing="0" cellpadding="0" class="list mb30">
<tr>
	<th class="micro">No</th>
	<th>ユーザー名</th>
	<th class="mini">振込先情報<br>(有無)</th>
	<th class="minishort">未払金額</th>
	<th class="short"></th>
</tr>
<?php
$count=0;
foreach($result as $r_){
	$count++;
?>
<tr>
	<td class="center"><?php echo $count; ?></td>
	<td>
		<?php
		echo h($r_["User"]["nickname"])."<br>".h($r_["User"]["username"]);
		?>
	</td>
	<td class="center">
		<?php
		if($r_["User"]["paypool_json"]){
			echo "○";

		}
		else
		{
			echo "-";
		}
		?>
	</td>
	<td>
		<?php
		$totalprice=0;
		$totalprice_all=0;
		foreach($r_["Orderlist"] as $ro_){
			$totalprice_all+=($ro_["Order"]["hope_price"]*$ro_["Order"]["order_count"]);
			$totalprice+=($ro_["Order"]["hope_price"]*$ro_["Order"]["order_count"])*(1-($commission*0.01));
		}
		?>
		<p class="h3 red"><?php echo "￥".number_format($totalprice); ?></p>
		<p>(総売上:￥<?php echo number_format($totalprice_all); ?>)</p>
	</td>
	<td>
		<?php
		if($r_["User"]["paypool_json"]){
			echo $this->Html->link("振込情報作成",array("controller"=>"payment","action"=>"claim_create",$r_["User"]["id"]),array("class"=>"buttons"));
		}
		else
		{

		}
		?>
		<br>
		<?php echo $this->Html->link("未支払一覧",array("controller"=>"payment","action"=>"claim_detail",$r_["User"]["id"]),array("class"=>"underline")); ?>
		<?php echo $this->Html->link("振込履歴",array("controller"=>"payment","action"=>"claim_log",$r_["User"]["id"]),array("class"=>"underline")); ?>
	</td>
</tr>	
<?php
}
?>
</table>

