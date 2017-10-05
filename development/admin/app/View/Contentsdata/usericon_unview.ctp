<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　未使用のユーザーアイコン一覧</div>
<h1>未使用のユーザーアイコン一覧</h1>
<div class="mb10">
	<label for="delete_all" class="buttons" style="background:#900;border:solid 1px #900;">未使用のユーザーアイコンを一括消去する</label>
	<div id="popup">
		<input type="checkbox" id="delete_all" class="checks">
		<label></label>
		<label for="delete_all" class="basejavar"></label>
		<div class="window">
			<div class="bs">
				<h1>未使用のユーザーアイコンを一括削除します</h1>
				<div class="center">
					<label for="delete_all" class="buttons backbtn">キャンセル</label>
					<?php echo $this->Html->link("一括削除する",array("controller"=>"contentsdata","action"=>"usericon_unview","delete_run"),array("div"=>false,"class"=>"buttons")); ?>
				</div>
			</div><!--//.bs-->
		</div><!--//.window-->
	</div><!--//#popup-->
</div>
<div class="main_content">

	<table cellspacing="0" cellpadding="0" class="list mb30">
	<tr>
		<th class="micro">No</th>
		<th class="mini">画像</th>
		<th>画像コード</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=0;
	foreach($getdata as $g_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td>
			<div style="width:100px;position:relative;padding-bottom:100%;overflow:hidden;">
				<?php echo $this->Html->image($itemurl.$g_,array("style"=>"width:100%;position:absolute;")); ?>
			</div>
		</td>
		<td>
			<?php echo basename($g_); ?>
		</td>
		<td>
			<?php echo $this->Html->link("確認チェック",array("controller"=>"contentsdata","action"=>"check_usericon",basename($g_)),array("class"=>"underline")); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
</div><!--//.main_content-->