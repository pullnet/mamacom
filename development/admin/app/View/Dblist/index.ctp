<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $view["title"]; ?></div>
<h1><?php echo $view["title"]; ?></h1>
<div class="main_content">
	<div class="search">
		<input type="checkbox" id="shdk" style="display:none">
		<label for="shdk" class="toggle">検索フォーム</label>
		<div class="window">
		<form method="post">
			<table cellspacing="0" cellpadding="0" class="mb20">
			<tr>
				<th>キーワード検索</th>
				<td>
					<input type="text" name="keyword">
				</td>
			</tr>
			<tr>
				<th>ステータス</th>
				<td>
					<label style="margin-right:10px">
					<input type="checkbox" name="status[0]" checked>本会員
					</label>
					<label style="margin-right:10px">
					<input type="checkbox" name="status[0]" checked>仮会員
					</label>
					<label style="margin-right:10px">
					<input type="checkbox" name="status[0]" checked>会員停止
					</label>
					<label style="margin-right:10px">
					<input type="checkbox" name="status[0]" checked>退会済
					</label>
				</td>
			</tr>
			<tr>
				<th>登録日</th>
				<td>
					<input type="text" name="start_date" class="short"> ～ <input type="text" name="end_date" class="short">
				</td>
			</tr>
			<tr>
				<th>検索件数</th>
				<td>
					<input type="text" name="limitcount" class="mini"> 件
				</td>
			</tr>
			<tr>
				<td colspan="2" class="center">
					<input type="submit" value="検索する" class="mini">
				</td>
			</tr>
			</table>
		</form>
	</div><!--//.window-->
</div><!--//.search-->
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

<div class="right mb20">
	<?php echo $this->Html->link("新規".$view["title"]."追加",array("controller"=>$this->params["controller"],"action"=>"edit"),array("class"=>"buttons")); ?>
</div>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th><?php echo $tab[0]; ?></th>
		<?php
		if($this->params["controller"]=="contentscategory"){
		?>
		<th class="minishort">URL</th>
		<?php
		}
		?>
		<th class="mini"><?php echo $tab[1]; ?></th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_[$view["model_parent"]]["createdate"])); ?></td>
		<td><?php echo $r_[$view["model_parent"]]["name"]; ?></td>
		<?php
		if($this->params["controller"]=="contentscategory"){
		?>
		<td>
			<?php echo $this->Html->link(h($r_[$view["model_parent"]]["permalink"]),$wwwurl."content/list/".$r_[$view["model_parent"]]["permalink"],array("target"=>"_blank")); ?>
		</td>
		<?php
		}
		?>
		<td><?php echo count($r_[$view["models"]]); ?></td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>$this->params["controller"],"action"=>"view",$r_[$view["model_parent"]]["id"]),array("class"=>"buttons")); ?>
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
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
	<div class="right mb20">
		<?php echo $this->Html->link("一覧情報をcsv出力",array("controller"=>$this->params["controller"],"action"=>"dataexport_zip"),array("class"=>"buttons")); ?>
	</div>
</div>
