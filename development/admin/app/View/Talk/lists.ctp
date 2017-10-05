<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("ユーザー管理",array("controller"=>"users","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("会員情報詳細「".$result["User"]["nickname"]."」さん",array("controller"=>"users","action"=>"view",$result["User"]["id"])); ?>　＞　
メッセージ管理</div>
<h1><?php echo $result["User"]["nickname"]; ?>さんのメッセージ管理</h1>
	<?php echo $this->element("users/gnavi"); ?>
<div class="main_content">

	<div class="right mb20">
		<?php echo $this->Html->link("メッセージフィールド新規追加",array("controller"=>"talk","action"=>"edit","user_id"=>$result["User"]["id"]),array("class"=>"buttons")); ?>
	</div>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th style="width:50px">✔</th>
		<th style="width:150px">登録日</th>
		<th style="width:80px">通常/グループ</th>
		<th>相手ユーザー/グループ名</th>
		<th style="width:100px">メッセージ数</th>
		<th style="width:50px"></th>
	</tr>
	<?php
	foreach($result_mf as $rm_){
	?>
	<tr>
		<td><input type="checkbox"></td>
		<td><?php echo date("Y-m-d H:i:s",strtotime($rm_["Messagefield"]["createdate"])); ?></td>
		<td>
		<?php
			$type=array(
				0=>"通常",
				1=>"グループ",
			);
			echo $type[$rm_["Messagefield"]["field_status"]];
		?>
		</td>
		<td>
		<?php
			if($rm_["Messagefield"]["field_status"]==0){
				echo $rm_["Messagefield"]["Messagefielduser"]["User"]["username"]."-".$rm_["Messagefield"]["Messagefielduser"]["User"]["nickname"];

			}
			else if($rm_["Messagefield"]["field_status"]==1){

			}
		?>
		</td>
		<td>
			<?php
			if($rm_["Messagefield"]["Message"])
			{
				echo $rm_["Messagefield"]["Message"]["talk_number"];
			}
			else
			{
				echo "0";
			}
			?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"talk","action"=>"view",$rm_["Messagefield"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
	<?php
	if($this->paginator->counter("{:pages}")>1)
	{
	?>
	<div class="pager">
		<ul class="float">
			<li>
				<?php echo $this->Paginator->prev('<<',array(),null,array('class'=>'prev disabled',"tag"=>"a")); ?>
			</li>
			<?php echo $this->Paginator->numbers(array('separator'=>'',"tag"=>"li","currentClass"=>"active")); ?>
			<li>
				<?php echo $this->Paginator->next('>>',array(),null,array('class'=>'next disabled',"tag"=>"a")); ?>
			</li>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
</div>