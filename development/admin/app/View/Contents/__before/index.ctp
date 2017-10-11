<?php
if($this->params["controller"]=="collabo")
{
	$typename="コラボ";
}
else if($this->params["controller"]=="library")
{
	$typename="ライブラリ";
}
?>
<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $typename; ?>一覧</div>
<h1><?php echo $typename; ?>一覧</h1>
	<?php
	if(isset($alert))
	{
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
			echo $this->Form->create(null,array(
				"type"=>"get",
				"url"=>array("controller"=>$this->params["controller"],"action"=>"index",1),
				"inputDefaults"=>array(
					"div"=>false,
					"label"=>false,
					"legend"=>false,
					"required"=>false,
				),
			));
			?>
				<table cellspacing="0" cellpadding="0" class="mb20">
				<tr>
					<th>キーワード検索</th>
					<td>
						<?php echo $this->Form->input("keyword",array("value"=>@$this->request->query["keyword"])); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="center">
						<?php echo $this->Form->submit("検索する",array("div"=>false,"class"=>"buttons")); ?>
					</td>
				</tr>
				</table>
			<?php echo $this->Form->end(); ?>
		</div><!--//.window-->
	</div><!--//.search-->
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th><?php echo $typename; ?>情報</th>
		<th class="mini">状況</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td>
			<?php echo date("Y-m-d H:i",strtotime($r_["Content"]["record_date"])); ?>
		</td>
		<td>
			<?php echo $this->Html->link(h($r_["Content"]["title"]),$wwwurl.$r_["User"]["username"]."/".$this->params["controller"]."/detail/id:".$r_["Content"]["id"],array("target"=>"_blank","class"=>"underline")); ?>
			<p>オーナー:<?php echo $r_["User"]["nickname"]; ?></p>
		</td>
		<td>
		<?php echo $openstatus[$r_["Content"]["open_status"]]; ?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>$this->params["controller"],"action"=>"view",$r_["Content"]["id"]),array("class"=>"buttons")); ?>
			<label for="delete_<?php echo $count; ?>" class="buttons backbtn">削除</label>
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
			<li><?php echo $this->Html->link("<<",array("controller"=>$this->params["controller"],"action"=>"index",1,"?"=>@$this->request->query)); ?></li>
			<li><?php echo $this->Html->link("<",array("controller"=>$this->params["controller"],"action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>$this->params["controller"],"action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>$this->params["controller"],"action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<li><?php echo $this->Html->link(">>",array("controller"=>$this->params["controller"],"action"=>"index",$totalpage,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>

	<div class="right mb20">
		<?php echo $this->Html->link("一覧情報をcsv出力",array("controller"=>"contents","action"=>"dataexport"),array("class"=>"buttons")); ?>
	</div>
</div>