<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link($view["title"]."一覧",array("controller"=>$this->params["controller"],"action"=>"index")); ?>　＞　
<?php echo $view["title"]; ?>詳細</div>

<h1><?php echo $view["title"]; ?>詳細</h1>
<div class="main_content">
	<div class="gnavi">
		<ul class="float">
			<li><?php echo $this->Html->link($view["title"]."を編集",array("controller"=>$this->params["controller"],"action"=>"edit",$id)); ?></li>
		</ul>
	</div><!--//.gnavi-->
	<h2><?php echo $view["title"]; ?>基本情報</h2>

	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th style="width:250px"><?php echo $tab[0]; ?></th>
		<td colspan="3"><?php echo $result[$view["model_parent"]]["name"]; ?></td>
	</tr>
	<tr>
		<th>登録日</th>
		<td colspan="3"><?php echo date("Y-m-d H:i",strtotime($result[$view["model_parent"]]["createdate"])); ?></td>
	</tr>
	<tr>
		<th><?php echo $tab[1]; ?></th>
		<td colspan="3"><?php echo count($result[$view["models"]]); ?></td>
	</tr>
	<?php
	if($this->params["controller"]=="contentscategory"){
	?>
	<tr>
		<th>ページURL</th>
		<td><?php echo $this->Html->link(h($result[$view["model_parent"]]["permalink"]),$wwwurl."content/list/".h($result[$view["model_parent"]]["permalink"]),array("target"=>"_blank")); ?>
	</tr>
	<?php
	}
	?>
	</table>

	<h2 id="collaboparty">登録<?php echo $view["subtitle2"]; ?>一覧</h2>
	
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<div class="right mb20">
		<?php echo $this->Html->link("新規".$view["subtitle2"]."追加",array("controller"=>$this->params["controller"],"action"=>"inputedit",$id),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No.</th>
		<th class="minishort">登録日</th>
		<th><?php echo $tab[2]; ?></th>
		<?php
		if($this->params["controller"]=="contentscategory")
		{
		?>
			<th class="minishort">ショートURL名</th>
		<?php
		}
		?>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result_list as $rl_)
	{
	$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($rl_[$view["models"]]["createdate"])); ?></td>
		<td><?php echo $rl_[$view["models"]]["name"]; ?></td>
		<?php
		if($this->params["controller"]=="contentscategory")
		{
		?>
			<td>
			<?php echo $this->Html->link($rl_[$view["models"]]["shorturl"],$wwwurl."content/list/".$result[$view["model_parent"]]["permalink"]."/".$rl_[$view["models"]]["shorturl"],array("class"=>"underline","target"=>"_blank"));?>
			</td>
		<?php
		}
		?>
		<td>
			<?php echo $this->Html->link("編集",array("controller"=>$this->params["controller"],"action"=>"inputedit",$id,$rl_[$view["models"]]["id"]),array("class"=>"buttons")); ?>
			<label for="delete_<?php echo $count; ?>" class="buttons delete">削除</label>
<div id="popup">
	<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
	<label></label>
	<label for="delete_<?php echo $count; ?>" class="basejavar"></label>

</div><!--//#popup-->
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
			<li><?php echo $this->Html->link("<",array("controller"=>$this->params["controller"],"action"=>"view",$id,($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>$this->params["controller"],"action"=>"view",$id,$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>$this->params["controller"],"action"=>"view",$id,($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
</div>
<?php
//メッセージ表示(更新完了後)
if(isset($alert))
{
?>
<div id="popup_alert">
	<input type="checkbox" class="checks" id="poc520">
	<label for="poc520" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>
				<span class="f_right"><label for="poc520">×</label></span>
				<?php echo $view["title"]; ?>を更新しました。
			</h1>
			<p class="center mb20">内容が更新されているかご確認ください</p>
			<div class="center">
				<label for="poc520" class="buttons">閉じる</label>
			</div>
		</div>
	</div><!--//.window-->
</div><!--//#popup_alert-->
<?php
}
?>