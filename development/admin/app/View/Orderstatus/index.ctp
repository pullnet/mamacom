<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　注文ステータス管理</div>
<h1>注文ステータス管理</h1>
<?php
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">

	<p class="h3">全<?php echo count($result); ?>件</p>

	<div class="right mb20">
		<?php echo $this->Html->link("並び替え",array("controller"=>"orderstatus","action"=>"sort"),array("class"=>"buttons")); ?>
		<?php echo $this->Html->link("ステータス新規追加",array("controller"=>"orderstatus","action"=>"edit"),array("class"=>"buttons")); ?>
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
		<th class="minishort">ステータスコード</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=0;
	foreach($result as $r_){
		$count++
	?>
	<tr class="<?php if($r_["Orderstatuslist"]["status"]==0){ echo "default"; } ?>">
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_["Orderstatuslist"]["createdate"])); ?></td>
		<td><?php echo $r_["Orderstatuslist"]["name"]; ?></td>
		<td><?php echo h($r_["Orderstatuslist"]["code"]); ?></td>
		<td>
			<?php
			echo $this->Html->link("編集",array("controller"=>"orderstatus","action"=>"edit",$r_["Orderstatuslist"]["id"]),array("class"=>"buttons"));
			if($r_["Orderstatuslist"]["status"]==1){
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
						<h3>注文ステータスの削除</h3>
						<p class="mb20">ステータス名「<?php echo h($r_["Orderstatuslist"]["name"]); ?>」を削除します。よろしいですか？</p>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"orderstatus","action"=>"delete",$r_["Orderstatuslist"]["id"]),array("class"=>"buttons del")); ?>
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
