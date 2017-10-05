<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　グループメンバー編集</div>
<h1>グループメンバー編集</h1>
<div class="main_content">

	<?php
	echo $this->Form->create("Groupuser",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	echo $this->Form->hidden("id");
	echo $this->Form->hidden("group_id",array("value"=>$result_group["Group"]["id"]));
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>参加グループ名</th>
		<td>
			<?php echo $result_group["Group"]["name"]; ?>
		</td>
	</tr>
	<tr>
		<th>参加ユーザー</th>
		<td>
			<?php
			if(isset($result_user))
			{
			?>
				<p><?php echo $result_user["User"]["username"]." - ".$result_user["User"]["nickname"]; ?></p>
			<?php
			}
			else
			{
				echo $this->Form->select("user_id",$userlist,array("empty"=>"---未設定---"));
			}
			?>
		</td>
	</tr>
	<tr>
		<th>申請ステータス</th>
		<td>
			<?php
			$status=array(
				0=>"申請中(ユーザーから申請)",
				1=>"申請中(グループから申請)",
				2=>"申請承諾",
				3=>"申請拒否",
				4=>"メンバー脱退",
			);

			if(isset($result_user))
			{
				if($result_user["Groupuser"]["leader_status"]==1){
					echo "リーダーです";
				}
				else
				{
					echo $this->Form->select("status",$status,array("class"=>"short","empty"=>false));
				}
			}
			else
			{
				echo $this->Form->select("status",$status,array("class"=>"short","empty"=>false));
			}
			?>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Form->submit("グループメンバー情報を設定",array("class"=>"short","div"=>false)); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
