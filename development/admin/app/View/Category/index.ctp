<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　カテゴリー一覧</div>
<h1>カテゴリー一覧</h1>
<div class="gnavi">
	<ul class="float">
		<li class="active"><?php echo $this->Html->link("カテゴリー一覧",array("controller"=>"category","action"=>"index")); ?></li>
		<li><?php echo $this->Html->link("地区一覧",array("controller"=>"district","action"=>"index")); ?></li>
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
	<?php echo $this->Html->link("カテゴリー新規登録",array("controller"=>"category","action"=>"edit"),array("class"=>"buttons")); ?>
</div>
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>カテゴリー名</th>
		<!--
		<th class="minishort">パーマリンク</th>
		-->
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y.m.d H:i",strtotime($r_["Category"]["createdate"])); ?></td>
		<td><?php echo h($r_["Category"]["name"]); ?></td>
		<td>
			<?php echo $this->Html->link("編集",array("controller"=>"category","action"=>"edit",$r_["Category"]["id"]),array("class"=>"buttons")); ?>
			<!-- 
			<label for="delete_<?php echo $count; ?>" class="buttons del">削除</label>
			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<div class="basejavar"></div>
				<div class="window short">
					<div class="bs">
						<h2 class="mb30">「<?php echo $r_["Category"]["name"]; ?>」のページカテゴリーを削除します</h2>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"category","action"=>"delete",$r_["Category"]["id"]),array("class"=>"buttons del")); ?>
						</div>
					</div>
				</div>
			</div>
			-->
		</td>
	</tr>
	<?php
	}
	?>
	</table>