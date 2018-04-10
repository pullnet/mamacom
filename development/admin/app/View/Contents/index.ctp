<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　コンテンツ一覧</div>
<h1>コンテンツ一覧</h1>
<?php
if(isset($alert))
{
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="right mb10">
	<?php echo $this->Html->link("コンテンツ新規登録",array("controller"=>"contents","action"=>"edit"),array("class"=>"buttons")); ?>
</div>

<div class="search">
	<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
	<label for="shdk" class="toggle">検索フォーム</label>
	<div class="window">
			<?php echo $this->Form->create(null,array(
				"type"=>"get",
				"url"=>array("controller"=>"contents","action"=>"index",$page),
				"inputDefaults"=>array(
					"div"=>false,
					"label"=>false,
					"legend"=>false,
					"required"=>false,
				),
			));
			?>
			<table cellspacing="0" cellpadding="0" class="mb20">
			<tr>
				<th>キーワード検索</th>
				<td>
					<?php echo $this->Form->input("keyword",array("value"=>@$this->request->query["keyword"])); ?>
				</td>
			</tr>
			<tr>
				<th>カテゴリー</th>
				<td>
					<?php echo $this->Form->select("category",$category_list,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["category"])); ?>
				</td>
			</tr>
			<tr>
				<th>地区</th>
				<td>
					<?php echo $this->Form->select("district",$district_list,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["district"])); ?>
				</td>
			</tr>			
			</table>
			<div class="center">
				<?php echo $this->Form->submit("検索する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div><!--//.search-->


<p class="h3">全<?php echo $totalcount; ?>件</p>
<!--<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>-->

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>コンテンツタイトル</th>
		<th class="minishort">カテゴリー</th>
		<th class="minishort">地区</th>
		<th class="minishort"></th>
	</tr>
	<?php
	//$count=$limit*($page-1);
	$count=1;
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y.m.d H:i",strtotime($r_["Contents"]["createdate"])); ?></td>
		<td><?php echo h($r_["Contents"]["title"]); ?></td>
		<td><?php echo @$category_list[@$r_["Contents"]["category_id"]]; ?></td>
		<td><?php echo @$district_list[@$r_["Contents"]["district_id"]]; ?></td>

		<td>
			<?php echo $this->Html->link("編集",array("controller"=>"contents","action"=>"edit",$r_["Contents"]["id"]),array("class"=>"buttons")); ?>

			<label for="delete_<?php echo $count; ?>" class="buttons del">削除</label>
			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<div class="basejavar"></div>
				<div class="window short">
					<div class="bs">
						<h2 class="mb30">「<?php echo $r_["Contents"]["title"]; ?>」のページカテゴリーを削除します</h2>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"contents","action"=>"delete",$r_["Contents"]["id"]),array("class"=>"buttons del")); ?>
						</div>
					</div>
				</div>
			</div>

		</td>
	</tr>
	<?php
	}
	?>
	</table>