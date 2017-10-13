<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　フリーページ設定</div>
<h1>フリーページ設定</h1>

<div class="gnavi">
	<ul class="float">
		<li class="active"><?php echo $this->Html->link("フリーページ一覧",array("controller"=>"freepage","action"=>"index",$page)); ?></li>
		<li><?php echo $this->Html->link("フリーページカテゴリー一覧",array("controller"=>"pagecategory","action"=>"index")); ?></li>
	</ul>
</div>

<?php
if(isset($alert))
{
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="search">
	<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
	<label for="shdk" class="toggle">検索フォーム</label>
	<div class="window">
			<?php echo $this->Form->create(null,array(
				"type"=>"get",
				"url"=>array("controller"=>"freepage","action"=>"index",$page),
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
			</table>
			<div class="center">
				<?php echo $this->Form->submit("検索する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
		<?php echo $this->Form->end(); ?>
	</div><!--//.window-->
</div><!--//.search-->

<div class="right mb10">
	<?php echo $this->Html->link("ページ新規登録",array("controller"=>"freepage","action"=>"edit"),array("class"=>"buttons")); ?>
</div>
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th>ページタイトル</th>
		<th class="minishort">カテゴリー</th>
		<th class="minishort">表示/公開設定</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
		<tr>
			<td class="center"><?php echo $count; ?></td>
			<td><?php echo date("Y.m.d H:i",strtotime($r_["Freepage"]["createdate"])); ?></td>
			
			
			
			<td><?php echo $this->Html->link( $r_["Freepage"]["name"] ,array("controller"=>"test_view","action"=>"freepage",$r_["Freepage"]["id"]),array("class"=>"")); ?>	</td>

<!--		
			<?php echo $r_["Freepage"]["name"]; ?>　　
			<?php
			if($r_["Freepagecategory"]){
				$aurl_short=$r_["Freepagecategory"]["permalink"]."/".$r_["Freepage"]["permalink"];
				$aurl=$wwwurl."lp/".$r_["Freepagecategory"]["permalink"]."/".$r_["Freepage"]["permalink"];
			}
			else
			{
				$aurl_short=$r_["Freepage"]["permalink"];
				$aurl=$wwwurl."lp/".$r_["Freepage"]["permalink"];
			}
			echo $this->Html->link($aurl_short,$aurl,array("target"=>"_blank","class"=>"underline")); ?>
-->
	
			
			<td><?php echo $category_list[$r_["Freepage"]["freepagecategory_id"]]; ?></td>

			<td><?php echo $page_status[$r_["Freepage"]["page_status"]]; ?>/<?php echo $open_status[$r_["Freepage"]["open_status"]]; ?></td>
			<td>
				<?php echo $this->Html->link("編集",array("controller"=>"freepage","action"=>"edit",$r_["Freepage"]["id"]),array("class"=>"buttons")); ?>
				
				<label for="deletepop<?php echo $count; ?>" class="buttons">削除</label>
				<div id="popup">
					<input type="checkbox" id="deletepop<?php echo $count; ?>" class="checks">
					<label></label>
					<div class="basejavar"></div>
					<div class="window short">
						<div class="bs">
							<h2 class="mb30">「<?php echo $r_["Freepage"]["name"]; ?>」の固定ページを削除します</h2>
							<div class="center">
								<label for="deletepop<?php echo $count; ?>" class="buttons">キャンセル</label>
								<?php echo $this->Html->link("削除する",array("controller"=>"freepage","action"=>"delete",$r_["Freepage"]["id"]),array("class"=>"buttons del")); ?>
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
	<?php
	if($totalpage>=2){
	?>
	<div class="pager">
		<ul class="float">
			<?php
			if($page>=2){
			?>
			<li><?php echo $this->Html->link("<",array("controller"=>"freepage","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"freepage","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"freepage","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>
	<div class="right mb10">
		<?php echo $this->Html->link("一覧情報をcsv出力",array("controller"=>"freepage","action"=>"dataexport"),array("class"=>"buttons")); ?>
	</div>
