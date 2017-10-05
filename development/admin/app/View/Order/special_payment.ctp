<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("注文情報一覧",array("controller"=>"order","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("注文情報詳細",array("controller"=>"order","action"=>"detail",$result["Order"]["id"])); ?>　＞　
支払特別権限設定
</div>
<h1>支払特別権限設定</h1>

<?php
echo $this->Form->create("Order",array(
	"inputDefaults"=>$inputDefaults,
));

echo $this->Form->hidden("id");
?>

<table class="mb20">
<tr>
	<th>支払特別権限</th>
	<td>
		<div id="swradio">
			<?php echo $this->Form->radio("special_payment_status",array(0=>"設定なし",1=>"特別権限を設定(支払を免除)"),array("legend"=>false)); ?>
		</div>
	</td>
</tr>
</table>

<div class="center">
	<?php echo $this->Form->submit("設定する",array("div"=>false,"class"=>"buttons")); ?>
</div>
<?php echo $this->Form->end(); ?>