<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link($result_content["Content"]["title"]."の詳細",array("controller"=>"library","action"=>"view",$result_content["Content"]["id"])); ?>
　＞　受注設定一覧
</div>
<h1>「<?php echo $result_content["Content"]["title"]; ?>」の受注設定一覧</h1>
<div class="main_content">
	<div class="gnavi">
		<ul class="float">
			<li><?php echo $this->Html->link("ライブラリを編集",array("controller"=>"library","action"=>"edit",$result_content["Content"]["user_id"],$result_content["Content"]["id"])); ?></li>
			<li class="active"><?php echo $this->Html->link("受注設定一覧",array("controller"=>"library","action"=>"ordersetlist",$result_content["Content"]["id"])); ?></li>
		</ul>
	</div><!--//.gnavi-->
	<p><?php echo $this->paginator->counter(array("format"=>"{:count}件中 {:start}～{:end}件を表示")); ?></p>
<div class="right mb10">
	<?php echo $this->Html->link("受注設定を新規登録",array("controller"=>"library","action"=>"ordersetedit",$result_content["Content"]["id"]),array("class"=>"buttons")); ?>
</div>
	<table cellspacing="0" cellpadding="0">
	<tr>
		<th style="width:30px;text-align:center;">✓</th>
		<th style="width:100px">登録日</th>
		<th>受注タイトル</th>
		<th style="width:80px">状況</th>
		<th style="width:60px"></th>
	</tr>
	<?php
	foreach($result as $r_)
	{
	?>
	<tr>
		<td class="center">
			<label><input type="checkbox" name="checkes[0]"></label>
		</td>
		<td>
			<?php echo date("Y-m-d H:i",strtotime($r_["Libraryorderset"]["createdate"])); ?>
		</td>
		<td>
			<?php echo $r_["Libraryorderset"]["title"]; ?>
		</td>
		<td>
			<?php 
if($r_["Libraryorderset"]["order_type"])
{
	echo $libraryreleace[$r_["Libraryorderset"]["order_type"]];
}
else
{
	echo "-";
}
?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"library","action"=>"ordersetview",$r_["Libraryorderset"]["id"]),array("class"=>"buttons")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

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
	<div class="right mb20">
		<?php echo $this->Html->link("一覧情報をcsv出力",array("controller"=>"library","action"=>"dataexport_orderset",$result_content["Content"]["id"]),array("class"=>"buttons")); ?>
	</div>
</div>
