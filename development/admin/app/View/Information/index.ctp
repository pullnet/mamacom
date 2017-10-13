<div class="bread">
	<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
	インフォメーション一覧
</div>
<h1>インフォメーション一覧</h1>
<?php
if(isset($alert))
{
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="right mb10">
	<?php echo $this->Html->link("新規登録",array("controller"=>"information","action"=>"edit"),array("class"=>"buttons")); ?>
</div>
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">投稿日</th>
		<th>タイトル</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
		<tr>
			<td class="center"><?php echo $count; ?></td>
			<td><?php echo date("Y.m.d H:i",strtotime($r_["Information"]["createdate"])); ?></td>
			<td><?php echo $this->Html->link( $r_["Information"]["title"] ,array("controller"=>"test_view","action"=>"information",$r_["Information"]["id"]),array("class"=>"")); ?>	</td>
			<td>
				<?php echo $this->Html->link("編集",array("controller"=>"information","action"=>"edit",$r_["Information"]["id"]),array("class"=>"buttons")); ?>
				<label for="deletepop<?php echo $count; ?>" class="buttons">削除</label>
				<div id="popup">
					<input type="checkbox" id="deletepop<?php echo $count; ?>" class="checks">
					<label></label>
					<div class="basejavar"></div>
					<div class="window short">
						<div class="bs">
							<h2 class="mb30">「<?php echo $r_["Information"]["title"]; ?>」を削除します</h2>
							<div class="center">
								<label for="deletepop<?php echo $count; ?>" class="buttons">キャンセル</label>
								<?php echo $this->Html->link("削除する",array("controller"=>"information","action"=>"delete",$r_["Information"]["id"]),array("class"=>"buttons del")); ?>
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
