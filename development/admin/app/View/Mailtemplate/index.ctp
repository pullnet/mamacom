<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　メールテンプレート一覧</div>
	<h1>メールテンプレート一覧</h1>
	<?php
	if(isset($alert))
	{
	?>
	<div class="alert-message"><?php echo $alert; ?></div>
	<?php
	}
	?>

	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<div class="right mb20">
		<?php echo $this->Html->link("メールテンプレート新規追加",array("controller"=>"mailtemplate","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>テンプレート名</th>
		<th class="minishort"></th>
	</tr>
	<?php 
	$count=$limit*($page-1);
	foreach($result as $r_)
	{
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td>
		<?php echo date("Y-m-d H:i",strtotime($r_["Mailtemplate"]["refreshdate"])); ?>
		</td>
		<td>
			<?php echo h($r_["Mailtemplate"]["name"]); ?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"mailtemplate","action"=>"view",$r_["Mailtemplate"]["id"]),array("class"=>"buttons")); ?>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"mailtemplate","action"=>"index",($page-1))); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"mailtemplate","action"=>"index",$svc)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"mailtemplate","action"=>"index",($page+1))); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
	<div class="right mb20">
		<?php echo $this->Html->link("一覧情報をcsv出力",array("controller"=>"mailtemplate","action"=>"dataexport"),array("class"=>"buttons")); ?>
	</div>
