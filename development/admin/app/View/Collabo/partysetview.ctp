<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link($result_content["Content"]["title"]."の詳細",array("controller"=>"collabo","action"=>"view",$result_content["Content"]["id"])); ?>
　＞　<?php echo $this->Html->link("コラボ参加設定一覧",array("controller"=>"collabo","action"=>"partysetlist",$result_content["Content"]["id"])); ?>　＞　コラボ参加設定詳細
</div>
<h1>コラボ参加設定詳細</h1>
<?php
if(isset($alert)){
?>
<div class="alert-message">参加設定一件を登録・更新しました</div>
<?php
}
?>
<div class="main_content">
	
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>公開ステータス</th>
		<td>
			<?php echo $open_status[$result["Collabopartyset"]["open_status"]]; ?>
		</td>
		<th>管理番号</th>
		<td>
			<?php echo $result["Collabopartyset"]["number"]; ?>
		</td>
	</tr>
	<tr>
		<th>参加表明タイトル</th>
		<td colspan="3">
			<?php echo $result["Collabopartyset"]["title"]; ?>
		</td>
	</tr>
	<tr>
		<th>参加の種類</th>
		<td>
			<?php echo $contentscategory[$result["Collabopartyset"]["contentscategory_id"]]; ?>
		</td>
		<th>参加予定人数</th>
		<td>
			<?php echo $result["Collabopartyset"]["max_people"]; ?>
		</td>
	</tr>
	<tr>
		<th>募集期間</th>
		<td colspan="3">
			<p class="mb5">募集開始日</p>
			<p class="mb5"><?php echo date("Y.m.d",strtotime($result["Collabopartyset"]["start_opendate"])); ?></p>
			<p class="mb5">募集締切日</p>
			<p><?php echo date("Y.m.d",strtotime($result["Collabopartyset"]["exit_opendate"])); ?></p>
		</td>
	</tr>
	<tr>
		<th>予算(報酬額)</th>
		<td colspan="3">
				<p class="mb5">下限金額：</p>
				<p class="mb5"><?php echo number_format($result["Collabopartyset"]["min_price"]); ?> 円</p>
				<p class="mb5">上限金額：</p>
				<p><?php echo number_format($result["Collabopartyset"]["max_price"]); ?> 円</p>

		</td>
	</tr>
	<tr>
		<th>コラボ参加の種類</th>
		<td>
			<?php echo $party_status[$result["Collabopartyset"]["party_type"]]; ?>
		</td>
		<th>納品形態</th>
		<td>
			<?php echo $output_status[$result["Collabopartyset"]["output_type"]]; ?>
		</td>
	</tr>
	<tr>
		<th>参加表明の概要</th>
		<td colspan="3">
			<?php echo $result["Collabopartyset"]["caption"]; ?>
		</td>
	</tr>
	</table>

	<div class="center mb20">
		<?php echo $this->Html->link("この参加設定を編集する",array("controller"=>"collabo","action"=>"partysetedit",$result_content["Content"]["id"],$result["Collabopartyset"]["id"]),array("class"=>"buttons")); ?>
	</div>
</div>