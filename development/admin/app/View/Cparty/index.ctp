<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　コラボ参加表明情報一覧</div>
<h1>コラボ参加表明情報一覧</h1>
<?php
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
				"url"=>array("controller"=>"order","action"=>"index",1,"?"=>@$this->request->query),
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
				<th>キーワード検索</th>
				<td>
					<?php echo $this->Form->input("keyword",array("value"=>@$this->request->query["keyword"])); ?>
				</td>
			</tr>
			<tr>
				<th>コラボ参加ステータス</th>
				<td>
					<?php echo $this->Form->select("party_status",$partystatus,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["party_status"])); ?>
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
	<style>
	table tr.default{
		background:#f0f0f0;
	}
	</style>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="short">参加表明日/注文番号</th>
		<th class="minishort">参加決定日</th>
		<th class="minishort">希望金額/ステータス</th>
		<th>参加内容</th>
		<th style="width:250px;">コラボ管理者/参加者</th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_["Collaboparty"]["party_date"])); ?><br>
			<?php echo $this->Html->link(h($r_["Collaboparty"]["number"]),array("controller"=>"cparty","action"=>"detail",$r_["Collaboparty"]["id"]),array("class"=>"underline")); ?>
		</td>
		<td><?php
		if($r_["Collaboparty"]["deadline_date"]){
			echo date("Y-m-d H:i",strtotime($r_["Collaboparty"]["deadline_date"]));
		}
		?></td>
		<td>
			<p class="h4">￥<?php echo number_format($r_["Collaboparty"]["hope_price"]); ?></p>
			<?php echo $partystatus[$r_["Collaboparty"]["party_status"]]; ?>
		</td>
		<td>
			<dl>
				<dt>参加コラボ名</dt>
				<dd style="margin-bottom:0px;"><?php echo h($r_["Contentbuffer"]["Content"]["title"]); ?><br>
				<?php echo h($r_["Contentbuffer"]["Collabopartyset"]["title"]); ?></dd>
			</dl>
		</td>
		<td>
			<?php echo h(@$r_["Owner"]["nickname"]); ?> / 
			<?php echo h(@$r_["User"]["nickname"]); ?>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"cparty","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"cparty","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"cparty","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
</div>
