<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link($result_content["Content"]["title"]."の詳細",array("controller"=>"library","action"=>"view",$result_content["Content"]["id"])); ?>
　＞　<?php echo $this->Html->link("受注設定一覧",array("controller"=>"library","action"=>"ordersetlist",$result_content["Content"]["id"])); ?>　＞　受注設定詳細
</div>
<h1>受注設定詳細</h1>
<?php
if(isset($alert)){
?>
<div class="alert-message">受注情報一件を登録・更新しました</div>
<?php
}
?>
<div class="main_content">

	<?php echo $this->Form->create("Libraryorderset",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>公開ステータス</th>
		<td>
			<?php echo $open_status[$result["Libraryorderset"]["open_status"]]; ?>
		</td>
		<th>管理番号</th>
		<td>
			<?php echo $result["Libraryorderset"]["number"]; ?>
		</td>
	</tr>
	<tr>
		<th>受注タイトル</th>
		<td colspan="3">
			<?php echo $result["Libraryorderset"]["title"]; ?>
		</td>
	</tr>
	<tr>
		<th>カテゴリー</th>
		<td>
			<?php echo $contentscategory[$result["Libraryorderset"]["contentscategory_id"]]; ?>
		</td>
		<th>発注可能個数</th>
		<td>
			<?php echo $result["Libraryorderset"]["enable_count"]; ?> 個
		</td>
	</tr>
	<tr>
		<th>受付期間</th>
		<td colspan="3">
			<p class="mb5">開始日</p>
			<p class="mb5"><?php echo date("Y.m.d",strtotime($result["Libraryorderset"]["start_order_date"])); ?></p>
			<p class="mb5">終了日</p>
			<p><?php echo date("Y.m.d",strtotime($result["Libraryorderset"]["exit_order_date"])); ?></p>
		</td>
	</tr>
	<tr>
		<th>予定納期</th>
		<td colspan="3">
			<?php echo $result["Libraryorderset"]["enable_day"]; ?> 日
		</td>
	</tr>
	<tr>
		<th>販売価格</th>
		<td colspan="3">
			<p class="mb5">最少価格</p>
			<p class="mb5"><?php echo number_format($result["Libraryorderset"]["price_min"]); ?> 円</p>
			<p class="mb5">最大価格</p>
			<p><?php echo number_format($result["Libraryorderset"]["price_max"]); ?> 円</p>
		</td>
	</tr>
	<tr>
		<th>ライブラリ提供の種類</th>
		<td>
			<?php 
			if($result["Libraryorderset"]["order_type"])
			{
				echo $order_type[$result["Libraryorderset"]["order_type"]];
			}
			else
			{
				echo "-";
			}
			 ?>
		</td>
		<th>納品形態</th>
		<td>
			<?php
			if($result["Libraryorderset"]["output_type"])
			{
				echo $output_type[$result["Libraryorderset"]["output_type"]];
			}
			else
			{
				echo "-";
			}
			?>
		</td>
	</tr>
	<tr>
		<th>その他備考・概要</th>
		<td colspan="3">
			<?php echo $result["Libraryorderset"]["caption"]; ?>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Html->link("この受注設定を編集する",array("controller"=>"library","action"=>"ordersetedit",$result["Libraryorderset"]["content_id"],$result["Libraryorderset"]["id"]),array("class"=>"buttons")); ?>
	</div>

<?php
/*
	<h2>受注情報一覧</h2>
	*/
	?>
</div>
