<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　仲間管理</div>
<h1>仲間管理</h1>
<div class="main_content">
	<div class="right mb20">
		<?php echo $this->Html->link("新規仲間登録",array("controller"=>"friend","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>

	<div class="search">
		<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
		<label for="shdk" class="toggle">検索フォーム</label>
		<div class="window">
				<?php echo $this->Form->create(null,array(
					"type"=>"get",
					"url"=>array("controller"=>"friend","action"=>"index",$page),
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
					<th>承認状況</th>
					<td>
						<?php
						$typelist=array(
							1=>"仲間申請中",
							2=>"仲間承認済み",
							3=>"仲間承認拒否",
						);
						echo $this->Form->select("type",$typelist,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["type"]));
						?>
					</td>
				</tr>

				</table>
				<div class="center">
					<?php echo $this->Form->submit("検索する",array("div"=>false,"class"=>"buttons")); ?>
				</div>
			<?php echo $this->Form->end(); ?>
		</div><!--//.window-->
	</div><!--//.search-->

	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>
	<?php
	echo $this->Form->create("Group",array(
		"url"=>array("controller"=>"friend","action"=>"changestatus"),
	));
	?>
	<div class="mb10">
		選択した仲間情報のステータスを
		<?php echo $this->Form->select("friend_status",$friend_status,array("class"=>"short","empty"=>"---未選択---")); ?> に
		<?php echo $this->Form->submit("変更する",array("class"=>"buttons","div"=>false)); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">✔</th>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>仲間ユーザー名</th>
		<th class="mini">承認状況</th>
		<th class="mini"></th>
	</tr>
		<?php
		$count=$limit*($page-1);
		foreach($result as $rf_){
			$count++;
		?>
		<tr>
		<td class="center"><?php echo $count; ?></td>
		<td class="center"><label><?php echo $this->Form->input("id.",array("type"=>"checkbox","value"=>$rf_["Group"]["id"])); ?></label></td>
		<td><?php echo date("Y.m.d H:i",strtotime($rf_["Group"]["createdate"])); ?></td>
		<td>
		
			<p><?php echo $rf_["Groupuser"][0]["User"]["nickname"]; ?></p>
			<p><?php echo $rf_["Groupuser"][1]["User"]["nickname"]; ?></p>
			
		</td>
		<td>
			<?php echo $friend_status[$rf_["Group"]["friend_status"]]; ?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"friend","action"=>"view",$rf_["Group"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
	<?php echo $this->Form->end(); ?>

	<?php
	if($totalpage>=2){
	?>
	<div class="pager">
		<ul class="float">
			<?php
			if($page>=2){
			?>
			<li><?php echo $this->Html->link("<",array("controller"=>"friend","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"friend","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"friend","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>



</div>