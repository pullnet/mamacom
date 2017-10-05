<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　メールフォーマット一覧</div>
	<h1>メールフォーマット一覧</h1>
	<?php
	if(isset($alert))
	{
	?>
	<div class="alert-message"><?php echo $alert; ?></div>
	<?php
	}
	?>

	<div class="navi mb20">
<?php
echo $this->Html->link("すべて",array("controller"=>"mailformat","action"=>"index",$page,"?"=>$this->request->query),array("class"=>"underline mr10"));
$format_category_key=array_keys($format_category);
$ind=0;
foreach($format_category as $fc_){
	echo $this->Html->link(h($fc_),array("controller"=>"mailformat","action"=>"index",$page,$format_category_key[$ind],"?"=>$this->request->query),array("class"=>"underline mr10"));
	$ind++;
}
?>
	</div>

	<div class="main_content">
		<div class="search">
			<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
			<label for="shdk" class="toggle">検索フォーム</label>
			<div class="window">
			<?php
			echo $this->Form->create(null,array(
				"type"=>"get",
				"url"=>array("controller"=>"mailformat","action"=>"index",$page,$category),
				"inputDefaults"=>array(
					"div"=>false,
					"label"=>false,
					"legend"=>false,
					"required"=>false,
				),
			));
			?>
			<table cellspacing="0" cellpadding="0" class="mb10">
			<tr>
				<th>キーワード検索</th>
				<td>
					<?php echo $this->Form->input("keyword",array("value"=>@$this->request->query["keyword"])); ?>
				</td>
			</tr>
			</table>
			<div class="center">
				<?php echo $this->Form->submit("検索する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
			<?php echo $this->Form->end(); ?>
			</div><!--//.window-->
		</div><!--//.search-->
		<p class="h3">全<?php echo $totalcount; ?>件</p>
		<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

		<div class="right mb20">
			<?php echo $this->Html->link("メールフォーマット新規追加",array("controller"=>"mailformat","action"=>"edit"),array("class"=>"buttons")); ?>
		</div>
		<table cellspacing="0" cellpadding="0" class="list mb20">
		<tr>
			<th class="micro">No</th>
			<th class="minishort">登録日</th>
			<th class="minishort">カテゴリー</th>
			<th>フォーマット情報</th>
			<th class="minishort">サブカテゴリー</th>
			<th class="minishort"></th>
		</tr>
		<?php
		$count=$limit*($page-1);
		foreach($result as $r_){
			$count++;
		?>
		<tr>
			<td class="center"><?php echo $count; ?></td>
			<td><?php echo date("Y-m-d H:i",strtotime($r_["Mailformat"]["refreshdate"])); ?></td>
			<td><?php echo @$format_category[$r_["Mailformat"]["category"]]; ?></td>
			<td>
				<p><?php echo h($r_["Mailformat"]["name"]); ?></p>
				<p>フォーマットコード:<?php echo h($r_["Mailformat"]["code"]); ?></p>
			</td>
			<td>
				<?php echo h($r_["Mailformat"]["sub_category"]); ?>
			</td>
			<td>
				<?php echo $this->Html->link("詳細",array("controller"=>"mailformat","action"=>"view",$r_["Mailformat"]["id"]),array("class"=>"buttons")); ?>
				<label for="delete_<?php echo $count; ?>" class="buttons backbtn">削除</label>
				<div id="popup">
					<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
					<label></label>
					<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
					<div class="window short">
						<div class="bs">
							<h2 class="mb20">メールフォーマットの削除</h2>
							<p class="mb30">削除しますか？</p>
							<div class="center">
								<label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label>
								<?php echo $this->Html->link("削除する",array("controller"=>"mailformat","action"=>"delete",$r_["Mailformat"]["id"],$page,$category),array("class"=>"buttons")); ?>
							</div>
						</div>
					</div>
				</div><!--//#popup-->
			</td>
		</tr>
		<?php
		}
		?>
		</table>
		<?php
		if($totalpage>=2){
		?>
		<div class="pager">
			<ul class="float">
				<?php
				if($page>=2){
				?>
				<li><?php echo $this->Html->link("<",array("controller"=>"mailformat","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
				<?php
				}
				for($svc=1;$svc<=$totalpage;$svc++){
				?>
				<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"mailformat","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
				<?php
				}
				if($page<=($totalpage-1)){
				?>
				<li><?php echo $this->Html->link(">",array("controller"=>"mailformat","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
				<?php
				}
				?>
			</ul>
		</div><!--//.pager-->
		<?php
		}
		?>
		<div class="right mb20">
			<?php echo $this->Html->link("一覧情報をcsv出力",array("controller"=>"mailformat","action"=>"dataexport"),array("class"=>"buttons")); ?>
		</div>

	</div>
