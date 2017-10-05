<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("ユーザー管理",array("controller"=>"users","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("会員情報詳細 ".$result["User"]["nickname"]."さん",array("controller"=>"users","action"=>"view",$result["User"]["id"])); ?>　＞　
コラボ・ライブラリ一覧
</div>
<h1><?php echo $result["User"]["nickname"]; ?>さんのコラボ・ライブラリ一覧</h1>
<div class="main_content">
	<?php
	echo $this->element("users/gnavi");
	if(isset($alert))
	{
		?>
		<div class="alert-message"><?php echo $alert; ?></div>
		<?php
	}
	
	?>

	<table cellspacing="0" cellpadding="0" class="list mb30">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th class="mini">種別</th>
		<th>タイトル</th>
		<th class="mini"></th>
	</tr>
	<?php
	$count=0;
	foreach($content as $c_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($c_["Content"]["createdate"])); ?></td>
		<td><?php
		if($c_["Content"]["status"]==0){
			$controller="collabo";
			echo "コラボ";
		}
		else
		{
			$controller="library";
			echo "ライブラリ";

		}
		?></td>
		<td><?php echo $this->Html->link(h($c_["Content"]["title"]),$wwwurl.$result["User"]["username"]."/".$controller."/detail/id:".$c_["Content"]["id"],array("class"=>"underline","target"=>"_blank")); ?></td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"users","action"=>"content_detail",$c_["Content"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
</div>
