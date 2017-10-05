<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("メッセージフィールド一覧",array("controller"=>"talk","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("メッセージフィールド詳細",array("controller"=>"talk","action"=>"view",$result["Messagefield"]["id"])); ?>　＞　メッセージ詳細</div>
<h1>メッセージ詳細</h1>
<div class="main_content">
	<h2>メッセージ情報</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>コード番号</th>
		<td><?php echo $result["Message"]["talk_number"]; ?></td>
	</tr>
	<tr>
		<th>発信ユーザー</th>
		<td><?php echo $result["User"]["username"]." - ".$result["User"]["nickname"]."さん"; ?></td>
	</tr>
	<tr>
		<th>公開設定</th>
		<td>
		<?php
			$status=array(0=>"公開",1=>"非公開");
			echo $status[$result["Message"]["open_status"]];
		?>
		</td>
	</tr>
	<tr>
		<th colspan="2">メッセージ内容</th>
	</tr>
	<tr>
		<td colspan="2"><?php echo $result["Message"]["message"]; ?></td>
	</tr>
	</table>

	<div class="center mb20">
		<?php echo $this->Html->link("メッセージ情報を編集",array("controller"=>"talk","action"=>"msgedit",$result["Messagefield"]["id"],$result["Message"]["id"]),array("class"=>"buttons")); ?>
	</div>
	
	<h2>添付データ情報</h2>
	<div class="right mb10">
		<?php echo $this->Html->link("添付データをセット",array("controller"=>"talk","action"=>"msgzipedit",$result["Message"]["id"]),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th style="width:50px">No</th>
		<th>添付ファイル名</th>
		<th>データ形式</th>
		<th>画像/DL</th>
		<th></th>
	</tr>
	<?php
	$count=0;
	$datatype=array(
		0=>"通常ファイル",
		1=>"画像形式",
	);
	foreach($result["Messagezip"] as $rmz_){
	$count++;
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $rmz_["data_name"]; ?></td>
		<td><?php echo $datatype[$rmz_["type"]]; ?></td>
		<td>
<?php
if($rmz_["type"]==1){
	echo $this->Html->image($itemurl."data/msgzip/".$rmz_["data_tag"].".data",array("style"=>"max-width:100px"));
}
?>
		</td>
		<td>
			<?php echo $this->Html->link("編集",array("controller"=>"talk","action"=>"msgzipedit",$result["Message"]["id"],$rmz_["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

</div>