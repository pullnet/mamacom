<div class="bread">
	<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
	送信メールログ一覧
</div>
<h1>送信メールログ一覧</h1>
<?php
if(isset($alert))
{
?>
<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<p class="h3">全<?php echo $totalcount; ?>件</p>
<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

<div class="right mb20">
	<?php //echo $this->Html->link("メール送信新規追加",array("controller"=>"mailformat","action"=>"edit"),array("class"=>"buttons")); ?>
</div>


<table cellspacing="0" cellpadding="0" class="list mb20">
<tr>
	<th class="micro">No</th>
	<th class="minishort">送信日</th>
	<th class="short">送信先</th>
	<th class="short">発信者</th>
	<th>メール件名</th>
	<th class="mini"></th>
</tr>
<?php
$count=$limit*($page-1);
foreach($result as $r_){
	$count++;
?>
<tr>
	<td class="center"><?php echo $count; ?></td>
	<td><?php echo date("Y-m-d H:i",strtotime($r_["Maillog"]["refreshdate"])); ?></td>
	<td>
	<?php
		echo h(@$r_["Touser"]["nickname"])."<br>";
		$address=explode("|",$r_["Maillog"]["mailaddress"]);
		echo $address[0];
	?>
	</td>

	<td>
	<?php
	if($r_["Maillog"]["createstatus"]==0){
		echo h(@$r_["Fromuser"]["nickname"]);
	}
	else
	{
		echo "コラボス運営";
	}
	?>
	</td>

	<td><?php echo h($r_["Maillog"]["subject"]); ?></td>
	<td>
		<?php echo $this->Html->link("詳細",array("controller"=>"mail","action"=>"detail",$r_["Maillog"]["id"]),array("class"=>"buttons")); ?>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"mail","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"mail","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"mail","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	echo $this->Form->end();
	?>