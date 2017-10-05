<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("ユーザー管理",array("controller"=>"users","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("会員情報詳細「".$result["User"]["nickname"]."」さん",array("controller"=>"users","action"=>"view",$result["User"]["id"])); ?>　＞　
グループ管理</div>
<h1><?php echo $result["User"]["nickname"]; ?>さんのグループ一覧</h1>
	<?php echo $this->element("users/gnavi"); ?>
<div class="main_content">
	<div class="right mb10">
		<?php echo $this->Html->link("グループ新規登録",array("controller"=>"group","action"=>"edit","user_id"=>$result["User"]["id"]),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0">
	<tr>
		<th style="width:50px">✔</th>
		<th style="width:150px">登録日</th>
		<th>グループ名</th>
		<th style="width:100px">グループ権限</th>
		<th></th>
	</tr>
		<?php
		foreach($result_group as $rg_){
		?>
		<tr>

		<td><label><input type="checkbox"></label></td>
		<td><?php echo date("Y.m.d H:i",strtotime($rg_["Groupuser"]["createdate"])); ?></td>
		<td><?php
			echo $rg_["Group"]["name"];
		?>
		</td>
		<td>
			<?php echo $leader_status[$rg_["Groupuser"]["leader_status"]]; ?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"group","action"=>"view",$rg_["Group"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
		<?php
		}
		?>
	</table>
	

</div>