<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　画像管理</div>
	<h1>画像管理</h1>
	<div class="gnavi">
		<ul class="float">
			<li <?php if($this->params["action"]=="index"){ echo 'class="active"'; } ?>><?php echo $this->Html->link("ページ設定",array("controller"=>"freepage","action"=>"index")); ?></li>
			<li <?php if($this->params["action"]=="image"){ echo 'class="active"'; } ?>><?php echo $this->Html->link("画像管理",array("controller"=>"freepage","action"=>"image")); ?></li>
		
		</ul>
	</div>
	<div class="right mb10">
		<?php echo $this->Html->link("新規画像登録",array("controller"=>"freepage","action"=>"imageedit"),array("class"=>"buttons")); ?>
	</div>
	<div class="main_content">
		<table cellspacing="0" cellpadding="0">
		<tr>
			<th style="width:60px">✔</th>
			<th style="width:150px">登録日</th>
			<th>画像</th>
			<th style="width:150px">ファイル名</th>
			<th></th>
		</tr>
		<tr>
			<td><label><input type="checkbox"></label></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</table>
	</div>