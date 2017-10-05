<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　検索キーワード一覧</div>
<h1>検索キーワード一覧</h1>
<?php
if(isset($alert)){
?>
<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<div class="right mb10">
		<?php echo $this->Html->link("新規登録",array("controller"=>"keyword","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="list mb30">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>キーワード</th>
		<th class="short">URL</th>
		<th class="minishort"></th>
	</tr>
	<?php
	if($result){
		$count=$limit*($page-1);
		foreach($result as $r_){
			$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_["Keyword"]["createdate"])); ?></td>
		<td><?php echo $this->Html->link(h($r_["Keyword"]["name"]),$wwwurl."?keyword=".$r_["Keyword"]["name"],array("target"=>"_blank")); ?></td>
		<td><?php echo h($r_["Keyword"]["code"]); ?></td>
		<td class="minishort">
			<?php echo $this->Html->link("編集",array("controller"=>"keyword","action"=>"edit",$r_["Keyword"]["id"]),array("class"=>"buttons")); ?>
			<label for="delete_<?php echo $count; ?>" class="buttons del">削除</label>

			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
				<div class="window short">
					<div class="bs">
						<h2 class="mb30">「<?php echo $r_["Keyword"]["name"]; ?>」のキーワード情報を削除します</h2>
						<div class="center">
							<label for="deletepop<?php echo $count; ?>" class="buttons">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"keyword","action"=>"delete",$r_["Keyword"]["id"]),array("class"=>"buttons del")); ?>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
	<?php
		}
	}
	?>
	</table>
</div>