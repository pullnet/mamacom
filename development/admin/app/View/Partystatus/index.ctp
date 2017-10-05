<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　コラボ参加ステータス管理</div>
<h1>コラボ参加ステータス管理</h1>
<?php
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	
	<h2>ステータス一覧</h2>
	<p class="h3">全<?php echo count($result); ?>件</p>
	<div class="right mb20">
		<?php echo $this->Html->link("並び替え",array("controller"=>"partystatus","action"=>"sort"),array("class"=>"buttons")); ?>
		<?php echo $this->Html->link("ステータス新規追加",array("controller"=>"partystatus","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>
	<style>
	table tr.default{
		background:#f0f0f0;
	}
	</style>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>ステータス名</th>
		<th class="minishort">コード</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=0;
	foreach($result as $r_){
		$count++;
	?>
	<tr class="<?php if($r_["Collabostatuslist"]["status"]==0){ echo "default"; } ?>">
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_["Collabostatuslist"]["createdate"])); ?>
		</td>
		<td><?php echo h($r_["Collabostatuslist"]["name"]); ?></td>
		<td><?php echo h($r_["Collabostatuslist"]["code"]); ?></td>
		<td>
			<?php
			echo $this->Html->link("編集",array("controller"=>"partystatus","action"=>"edit",$r_["Collabostatuslist"]["id"]),array("class"=>"buttons"));
			if($r_["Collabostatuslist"]["status"]==1){
			?>
				<label for="delete_<?php echo $count; ?>" class="buttons del">削除</label>
			<?php
			}
			?>


			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
				<div class="window short">
					<div class="bs">
						<h3>コラボ参加ステータスの削除</h3>
						<p class="mb20">ステータス名「<?php echo h($r_["Collabostatuslist"]["name"]); ?>」を削除します。よろしいですか？</p>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"partystatus","action"=>"delete",$r_["Collabostatuslist"]["id"]),array("class"=>"buttons del")); ?>
						</div>
					</div>
				</div>
			<div><!--//#popup-->
		</td>
	</tr>
	<?php
	}
	?>
	</table>

</div>
