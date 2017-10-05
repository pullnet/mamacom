<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　メッセージフィールド一覧</div>
<h1>メッセージフィールド一覧</h1>
<div class="main_content">

	<div class="search">
		<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
		<label for="shdk" class="toggle">検索フォーム</label>
		<div class="window">
			<?php
			echo $this->Form->create("",array(
				"type"=>"get",
				"url"=>array("controller"=>"talk","action"=>"index",1,"?"=>@$this->request->query),
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
				<th>種別</th>
				<td>
					<?php
					$typelist=array(
						1=>"個人",
						4=>"仲間",
						2=>"グループ",
						3=>"コラボ専用",
					);
					echo $this->Form->select("type",$typelist,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["type"])); ?>
				</td>
			</tr>

			</table>
			<div class="center">
				<input class="buttons" type="submit" value="検索する"/>
			</div>
			<?php echo $this->Form->end(); ?>
		</div><!--//.window-->
	</div><!--//.search-->

	<div class="right mb20">
		<?php echo $this->Html->link("メッセージフィールド新規追加",array("controller"=>"talk","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>


	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th class="mini">種別</th>
		<th>相手ユーザー/グループ名</th>
		<th class="mini">人数</th>
		<th class="mini">メッセージ</th>
		<th class="minishort"></th>
	</tr>
		<?php
		$count=$limit*($page-1);
		foreach($result as $rmf_){
			$count++;
		?>
		<tr>
			<td class="center"><?php echo $count; ?></td>
			<td><?php echo date("Y-m-d H:i",strtotime($rmf_["Messagefield"]["createdate"])); ?></td>
			<td class="center">
				<?php
					$type=array(
						0=>"個人",
						1=>"グループ",
						2=>"コラボ専用",
						3=>"仲間",
						99=>"コラボス<br>運営",
					);
					echo $type[$rmf_["Messagefield"]["field_status"]];
				?>
			</td>
			<td>
				<?php
					if($rmf_["Messagefield"]["field_status"]==0 || $rmf_["Messagefield"]["field_status"]==3){
						foreach($rmf_["Messagefielduser"] as $rmfu_){
							echo "<p>".h(@$rmfu_["User"]["nickname"])."</p>";
						}
					}
					else if($rmf_["Messagefield"]["field_status"]==1){
						echo "[グループ名]<br>".h(@$rmf_["Group"]["name"]);
					}
					else if($rmf_["Messagefield"]["field_status"]==2){
						echo "[コラボ名]<br>".h(@$rmf_["Content"]["title"]);
					}
				?>
			</td>
			<td>
				<?php echo count($rmf_["Messagefielduser"]); ?>
			</td>

			<td>
				<?php echo count($rmf_["Message"]); ?>
			</td>
			<td>
				<?php echo $this->Html->link("詳細",array("controller"=>"talk","action"=>"view",$rmf_["Messagefield"]["id"]),array("class"=>"buttons")); ?>
				<label for="delete_<?php echo $count; ?>" class="buttons delete">削除</label>

<div id="popup">
	<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
	<label></label>
	<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>メッセージフィールド削除</h1>
			<div class="mb30">
				下記のメッセージフィールド情報を削除します。
				<?php
					if($rmf_["Messagefield"]["field_status"]==0 || $rmf_["Messagefield"]["field_status"]==3){
						foreach($rmf_["Messagefielduser"] as $rmfu_){
							echo "<p>".h(@$rmfu_["User"]["username"])."[".h(@$rmfu_["User"]["nickname"])."]</p>";
						}
					}
					else if($rmf_["Messagefield"]["field_status"]==1){
						echo "[グループ名]<br>".h(@$rmf_["Group"]["name"]);
					}
					else if($rmf_["Messagefield"]["field_status"]==2){
						echo "[コラボ名]<br>".h(@$rmf_["Content"]["title"]);
					}
				?>
			</div>
			<div class="center">
				<label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Html->link("削除する",array("controller"=>"talk","action"=>"delete",$rmf_["Messagefield"]["id"]),array("class"=>"buttons add")); ?>
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
			<li><?php echo $this->Html->link("<<",array("controller"=>"talk","action"=>"index",1,"?"=>@$this->request->query)); ?></li>
			<li><?php echo $this->Html->link("<",array("controller"=>"talk","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"talk","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"talk","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<li><?php echo $this->Html->link(">>",array("controller"=>"talk","action"=>"index",$totalpage,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
</div>