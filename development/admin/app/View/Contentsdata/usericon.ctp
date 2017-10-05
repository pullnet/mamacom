<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　ユーザーアイコン一覧</div>
<h1>ユーザーアイコン一覧</h1>
<div class="mb10">
	<?php echo $this->Html->link("未使用のユーザーアイコンをまとめる",array("controller"=>"contentsdata","action"=>"usericon_unview"),array("class"=>"underline")); ?>
</div>
<div class="main_content">

	<h2>コンテンツデータ一覧</h2>
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">✓</th>
		<th class="minishort">登録日</th>
		<th>使用ユーザー</th>
		<th class="short">タグ番号</th>
		<th class="mini">イメージ</th>
		<th class="mini"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td>
			<?php echo date("Y-m-d H:i:s",strtotime($r_["Useroption"]["createdate"])); ?>
		</td>
<td>
	<?php echo h($r_["User"]["nickname"]); ?>
</td>
		<td>
			<?php echo $r_["Useroption"]["value"]; ?>
		</td>
		<td>

			<div style="position:relative;width:100%;overflow:hidden;padding-bottom:100%;">
				<?php echo $this->Html->image($itemurl."smpimg/usericon/".$r_["Useroption"]["value"],array("style"=>"position:absolute")); ?>
			</div>
		</td>	
		<td>
			<a href="area_view.html" class="buttons">詳細</a>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"contentsdata","action"=>"usericon",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"contentsdata","action"=>"usericon",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"contentsdata","action"=>"usericon",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>

</div><!--//.main_content-->