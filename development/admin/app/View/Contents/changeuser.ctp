<?php
if($this->params["controller"]=="collabo")
{
	$typename="コラボ";
	$types="collabo";
}
else if($this->params["controller"]=="library")
{
	$typename="ライブラリ";
	$types="library";
}
?>
<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link($result_content["Content"]["title"]."の詳細",array()); ?>　＞　
登録ユーザー変更</div>
<h1>「<?php echo $result_content["Content"]["title"]; ?>」の登録ユーザー変更</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Content",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	echo $this->Form->hidden("id");
	?>


	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>登録日</th>
		<td>
			<?php echo date("Y.m.d H:i", strtotime($result_content["Content"]["record_date"])); ?>
		</td>
		<th>公開ステータス</th>
		<td>
			<?php echo $openstatus[$result_content["Content"]["open_status"]]; ?>
		</td>
	</tr>
	<tr>
		<th>タイトル</th>
		<td colspan="3"><?php echo $result_content["Content"]["title"]; ?></td>
	</tr>
	<tr>
		<th>現在の登録ユーザー名</th>
		<td colspan="3 float">
			<?php echo $result_content["User"]["username"]."[".$result_content["User"]["nickname"]."]"; ?>
		</td>
	</tr>
	</table>

	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>変更する登録ユーザー名</th>
		<td>
			<?php echo $this->Form->select("user_id",$userlist,array("empty"=>false)); ?>
		</td>
	</tr>
	</table>

	<div class="center">
		<?php echo $this->Form->submit("設定する",array("div"=>false,"class"=>"short")); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>


