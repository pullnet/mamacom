<table cellspacing="0" cellpadding="0">
<tr>
	<th class="micro">形式</th>
	<th>ファイル名</th>
	<th class="mini">ファイル形式</th>
	<th class="short">ファイルサイズ</th>
	<th class="short">作成日時</th>
</tr>
<tr class="goback" data-path="<?php if(@$backpath){ echo $backpath; } ?>">
	<td class="left" colspan="5">...</td>
</tr>
<?php
$count=0;
if(@$dirlist){
foreach($dirlist as $d_){
	$count++;
?>
<tr class="<?php echo $d_["type"]; ?>" data-path="<?php echo $d_["path"]; ?>">
	<td class="center">
	<?php
	if($d_["type"]=="dir"){
	?>
	D
	<?php
	}
	else if($d_["type"]=="file"){
	?>
	F
	<?php
	}
	?>
	</td>
	<td class="left"><?php echo h($d_["name"]); ?></td>
	<td>
	<?php
	if($d_["type"]=="file"){
		echo $d_["filetype"];
	}
	?>
	</td>
	<td>
	<?php
	if($d_["type"]=="file"){
	 echo number_format($d_["size"]/1000)."KB";
	}?>
	</td>
	<td>
	<?php echo date("Y-m-d H:i",$d_["createdate"]); ?>
	</td>
</tr>
<?php
}
}
?>
</table>