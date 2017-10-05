<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　グループ詳細</div>
<h1>グループ詳細</h1>
<?php
if(isset($alert)){
?>
		<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">

	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>グループ名</th>
		<td>
			<?php echo $result["Group"]["name"]; ?>
		</td>
	</tr>
	<tr>
		<th>登録日</th>
		<td>
			<?php echo date("Y.m.d H:i",strtotime($result["Group"]["createdate"])); ?>
		</td>
	</tr>
	<tr>
		<th>アイコン</th>
		<td>
			<?php echo $this->Html->image($itemurl."smpimg/groupicon/".$result["Group"]["icontag"],array("onerror"=>'this.src="'.Router::url("/",true).'img/icongroup.png"',"class"=>"image")); ?>
		</td>
	</tr>
	<tr>
		<th>グループURL</th>
		<td>
			<?php echo $result["Group"]["permalink"]; ?>
		</td>
	</tr>
	<tr>
		<th>ステータス</th>
		<td>
			<?php echo $group_status[$result["Group"]["group_status"]]; ?>
		</td>
	</tr>
	<tr>
		<th>概要</th>
		<td>
			<?php echo $result["Group"]["caption"]; ?>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Html->link("グループ情報の編集",array("controller"=>"group","action"=>"edit",$result["Group"]["id"]),array("class"=>"buttons")); ?>
	</div>

	<h2>参加メンバー一覧</h2>
	<div class="right mb10">
		<?php echo $this->Html->link("メンバーを追加",array("controller"=>"group","action"=>"memberedit",$result["Group"]["id"]),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No.</th>
		<th>ユーザー名</th>
		<th>権限</th>
		<th>申請状況</th>
		<th></th>
	</tr>
	<?php
	$aaa=0;
	foreach($result["Groupuser"] as $rgu_){
		$aaa++;
	?>
		<tr>
			<td class="center"><?php echo $aaa; ?></td>
			<td><?php echo $rgu_["User"]["nickname"]; ?></td>
			<td><?php echo $leader_status[$rgu_["leader_status"]]; ?></td>
			<td><?php
				if($rgu_["leader_status"]==0)
				{
					echo $status[$rgu_["status"]];
				}
				else
				{
					echo "-";
				}
				?>
			</td>
			<td>
				<?php echo $this->Html->link("編集",array("controller"=>"group","action"=>"memberedit",$result["Group"]["id"],$rgu_["id"]),array("class"=>"buttons")); ?>
			</td>
		</tr>
	<?php
		$aaa++;
	}
	?>

	</table>
</div>
