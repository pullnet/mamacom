<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　フリーページカテゴリー一覧</div>
<h1>フリーページカテゴリー一覧</h1>
<div class="gnavi">
	<ul class="float">
		<li><?php echo $this->Html->link("フリーページ一覧",array("controller"=>"freepage","action"=>"index")); ?></li>
		<li class="active"><?php echo $this->Html->link("フリーページカテゴリー一覧",array("controller"=>"pagecategory","action"=>"index",$page)); ?></li>
	</ul>
</div>
<?php
if(isset($alert))
{
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="right mb10">
	<?php echo $this->Html->link("フリーページカテゴリー新規登録",array("controller"=>"pagecategory","action"=>"edit"),array("class"=>"buttons")); ?>
</div>
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>フリーページカテゴリー名</th>
		<th class="minishort">パーマリンク</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y.m.d H:i",strtotime($r_["Freepagecategory"]["createdate"])); ?></td>
		<td><?php echo h($r_["Freepagecategory"]["name"]); ?></td>
		<td><?php echo $this->Html->link(h($r_["Freepagecategory"]["permalink"]),$wwwurl."lp/".$r_["Freepagecategory"]["permalink"],array("target"=>"_blank")); ?></td>
		<td>
			<?php echo $this->Html->link("編集",array("controller"=>"pagecategory","action"=>"edit",$r_["Freepagecategory"]["id"]),array("class"=>"buttons")); ?>

			<label for="delete_<?php echo $count; ?>" class="buttons del">削除</label>
			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<div class="basejavar"></div>
				<div class="window short">
					<div class="bs">
						<h2 class="mb30">「<?php echo $r_["Freepagecategory"]["name"]; ?>」のページカテゴリーを削除します</h2>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"pagecategory","action"=>"delete",$r_["Freepagecategory"]["id"]),array("class"=>"buttons del")); ?>
						</div>
					</div>
				</div>
			</div>

		</td>
	</tr>
	<?php
	}
	?>
	</table>