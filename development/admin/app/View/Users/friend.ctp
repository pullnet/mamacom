<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("ユーザー管理",array("controller"=>"users","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("会員情報詳細 ".$result["User"]["nickname"]."さん",array("controller"=>"users","action"=>"view",$result["User"]["id"])); ?>　＞　

仲間管理</div>
<h1><?php echo $result["User"]["nickname"]; ?>さんの仲間一覧</h1>
	<?php echo $this->element("users/gnavi"); ?>
<div class="main_content">

	<table cellspacing="0" cellpadding="0" class="mb30">
	<tr>
		<th style="width:50px">✔</th>
		<th style="width:150px">登録日</th>
		<th>相手ユーザー</th>
		<th style="width:100px">ステータス</th>
		<th></th>
	</tr>
		<?php
		foreach($result_friend as $rf_){
		?>
	<tr>
		<td><label><input type="checkbox"></label></td>
		<td><?php echo date("Y.m.d H:i",strtotime($rf_["Friend"]["createdate"])); ?></td>
		<td><?php
		if($rf_["Friend"]["to_user_id"]==$result["User"]["id"])
		{
			echo $this->Html->link($rf_["User"]["nickname"],array("controller"=>"users","action"=>"view",$rf_["User"]["id"]));
		}
		else if($rf_["Friend"]["from_user_id"]==$result["User"]["id"])
		{
			echo $this->Html->link($rf_["User"]["nickname"],array("controller"=>"users","action"=>"view",$rf_["User"]["id"]));
		}
		?>
		</td>
		<td>
			<?php echo $friend_status[$rf_["Friend"]["status"]]; ?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"friend","action"=>"view",$rf_["Friend"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
</div>