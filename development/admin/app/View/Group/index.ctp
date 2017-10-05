<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　グループ管理</div>
<h1>グループ管理</h1>
<div class="main_content">
	<div class="right mb20">
		<?php echo $this->Html->link("新規グループ追加",array("controller"=>"group","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>グループ名</th>
		<th class="minishort">リーダー</th>
		<th class="mini">メンバー数</th>
		<th class="minishort"></th>
	</tr>
		<?php
		$count=$limit*($page-1);
		foreach($result as $rg_){
			$count++;
		?>
		<tr>
			<td class="center"><?php echo $count; ?></td>
			<td><?php echo date("Y.m.d H:i",strtotime($rg_["Group"]["createdate"])); ?></td>
			<td>
				<?php echo $rg_["Group"]["name"]; ?>
				
			</td>
			<td>
				<?php echo $rg_["Groupleader"]["User"]["nickname"]; ?>
			</td>
			<td>
				<?php echo count($rg_["Groupuser"])+1; ?>人
			</td>
			<td>
				<?php echo $this->Html->link("詳細",array("controller"=>"group","action"=>"view",$rg_["Group"]["id"]),array("class"=>"buttons")); ?>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"group","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"group","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"group","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>

</div>