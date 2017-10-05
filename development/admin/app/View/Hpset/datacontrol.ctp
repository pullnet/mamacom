<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　データ管理</div>
<h1>データ管理</h1>
<div class="main_content">
	<?php echo $this->Element("common/hpset_gnavi"); ?>
	<table cellspacing="0" cellpadding="0">
	<tr>
		<th style="width:300px">サイト基本設定情報のcsvエクスポート</th>
		<td>
			<?php echo $this->Html->link("エクスポート",array("controller"=>"hpset","action"=>"dataexport"),array("style"=>"width:150px","class"=>"center buttons")); ?>
		</td>
	</tr>
<!--
	<tr>
		<th style="width:300px">サイト基本設定情報のcsvインポート</th>
		<td>
			<?php //echo $this->Html->link("インポート",array("controller"=>"hpset","action"=>"dataimport"),array("style"=>"width:150px","class"=>"center buttons")); ?>
		</td>
	</tr>
-->
	</table>
</div>