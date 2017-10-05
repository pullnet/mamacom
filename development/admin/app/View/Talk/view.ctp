<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link("メッセージフィールド一覧",array("controller"=>"talk","action"=>"index")); ?>　＞　メッセージフィールド詳細</div>
<h1>メッセージフィールド詳細</h1>
<div class="main_content">
	<?php
	if(isset($alert))
	{
		?>
		<div class="alert-message"><?php echo $alert; ?></div>
		<?php
	}
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>作成日</th>
		<td>
			<?php echo date("Y-m-d H:i",strtotime($result_mf["Messagefield"]["createdate"])); ?>
		</td>
	</tr>
	<tr>
		<th>通常/グループ</th>
		<td>
			<?php
			$field_status=array(
				0=>"個人",
				1=>"グループ",
				2=>"コラボ専用",
				3=>"仲間",
			);
			echo $field_status[$result_mf["Messagefield"]["field_status"]];
			?>
		</td>
	</tr>
	<tr>
		<th>接続ユーザー</th>
		<td>
		<?php
		foreach($result_mf["Messagefielduser"] as $rm_){
		?>
		<p><?php echo $rm_["User"]["nickname"]; ?></p>
		<?php
		}
		?>
		</td>
	</tr>
	<?php
	if($result_mf["Messagefield"]["field_status"]==1 || $result_mf["Messagefield"]["field_status"]==2){
	?>
	<tr>
		<th colspan="2" class="center">
		<?php
		if($result_mf["Messagefield"]["field_status"]==1){
			echo "グループ名";
		}
		else if($result_mf["Messagefield"]["field_status"]==2){
			echo "コラボ名";
		}
		?>
		</th>
	</tr>
	<tr>
		<td colspan="2">
		<?php
		if($result_mf["Messagefield"]["field_status"]==1){
			echo h($result_mf["Group"]["name"]);
		}
		else if($result_mf["Messagefield"]["field_status"]==2){
			echo h($result_mf["Content"]["title"]);
		}
		?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
	<div class="center mb10">
		<?php echo $this->Html->link("フィールド情報を編集する",array("controller"=>"talk","action"=>"edit",$result_mf["Messagefield"]["id"]),array("class"=>"buttons")); ?>
	</div>

	<h2>メッセージ一覧</h2>
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<div class="right mb10">
		<?php echo $this->Html->link("メッセージ新規追加",array("controller"=>"talk","action"=>"msgedit",$result_mf["Messagefield"]["id"]),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">no</th>
		<th class="micro">番号</th>
		<th class="minishort">投稿日</th>
		<th>メッセージ文冒頭</th>
		<th class="short">発信ユーザー</th>
		<th class="mini">添付</th>
		<th class="mini"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result_m as $rm_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?>
		<td class="center"><?php echo $rm_["Message"]["talk_number"]; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($rm_["Message"]["send_date"])); ?></td>
		<td>
			<?php
				if(strlen($rm_["Message"]["message"])>15){
					echo mb_substr(h($rm_["Message"]["message"]),0,80)."...";
				}
				else
				{
					echo h($rm_["Message"]["message"]);
				}
			?>

		</td>
		<td><?php echo h($rm_["User"]["nickname"]); ?></td>
		<td>
			<?php
				if(count($rm_["Messagezip"])){
					echo count($rm_["Messagezip"]);
				}
			?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"talk","action"=>"msgview",$rm_["Message"]["id"]),array("class"=>"buttons")); ?>
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
			<li><?php echo $this->Html->link("<<",array("controller"=>"talk","action"=>"view",$id,1,"?"=>@$this->request->query)); ?></li>
			<li><?php echo $this->Html->link("<",array("controller"=>"talk","action"=>"view",$id,($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"talk","action"=>"view",$id,$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"talk","action"=>"view",$id,($page+1),"?"=>@$this->request->query)); ?></li>
			<li><?php echo $this->Html->link(">>",array("controller"=>"talk","action"=>"view",$id,$totalpage,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
	
</div>