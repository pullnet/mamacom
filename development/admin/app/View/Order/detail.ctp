<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("注文情報一覧",array("controller"=>"order","action"=>"index")); ?>　＞　
注文情報詳細
</div>
<div class="main_content">
<h1>注文情報詳細</h1>

<h2>受注情報</h2>
<?php
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}

if($result["Order"]["libraryorderset_id"]){
	$type="library";
}
else if($result["Order"]["collaboparty_id"]){
	$type="collabo";
}

?>

<?php
echo $this->Form->create("Order",array(
	"id"=>"orderselect_form",
	"inputDefaults"=>$inputDefaults,
));
echo $this->Form->hidden("type",array("id"=>"hidden_changetype"));
?>

<div class="mb10">
	<div class="mb10">
		<label for="select_change_status" class="buttons">ステータス変更</label>
		<label for="select_sendmail" class="buttons">メール送信</label>
		<label for="delete_order" class="buttons" style="background:#900;border:solid 1px #900;">この受注情報を削除</label>
	</div>
</div>

<div id="popup">
	<input type="checkbox" id="select_change_status" class="checks">
	<label></label>
	<label for="select_change_status" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1 class="mb10">受注ステータス一括変更</h1>
			<p class="mb10">変更するステータスを選択して下さい</p>
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
			<h1 class="mb10">メール送信</h1>
			<p class="mb10">送信するメールフォーマットを選択して下さい</p>
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
<?php
echo $this->Form->end();
?>
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

<?php echo $this->Html->link("メール送信履歴",array("controller"=>"order","action"=>"maillog",$result["Order"]["id"]),array("class"=>"underline")); ?>

<table cellspacing="0" cellpadding="0" class="mb30">
<?php
if($type=="library"){
?>
<tr>
	<th>ライブラリタイトル</th>
	<td>
		<p class="h2"><?php echo h($result["Contentbuffer"]["Content"]["title"]); ?></p>
		<p class="h3"><?php echo h($result["Contentbuffer"]["Libraryorderset"]["title"]); ?></p>
		<div class="">
			<?php echo $this->Html->link("詳細を見る",$wwwurl.$result["Inuser"]["username"]."/library/detail/id:".$result["Contentbuffer"]["Content"]["id"],array("target"=>"_blank","class"=>"underline")); ?>
		</div>
	</td>
</tr>
<?php
}
else if($type=="collabo"){
?>
<tr>
	<th>コラボタイトル</th>
	<td>
		<p class="h2"><?php echo h($result["Contentbuffer"]["Content"]["title"]); ?></p>
		<p class="h3"><?php echo h($result["Contentbuffer"]["Collabopartyset"]["title"]); ?></p>
		<div class="">
			<?php echo $this->Html->link("詳細を見る",$wwwurl.$result["Outuser"]["username"]."/library/detail/id:".$result["Contentbuffer"]["Content"]["id"],array("target"=>"_blank","class"=>"underline")); ?>
		</div>
	</td>
</tr>
<?php
}
?>
<tr>
	<th>登録日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Order"]["order_date"])); ?>
	</td>
</tr>
<?php
if(@$result["Order"]["order_date"]){
?>
<tr>
	<th>注文日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Order"]["order_date"])); ?>
	</td>
</tr>
<?php
}
if(@$result["Order"]["payment_exitdate"]){
?>
<tr>
	<th>作業開始日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Order"]["payment_exitdate"])); ?>
	</td>
</tr>
<?php
}
if(@$result["Order"]["pre_forward_date"]){
?>
<tr>
	<th>納品日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Order"]["pre_forward_date"])); ?>
	</td>
</tr>
<?php
}
?>
<tr>
	<th>ステータス</th>
	<td>
		<p class="h3"><?php echo $orderstatus[$result["Order"]["order_status"]]; ?></p>
		<?php
		if($result["Order"]["sendmail_status"]==1){
			echo '<p class="red">メール未送信</p>';
		}
		?>
	</td>
</tr>
<tr>
	<th>希望金額</th>
	<td>
		<p class="h3">￥<?php echo number_format($result["Order"]["base_price"]); ?></p>
	</td>
</tr>
<tr>
	<th>受注金額</th>
	<td>
		<p class="h3">￥<?php echo number_format($result["Order"]["hope_price"]); ?></p>
		<label for="change_price" class="buttons">変更する</label>
	</td>
</tr>

<?php
if(@$result["Order"]["claim_startdate"]){
?>
<tr>
	<th>振込依頼日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Order"]["claim_startdate"])); ?><br>
		<?php
		if(!@$result["Order"]["claim_exitdate"]){
			if(date("d")<15){
				$claim_exitdate_plan=date("Y-m-t");
			}
			else
			{
				if(date("d")==31){
					$claim_exitdate_plan=date("Y-m-15",strtotime("+1 day"));
				}
				else
				{
					$claim_exitdate_plan=date("Y-m-15",strtotime("+1 month"));
				}
			}
		?>
		(振込予定日 : <?php echo $claim_exitdate_plan; ?>)
		<?php
		}
		?>
	</td>
</tr>
<?php
}
if(@$result["Order"]["claim_exitdate"]){
?>
<tr>
	<th>振込完了日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Order"]["claim_exitdate"])); ?>
	</td>
</tr>
<?php
}
if($result["Order"]["libraryorderset_id"]){
?>
<tr>
	<th>希望納期</th>
	<td>
		<p><?php echo date("Y年m月d日",strtotime($result["Order"]["hope_delivary"])); ?></p>
		<label for="change_hope_delivary" class="buttons">変更する</label>
	</td>
</tr>
<?php
}
?>
<tr>
	<th>発注数</th>
	<td>
		<p class="h3">x<?php echo $result["Order"]["order_count"]; ?></p>
		<label for="change_order_count" class="buttons">変更する</label>
	</td>
</tr>
<tr>
	<th>合計金額</th>
	<td>
		<p class="h3">￥<?php echo number_format($result["Order"]["order_count"]*$result["Order"]["hope_price"]); ?></p>
	</td>
</tr>
<tr>
	<th>振込金額</th>
	<td>
		<p class="h3">￥<?php echo number_format($result["Order"]["order_count"]*$result["Order"]["hope_price"]*(1-$result["Order"]["commission"]*0.01)); ?></p>
	</td>
</tr>
<tr>
	<th>手数料</th>
	<td>
		￥<?php echo number_format($result["Order"]["order_count"]*$result["Order"]["hope_price"]*($result["Order"]["commission"]*0.01)); ?><br>
		(割合:<?php echo $result["Order"]["commission"]; ?>%)
	</td>
</tr>
<tr>
	<th>振込先</th>
	<td>
		<?php
if($result["Inuser"]["paypool_json"]){
	$json_paypool=json_decode($result["Inuser"]["paypool_json"],true);
?>
	<dl class="list">
		<dt>銀行名</dt>
		<dd><?php echo $json_paypool["name"]; ?></dd>
		<dt>支店名</dt>
		<dd><?php echo $json_paypool["area"]; ?></dd>
		<dt>口座種別</dt>
		<dd><?php
		$bank_type=array(0=>"普通",1=>"当座");
		echo $bank_type[$json_paypool["type"]]; ?></dd>
		<dt>口座番号</dt>
		<dd><?php echo $json_paypool["number"]; ?></dd>
		<dt>口座名義</dt>
		<dd><?php echo $json_paypool["user"]; ?></dd>
	</dl>
<?php
}
else
{
	echo "-振込先未設定-";
}
?>
	</td>
</tr>

<tr>
	<th>その他備考</th>
	<td>
		<p><?php echo h($result["Order"]["caption"]); ?></p>
		<label for="change_caption" class="buttons">変更する</label>
	</td>
</tr>



</table>

<h2>受注者情報</h2>
<table class="mb30">
<tr>
	<th>受注者名</th>
	<td>
		<?php
		echo $this->Html->link($result["Inuser"]["nickname"]."さん",array("controller"=>"users","action"=>"view",$result["Inuser"]["id"]),array("class"=>"underline"));
		?>
	</td>
</tr>
<tr>
	<th>連絡先</th>
	<td>
		<p>メールアドレス:<?php echo $result["Inuser"]["mailaddress"]; ?></p>
	</td>
</tr>
<tr>
	<th>カテゴリ等</th>
	<td>

	</td>
</tr>
</table>

<h2>発注者情報</h2>
<table class="mb30">
<tr>
	<th>発注者情報</th>
	<td>
		<?php
		echo $this->Html->link($result["Outuser"]["nickname"]."さん",array("controller"=>"users","action"=>"view",$result["Outuser"]["id"]),array("class"=>"underline"));
		?>
	</td>
</tr>
<tr>
	<th>連絡先</th>
	<td>
		<p>メールアドレス:<?php echo $result["Outuser"]["mailaddress"]; ?></p>
	</td>
</tr>
<tr>
	<th>カテゴリ等</th>
	<td>

	</td>
</tr>
</table>

<h2>支払情報</h2>

<table>
<tr>
	<th>支払方法</th>
	<td>
		<p class="h3"><?php echo $payment[$result["Order"]["payment"]]; ?></p>
		<label for="change_payment" class="buttons">変更する</label>
		<?php
		if($result["Order"]["payment"]==1){
			$credit_json=json_decode($result["Order"]["credit_json"],true);
		?>
		<dl class="list">
			<dt>クレジット会社</dt>
			<dd>
				<?php echo $credit_company[$credit_json["corporate"]]; ?>
			</dd>
			<dt>クレジットカード番号</dt>
			<dd>
				<?php echo substr($credit_json["number"],1,4)."*************"; ?>
			</dd>
			<dt>クレジットカード名義</dt>
			<dd>
				<?php echo $credit_json["owner"]; ?>
			</dd>
			<dt>有効期限</dt>
			<dd>
				<?php echo $credit_json["limit_m"]; ?>月<?php echo $credit_json["limit_y"]; ?>年
			</dd>
		</dl>
		<?php
		}
		?>
	</td>
</tr>
<?php
if(@$payment_startdate){
?>
<tr>
	<th>支払請求日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($payment_startdate)); ?>
	</td>
</tr>
<?php
}
if(@$payment_exitdate){
?>
<tr>
	<th>支払確認日</th>
	<td>

		<?php echo date("Y-m-d H:i",strtotime($payment_exitdate)); ?>
	</td>
</tr>
<?php
}
?>
</table>
<div class="mb20">
	<?php //echo $this->Html->link("支払設定を免除(特別)",array("controller"=>"order","action"=>"special_payment",$result["Order"]["id"]),array("class"=>"underline")); ?>
</div>

<h2>振込情報</h2>
<table class="mb30">
<?php
if(@$claim_startdate){
?>
<tr>
	<th>振込依頼日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($claim_startdate)); ?><br>
		(振込予定日:<?php echo date("Y-m-d",strtotime($claim_exitdate_plan)); ?>)
		
	</td>
</tr>
<?php
}
if(@$claim_exitdate){
?>
<tr>
	<th>振込完了日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($claim_exitdate)); ?>
	</td>
</tr>
<?php
}
?>
</table>

<h2>注文履歴</h2>
<dl>
	<?php
	foreach($logdata as $l_){
	$l_json=json_decode($l_["Orderlog"]["caption"],true);
	?>
			<dt><?php echo date("Y-m-d H:i",strtotime($l_["Orderlog"]["change_date"])); ?></dt>
			<dd>
				<?php
				$section=array(
					"hope_delivary"=>"希望納期",
					"order_count"=>"発注数",
					"hope_price"=>"発注金額",
					"caption"=>"その他備考",
					"payment"=>"支払方法",
					"special_payment_status"=>"支払特別権限",
				);

				if($l_json["type"]=="change_status"){
				?>
					受注ステータスを「<?php echo $orderstatus[$l_json["order_status"]["after"]]; ?>」に変更。<br>

				<?php
				}
				else if($l_json["type"]=="edit"){
					echo "受注情報を変更しました。<br>(修正内容)<br>";

					foreach($l_json["edit"]["after"] as $key=>$la_){
						if($key=="payment"){
							?>
							<p>・<?php echo $section["payment"]." ".@$payment[$l_json["edit"]["before"]["payment"]]."=>".$payment[$la_]; ?></p>
							<?php
							break;
						}
						else
						{
							?>
							<p>・<?php echo $section[$key]." ".@$l_json["edit"]["before"][$key]."=>".$la_; ?></p>
							<?php
						}
					}

				}
				else if($l_json["type"]=="new"){
					echo "受注情報を受付開始しました。<br>";
				}
				?>
				(変更者:<?php
					if($l_["Orderlog"]["changeuser_status"]==0){
						if($result["Order"]["type"]=="library"){
							echo "受注(ライブラリ管理オーナー)";
						}
						else if($result["Order"]["type"]=="collabo"){
							echo "受注(コラボ参加者)";
						}
					}
					else if($l_["Orderlog"]["changeuser_status"]==1){
						if($result["Order"]["type"]=="library"){
							echo "発注(ライブラリ発注者)";
						}
						else if($result["Order"]["type"]=="collabo"){
							echo "発注(コラボ管理オーナー)";
						}
					}
					else if($l_["Orderlog"]["changeuser_status"]==2){
						echo "コラボス運営";
					}
				?>)
				<?php //echo $this->Html->link("履歴を削除",array("controller"=>"order","action"=>"log_delete",$result["Order"]["id"],$l_["Orderlog"]["id"]),array("class"=>"underline")); ?>
			</dd>
	<?php
	}
	?>
</dl>

</div>

<?php
echo $this->Form->create("Order",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("type",array("value"=>"price"));

?>
<div id="popup">
	<input type="checkbox" id="change_price" class="checks">
	<label></label>
	<label for="change_price" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>金額の変更</h1>
			<p class="mb10">金額を入力してください</p>
			<p class="mb10">￥ <?php echo $this->Form->input("hope_price",array("class"=>"short","default"=>$result["Order"]["hope_price"])); ?>
			<div class="center">
				<label for="change_price" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Form->submit("変更する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php
echo $this->Form->create("Order",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("type",array("value"=>"count"));

?>
<div id="popup">
	<input type="checkbox" id="change_order_count" class="checks">
	<label></label>
	<label for="change_order_count" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>発注数の変更</h1>
			<p class="mb10">発注数を入力してください</p>
			<p class="mb10"><?php echo $this->Form->input("order_count",array("class"=>"mini","default"=>$result["Order"]["order_count"])); ?> 個</p>
			<div class="center">
				<label for="change_order_count" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Form->submit("変更する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php
echo $this->Form->create("Order",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("type",array("value"=>"payment"));
$credit_json=json_decode($result["Order"]["credit_json"],true);
?>
<div id="popup">
	<input type="checkbox" id="change_payment" class="checks">
	<label></label>
	<label for="change_payment" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>支払方法の変更</h1>

			<p>支払方法:</p>
			<p class="mb10">
				<?php
				unset($payment[0],$payment[3],$payment[4]);
				echo $this->Form->select("payment",$payment,array("class"=>"short","default"=>$result["Order"]["payment"],"empty"=>false,"id"=>"select_payment")); ?>
			</p>
			<div class="type_credit">
				<p class="mb5">クレジット会社名:</p>
				<p class="mb10"><?php echo $this->Form->select("Order.credit.corporate",$credit_company,array("class"=>"short","default"=>@$credit_json["corporate"],"empty"=>false)); ?></p>
				<p class="mb5">クレジットカード番号:</p>
				<p class="mb10"><?php echo $this->Form->input("Order.credit.number",array("default"=>@$credit_json["number"])); ?></p>
				<p class="mb5">クレジットカード名義:</p>
				<p class="mb10"><?php echo $this->Form->input("Order.credit.owner",array("default"=>@$credit_json["owner"])); ?></p>
				<p class="mb5">有効期限</p>
				<p class="mb20">
				<?php 
				$limit_m=array();
				for($v0=1;$v0<12;$v0++){
					$limit_m[$v0]=$v0;
				}
				echo $this->Form->select("Order.credit.limit_m",$limit_m,array("class"=>"mini","default"=>@$credit_json["limit_m"],"empty"=>false)); ?> 月 
				<?php
				$limit_y=array();
				$nowyear=date("Y");

				for($v1=date("Y");$v1<($nowyear+30);$v1++){
					$limit_y[$v1]=$v1;
				}
				echo $this->Form->select("Order.credit.limit_y",$limit_y,array("class"=>"short","default"=>@$credit_json["limit_y"],"empty"=>false)); ?> 年 
				</p>
			</div>

			<div class="center">
				<label for="change_payment" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Form->submit("変更する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>


<?php
echo $this->Form->create("Order",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("type",array("value"=>"hope_delivary"));

?>
<div id="popup">
	<input type="checkbox" id="change_hope_delivary" class="checks">
	<label></label>
	<label for="change_hope_delivary" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>希望納期の変更</h1>
			<p class="mb10">希望納期を入力してください</p>
			<p class="mb20"><?php echo $this->Form->input("hope_delivary",array("type"=>"text","class"=>"short","default"=>$result["Order"]["hope_delivary"])); ?></p>
			<div class="center">
				<label for="change_hope_delivary" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Form->submit("変更する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php
echo $this->Form->create("Order",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("type",array("value"=>"caption"));

?>
<div id="popup">
	<input type="checkbox" id="change_caption" class="checks">
	<label></label>
	<label for="change_caption" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>その他備考欄の変更</h1>
			<p class="mb10">備考欄を入力してください</p>
			<p class="mb20"><?php echo $this->Form->textarea("caption",array("class"=>"short","default"=>$result["Order"]["caption"],"style"=>"width:100%;height:100px")); ?></p>
			<div class="center">
				<label for="change_hope_delivary" class="buttons backbtn">キャンセル</label>
				<?php echo $this->Form->submit("変更する",array("div"=>false,"class"=>"buttons")); ?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<div id="popup">
	<input type="checkbox" id="delete_order" class="checks">
	<label></label>
	<label for="delete_order" class="basejavar"></label>
	<div class="window short">
		<div class="bs">
			<h1>注文情報の削除</h1>
			<p class="mb10">
				ボタンをクリックしたらデータを削除したら元には戻せません、<br>
				削除しますか？
			</p>
			<div class="center">
				<?php echo $this->Html->link("削除する",array("controller"=>"order","action"=>"delete",$result["Order"]["id"]),array("class"=>"buttons","style"=>"background:#900;border:solid 1px #900;")); ?>
				<label for="delete_order" class="buttons">キャンセル</label>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	select_payment();
	$("#select_payment").on("change",function(){
		select_payment();
	});

	function select_payment(){
		var payment=$("#select_payment").val();

		if(payment==1){
			$(".type_credit").css({"display":""});

		}
		else if(payment==2){

			$(".type_credit").css({"display":"none"});

		}

	}
});
</script>