<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　仲間詳細</div>
<h1>仲間詳細</h1>
<?php
if(isset($alert))
{
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">

	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>仲間関係</th>
		<td>
<?php
foreach($result["Groupuser"] as $r_){
	if($r_["friend_type"]==0){
		echo "<p>受取ユーザー:".h($r_["User"]["nickname"])."</p>";
	}
	else if($r_["friend_type"]==1){
		echo "<p>申請ユーザー:".h($r_["User"]["nickname"])."</p>";
	}
}
?>
		</td>
	</tr>
	<tr>
		<th>登録日</th>
		<td>
			<?php echo date("Y.m.d H:i",strtotime($result["Group"]["createdate"])); ?>
		</td>
	</tr>
	<tr>
		<th>ステータス</th>
		<td>
			<?php echo $status[$result["Group"]["friend_status"]]; ?>
		</td>
	</tr>
	</table>
<div class="center mb20">
	<?php echo $this->Html->link("仲間情報の編集",array("controller"=>"friend","action"=>"edit",$result["Group"]["id"]),array("class"=>"buttons")); ?>
</div>
</div>
