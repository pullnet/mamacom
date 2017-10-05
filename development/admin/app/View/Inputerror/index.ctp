<div class="bread">
	<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
	入力エラー表示情報一覧
</div>
<h1>入力エラー表示情報一覧</h1>
<?php
if(isset($alert))
{
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="right mb10">
	<?php echo $this->Html->link("入力エラー表示を新規登録",array("controller"=>"inputerror","action"=>"edit"),array("class"=>"buttons")); ?>
</div>

<table cellspacing="0" cellpadding="0" class="list mb20">
<tr>
	<th class="micro">No</th>
	<th class="minishort">登録日</th>
	<th>表示場所名</th>
	<th class="short">適用コード</th>
	<th class="minishort"></th>
</tr>
<?php
$count=0;
foreach($result as $r_){
	$count++;
?>
<tr>
	<td class="center"><?php echo $count; ?></td>
	<td><?php echo date("Y-m-d H:i",strtotime($r_["Inputerror"]["createdate"])); ?></td>
	<td><?php echo h($r_["Inputerror"]["name"]); ?></td>
	<td><?php echo h($r_["Inputerror"]["code"]); ?></td>
	<td>
		<?php echo $this->Html->link("編集",array("controller"=>"inputerror","action"=>"edit",$r_["Inputerror"]["id"]),array("class"=>"buttons")); ?>
		<label for="delete_<?php echo $count; ?>" class="buttons delete">削除</label>
<div id="popup">
	<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
	<label></label>
	<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>入力エラー表示情報の削除</h1>
			<p>「<?php echo h($r_["Inputerror"]["name"]); ?>」を削除します。<br>
			よろしいですか？</p>
			<div class="center">
				<label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Html->link("削除する",array("controller"=>"inputerror","action"=>"delete",$r_["Inputerror"]["id"]),array("class"=>"buttons delete")); ?>
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