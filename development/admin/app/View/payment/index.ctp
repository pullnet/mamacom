<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　支払管理</div>
<h1>支払管理</h1>
<?php
$order_status2=array(
	"paybefore_workquery"=>"未入金",
	"working"=>"入金済み",
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
				<th>ステータス</th>
				<td>
					<?php echo $this->Form->select("order_status",$order_status2,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["payment_status"])); ?>
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
		選択した支払情報のステータスを
		<?php

		echo $this->Form->select("order_status",$order_status2,array("class"=>"short","empty"=>false)); ?>
		に
		<?php echo $this->Form->submit("一括変更",array("div"=>false,"class"=>"buttons add")); ?>
	</div>

	<style>
	table tr.default{
		background:#f0f0f0;
	}
	</style>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th style="width:20px">✓</th>
		<th style="width:200px">発注日/注文番号</th>
		<th style="width:150px">支払方法/ステータス</th>
		<th style="width:80px">請求金額</th>
		<th style="width:200px">納品日/支払請求日/支払日</th>
		<th>発注タイトル</th>
		<th style="width:150px">発注者/受注者</th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;

		$class="";
		if(@$r_["Order"]["payment_startdate"]){
			$class="background:#f0f0f0;";
		}
		if(@$r_["Order"]["payment_exitdate"]){
			$class="background:#d0d0d0;";
		}
//		if(@$r_["Order"]["forward_date"] || @$r_["Order"]["claim_startdate"] || @$r_["Order"]["claim_exitdate"]){
//			$class="background:#f0f0f0;";
//		}
	?>
	<tr style="<?php echo $class; ?>">
		<td class="center">
			<?php
			if(!$r_["Order"]["payment_exitdate"]){
			?>
			<label class="center">
				<?php echo $this->Form->hidden("Order.check.".$count.".before_status",array("value"=>$r_["Order"]["order_status"])); ?>
				<?php echo $this->Form->input("Order.check.".$count.".id",array("type"=>"checkbox","class"=>"middle","value"=>$r_["Order"]["id"])); ?>
				<span style="margin-right:0px;"></span>
			</label>
			<?php
			}
			?>
		</td>
		<td>
			<?php echo date("Y-m-d H:i",strtotime($r_["Order"]["order_date"])); ?><br>
			<?php echo $this->Html->link(h($r_["Order"]["number"]),array("controller"=>"order","action"=>"detail",$r_["Order"]["id"]),array("class"=>"underline")); ?>
		</td>
		<td>
			<?php echo $payment[$r_["Order"]["payment"]];?><br>
			<?php
				if(!@$r_["Order"]["payment_startdate"] && !@$r_["Order"]["payment_exitdate"]){
					echo "未入金";
				}
				else if(@$r_["Order"]["payment_startdate"] && !@$r_["Order"]["payment_exitdate"]){
					echo "請求中";
				}
				else if(@$r_["Order"]["payment_startdate"] && @$r_["Order"]["payment_exitdate"]){
					echo "入金済み";
				}
			?>
		</td>
		<td>￥<?php echo number_format($r_["Order"]["hope_price"]*$r_["Order"]["order_count"]); ?></td>
		<td>
		<?php
		if(@$r_["Order"]["forward_date"]){
			echo "<p><span style='background:#cfc'>納品</span>".date("Y-m-d H:i",strtotime($r_["Order"]["forward_date"]))."</p>";
		}
		if(@$r_["Order"]["payment_startdate"]){
			echo "<p>支払".date("Y-m-d H:i",strtotime($r_["Order"]["payment_startdate"]))."</p>";
		}
		if(@$r_["Order"]["payment_exitdate"]){
			echo "<p><span style='background:#aaa'>支完</span>".date("Y-m-d H:i",strtotime($r_["Order"]["payment_exitdate"]))."</p>";
		}
		if(@$r_["Order"]["claim_startdate"]){
		?>
		<p><span style='background:#fcc'>振込</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["claim_startdate"])); ?></p>
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
			<p class="red"><span style="background:#900;color:#fff">振予</span><?php echo date("Y-m-d",strtotime($claim_exitdate_plan)); ?></p>
			<?php
			}
		}
		if(@$r_["Order"]["claim_exitdate"]){
		?>
		<p><span 振完:<?php echo date("Y-m-d H:i",strtotime($r_["Order"]["claim_exitdate"])); ?></p>
		<?php
		}
		?>
		</td>
		<td>
			<p>請求先:<?php echo $r_["Outputuser"]["nickname"]; ?></p>
			<p>発注タイトル:<?php echo h($r_["Contentbuffer"]["Content"]["title"]); ?></p>
		</td>
		<td>
			<?php echo $r_["Outputuser"]["nickname"]."/".$r_["Inputuser"]["nickname"];; ?>
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
