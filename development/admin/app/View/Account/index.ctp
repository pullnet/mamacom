<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　管理アカウント一覧</div>
	<h1>管理アカウント一覧</h1>
	<div class="main_content">
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
			<?php echo $this->Html->link("管理アカウント追加",array("controller"=>"account","action"=>"edit"),array("class"=>"buttons")); ?>
		</div>
		<table cellspacing="0" cellpadding="0" class="list mb20">
		<tr>
			<th class="micro">No</th>
			<th class="minishort">登録日</th>
			<th>登録者氏名</th>
			<th class="short">ユーザー名</th>
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
				<?php echo date("Y-m-d H:i",strtotime($r_["Admin"]["createdate"])); ?>
			</td>
			<td>
				<?php echo $r_["Admin"]["username"]; ?>
			</td>	
			<td>
				<?php echo $r_["Admin"]["name"]; ?>
			</td>
			<td>
				<?php echo $this->Html->link("編集",array("controller"=>"account","action"=>"edit",$r_["Admin"]["id"]),array("class"=>"buttons")); ?>
				<?php if($r_["Admin"]["name"] != "初期アカウント"){ ?>
				<label for="delete_<?php echo $count; ?>" class="buttons delete">削除</label>
				<?php } ?>
<div id="popup">
	<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
	<label></label>
	<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				管理アカウントの削除
				<label for="delete_<?php echo $count; ?>" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<p class="h4"><?php echo h($r_["Admin"]["name"]); ?>を削除します。</p>
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label></li>
					<li class="f_right"><?php echo $this->Html->link("削除する",array("controller"=>"account","action"=>"delete",$r_["Admin"]["id"]),array("class"=>"buttons delete")); ?></li>
				</ul>
			</div>
		</div>
	</div>
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
				<li><?php echo $this->Html->link("<",array("controller"=>"account","action"=>"index",($page-1))); ?></li>
				<?php
				}
				for($svc=1;$svc<=$totalpage;$svc++){
				?>
				<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"account","action"=>"index",$svc)); ?></li>
				<?php
				}
				if($page<=count($totalpage-1)){
				?>
				<li><?php echo $this->Html->link(">",array("controller"=>"account","action"=>"index",($page+1))); ?></li>
				<?php
				}
				?>
			</ul>
		</div><!--//.pager-->
		<?php
		}
		?>

	</div>