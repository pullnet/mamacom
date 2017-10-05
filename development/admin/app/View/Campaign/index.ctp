<?php
$open_status=array(
	0=>"表示",
	1=>"非会員のみ",
	2=>"会員のみ",
	3=>"非表示",
);
?>

<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　キャンペーン管理</div>
<h1>キャンペーン管理</h1>
<?php
if(isset($alert)){
?>
<div class="error-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	<div class="right mb20">
		<?php echo $this->Html->link("キャンペーン表示並び替え",array("controller"=>"campaign","action"=>"sort"),array("class"=>"buttons")); ?>
		<?php echo $this->Html->link("キャンペーン新規登録",array("controller"=>"campaign","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>キャンペーン名</th>
		<th class="mini">公開設定</th>
		<th class="minishort"></th>

	</tr>
	<?php
	$count=0;
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td>
			<?php echo date("Y-m-d H:i",strtotime($r_["Campaign"]["createdate"])); ?>
		</td>
		<td><?php echo h(@$r_["Campaign"]["name"]); ?></td>
		<td class="center"><?php echo @$open_status[@$r_["Campaign"]["open_status"]]; ?></td>
		<td>
			<?php echo $this->Html->link("編集",array("controller"=>"campaign","action"=>"edit",$r_["Campaign"]["id"]),array("class"=>"buttons")); ?>
			<label for="delete_<?php echo $count; ?>" class="buttons backbtn">削除</label>
			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
				<div class="window short">
					<div class="bs">
						<h1 class="float">キャンペーン情報の削除
						<span class="f_right"><label for="delete_<?php echo $count; ?>">×</label></h1>
						<p class="mb20">「<?php echo h($r_["Campaign"]["name"]); ?>」を削除します。</p>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"campaign","action"=>"delete",$r_["Campaign"]["id"]),array("class"=>"buttons add")); ?>
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

</div>