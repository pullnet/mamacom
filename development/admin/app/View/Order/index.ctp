<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　注文情報一覧</div>
<h1>注文情報一覧</h1>
<?php
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="main_content">
	<div class="search">
		<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
		<label for="shdk" class="toggle">検索フォーム</label>
		<div class="window">
			<?php
			echo $this->Form->create("",array(
				"type"=>"get",
				"url"=>array("controller"=>"order","action"=>"index",1,"?"=>@$this->request->query),
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
					<p>現状検索できるワード:注文番号、発注者名、受注者名</p>
					<?php echo $this->Form->input("keyword",array("value"=>@$this->request->query["keyword"])); ?>
				</td>
			</tr>
			<tr>
				<th>注文形態</th>
				<td>
					<?php echo $this->Form->select("type",array(1=>"ライブラリ発注",2=>"コラボ参加"),array("class"=>"short","empty"=>"---","value"=>@$this->request->query["type"])); ?>
				</td>
			</tr>

			<tr>
				<th>注文ステータス</th>
				<td>
					<?php echo $this->Form->select("order_status",$orderstatus,array("class"=>"short","empty"=>"---","value"=>@$this->request->query["order_status"])); ?>
				</td>
			</tr>

			</table>
			<div class="center">
				<input class="buttons" type="submit" value="検索する"/>
			</div>
			<?php echo $this->Form->end(); ?>
		</div><!--//.window-->
	</div><!--//.search-->

<?php
echo $this->Form->create("Orderselect",array(
	"id"=>"orderselect_form",
	"inputDefaults"=>$inputDefaults,
));
echo $this->Form->hidden("type",array("id"=>"hidden_changetype"));
?>

<div class="mb10">
	<div class="mb10">
		<p class="mb5">選択した受注情報</p>
		<label for="select_change_status" class="buttons">ステータス変更</label>
		<label for="select_sendmail" class="buttons">メール送信</label>
	</div>
</div>

<div id="popup">
	<input type="checkbox" id="select_change_status" class="checks">
	<label></label>
	<label for="select_change_status" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1 class="mb10">受注ステータス一括変更</h1>
			<p class="mb10">一括変更するステータスを選択して下さい</p>
			<p class="mb10">
				<?php
					$orderstatus0=$orderstatus;
					unset($orderstatus0["paycomplete_workquery"]);
					echo $this->Form->select("change_orderstatus",$orderstatus0,array("class"=>"short","empty"=>"--ステータスを選択--","disabled"=>array("autholy_error")));
				?>
			</p>
			<p class="mb20">
				<label>
					<?php echo $this->Form->input("auto_sendmail",array("type"=>"checkbox","class"=>"middle","value"=>true,"checked"=>true)); ?>
					<span class="middle"></span>
					同時にメール通知する
				</label>
			</p>
			<div class="center">
				<label for="select_change_status" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Form->button("変更する",array("div"=>false,"type"=>"button","class"=>"buttons","id"=>"submit_change_status")); ?>
			</div>
		</div>
	</div>
</div><!--//#popup-->
<div id="popup">
	<input type="checkbox" id="select_sendmail" class="checks">
	<label></label>
	<label for="select_sendmail" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1 class="mb10">メール一括送信</h1>
			<p class="mb10">一括送信するメールフォーマットを選択して下さい</p>
			<p class="mb10">
				<?php echo $this->Form->select("send_mailformat",$mail_format,array("style"=>"width:400px;","empty"=>"--送信メールフォーマットを選択--")); ?>
			</p>
			<div class="center">
				<label for="select_sendmail" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Form->button("送信設定へ",array("div"=>false,"type"=>"button","class"=>"buttons","id"=>"submit_send_mail")); ?>
			</div>
		</div>
	</div>
</div><!--//#popup-->




	<p class="h3">全<?php echo count($result); ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<p>※<span style="background:#fcc;width:10px;height:10px;display:inline-block;"></span>部分....新規の注文情報</p>
	<p>※<span style="background:#e0e0e0;width:10px;height:10px;display:inline-block;"></span>部分....振込完了の注文情報</p>
	<style>
	table tr.default{
		background:#f0f0f0;
	}
	</style>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th style="width:20px">✔</th>
		<th style="width:200px">発注日/注文番号</th>
		<th style="width:200px">納品/振込依頼/振込完了日</th>
		<th style="width:200px">受注額/支払/ステータス</th>
		<th>発注内容</th>
		<th style="width:150px">発注者/受注者</th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;

		//各日付の取得...
	?>
	<tr class="
		<?php
		if($r_["Order"]["order_status"]=="neworder"){
			echo "bg_pink";
		}
		else if($r_["Order"]["order_status"]=="transfer_complete"){
			echo "bg_gray";
		}
		?>">
		<td class="center">
			<?php
			if($r_["Order"]["order_status"]!="cancel" && $r_["Order"]["order_status"]!="transfer_complete"){
			?>
			<label>
				<?php echo $this->Form->input("Orderselect.check.".$count,array("type"=>"checkbox","class"=>"middle","value"=>$r_["Order"]["id"])); ?>
				<span style="margin-right:0px;"></span>
			</label>
			<?php
			}
			?>
		</td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["order_date"])); ?><br>
		<?php echo $this->Html->link(h($r_["Order"]["number"]),array("controller"=>"order","action"=>"detail",$r_["Order"]["id"]),array("class"=>"underline")); ?></td>
		<td>
		<?php
		if(@$r_["Order"]["forward_date"]){
			echo "<p><span style='background:#cfc'>納品</span>".date("Y-m-d H:i",strtotime($r_["Order"]["forward_date"]))."</p>";
		}
		if(@$r_["Order"]["claim_startdate"]){
			echo "<p><span style='background:#fcc'>振込</span>".date("Y-m-d H:i",strtotime($r_["Order"]["claim_startdate"]))."</p>";
		}
		if(@$r_["Order"]["claim_exitdate"]){
			echo "<p><span style='background:#aaa'>振完</span>".date("Y-m-d H:i",strtotime($r_["Order"]["claim_exitdate"]))."</p>";
		}

		if(@$r_["Order"]["claim_startdate"]){
			if(!@$r_["Order"]["claim_exitdate"]){
				if(date("d")<15){
					$claim_exitdate_plan=date("Y-m-t");
				}
				else
				{
					if(date("d")==31){
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 day"));
					}
					else
					{
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 month"));
					}
				}
			?>
			<p class="red"><span style="background:#900;color:#fff">振予</span><?php echo date("Y-m-d",strtotime($claim_exitdate_plan)); ?><p>
			<?php
			}
		}
		?>

		</td>
		<td>
			￥<?php echo number_format($r_["Order"]["hope_price"]); ?><br>
		<?php
		if($r_["Order"]["payment"]==4){
			echo '<p style="color:#c00;">'.$payment[$r_["Order"]["payment"]]."</p>";
;
		}
		else
		{
			echo $payment[$r_["Order"]["payment"]];

		}
		?><br>

			<p><?php echo $orderstatus[$r_["Order"]["order_status"]]; ?></p>
			<?php
			if($r_["Order"]["sendmail_status"]==1){
			?>
				<p class="red">メール未送信</p>
			<?php
			}
			?>

		</td>
		<td>
			<?php
			if($r_["Order"]["libraryorderset_id"]){
			?>
			<dl>
				<dt>発注ライブラリ名</dt>
				<dd style="margin-bottom:0px;"><?php echo h($r_["Contentbuffer"]["Content"]["title"]); ?><br>
				<?php echo h($r_["Contentbuffer"]["Libraryorderset"]["title"]); ?></dd>
			</dl>
			<?php
			}
			else if($r_["Order"]["collaboparty_id"]){
			?>
			<dl>
				<dt>参加コラボ名</dt>
				<dd style="margin-bottom:0px;"><?php echo h($r_["Contentbuffer"]["Content"]["title"]); ?><br>
				<?php echo h($r_["Contentbuffer"]["Collabopartyset"]["title"]); ?></dd>
			</dl>
			<?php
			}
			?>
		</td>
		<td>
			<?php
				echo h($r_["User"]["nickname"]);
			?>
/
			<?php
				echo h($r_["Inputuser"]["nickname"]);
			?>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"order","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"order","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"order","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	echo $this->Form->end();
	?>

</div>

<script type="text/javascript">
$(function(){
	$("#submit_change_status").on("click",function(){
		$("#hidden_changetype").val("change_status");
		$("#orderselect_form").submit();
	});

	$("#submit_send_mail").on("click",function(){
		$("#hidden_changetype").val("sendmail");
		$("#orderselect_form").submit();

	});

});
</script>