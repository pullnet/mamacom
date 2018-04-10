<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　緊急お役立ち一覧</div>
<h1>緊急お役立ち一覧</h1>
<?php
if(isset($alert))
{
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="right mb10">
	<?php echo $this->Html->link("コンテンツ新規登録",array("controller"=>"emergency","action"=>"edit"),array("class"=>"buttons")); ?>
</div>
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>タイトル</th>
		<th class="minishort">地区</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y.m.d H:i",strtotime($r_["Contents"]["createdate"])); ?></td>
		<td><?php echo h($r_["Contents"]["title"]); ?></td>
		<td><?php
							if(@$r_["Contents"]["district_id"]){
								echo $district_list[ $r_["Contents"]["district_id"] ];
							}
							else{
								echo "---";	
							}	
				?>
		</td>
		<td>
			<?php echo $this->Html->link("編集",array("controller"=>"emergency","action"=>"edit",$r_["Contents"]["id"]),array("class"=>"buttons")); ?>

			<label for="delete_<?php echo $count; ?>" class="buttons del">削除</label>
			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<div class="basejavar"></div>
				<div class="window short">
					<div class="bs">
						<h2 class="mb30">「<?php echo $r_["Contents"]["title"]; ?>」の削除します</h2>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"emergency","action"=>"delete",$r_["Contents"]["id"]),array("class"=>"buttons del")); ?>
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