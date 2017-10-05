<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("コラボ参加表明情報一覧",array("controller"=>"cparty","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("コラボ参加表明情報詳細",array("controller"=>"cparty","action"=>"detail",$result["Collaboparty"]["id"])); ?>　＞　
コラボ参加表明情報設定
</div>
<h1>コラボ参加表明情報設定</h1>
<div class="main_content">
<?php
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>

<?php
echo $this->Form->create("Collaboparty",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("id",array("value"=>$result["Collaboparty"]["id"]));
?>
<table cellspacing="0" cellpadding="0" class="mb30">
<tr>
	<th>コラボ管理番号</th>
	<td>
		<?php echo h($result["Collaboparty"]["number"]); ?>
	</td>
</tr>
<tr>
	<th>参加表明日</th>
	<td>
		<?php echo date("Y-m-d H:i",strtotime($result["Collaboparty"]["party_date"])); ?>
	</td>
</tr>
<tr>
	<th>参加コラボ情報</th>
	<td>
		<dl>
			<dt>コラボ名</dt>
			<dd>
				<?php echo h($result["Contentbuffer"]["Content"]["title"]); ?>
			</dd>
			<dt>参加タイトル</dt>
			<dd>
				<?php echo h($result["Contentbuffer"]["Collabopartyset"]["title"]); ?>
			</dd>
		</dl>
		<div class="">
			<?php echo $this->Html->link("詳細を見る",$wwwurl.$result["User_1"]["username"]."/library/detail/id:".$result["Contentbuffer"]["Content"]["id"],array("target"=>"_blank","class"=>"underline")); ?>
		</div>
	</td>
</tr>
<tr>
	<th>ユーザー情報</th>
	<td>
		<dl>
			<dt>コラボ管理者</dt>
			<dd>
			<?php
			echo $this->Html->link($result["User_1"]["nickname"]."さん",array("controller"=>"users","action"=>"view",$result["User_1"]["id"]),array("class"=>"underline"));
			?>
			</dd>
			<dt>参加表明ユーザー</dt>
			<dd>
			<?php
			echo $this->Html->link($result["User_2"]["nickname"]."さん",array("controller"=>"users","action"=>"view",$result["User_2"]["id"]),array("class"=>"underline"));
			?>
			</dd>
		</dl>
	</td>
</tr>

<tr>
	<th>参加表明ステータス</th>
	<td>
		<p class="h3 mb20"><?php echo $partystatus[$result["Collaboparty"]["party_status"]]; ?></p>

		<p>ステータス変更履歴</p>
		<dl>

			<?php
			foreach($logdata as $l_){
				$log_caption=json_decode($l_["Collabopartylog"]["caption"],true);
			?>
			<dt><?php echo date("Y-m-d H:i",strtotime($l_["Collabopartylog"]["change_date"])); ?></dt>
			<dd>
			<?php
			if($log_caption["type"]=="change_status"){
			?>
				<p>参加表明ステータスを「<?php echo $partystatus[$log_caption["party_status"]["after"]]; ?>」に変更。
			<?php
			}
			else if($log_caption["type"]=="edit"){
				
			}
			?>
			</dd>
			<?php
			}
			?>
			<dt><?php echo date("Y-m-d H:i",strtotime($result["Collaboparty"]["party_date"])); ?></dt>
			<dd>
				受注情報を受付開始しました。
			</dd>
		</dl>
	</td>
</tr>
<tr>
	<th>希望予算</th>
	<td>
		<p>￥ <?php echo $this->Form->input("hope_price",array("class"=>"mini")); ?></p>
	</td>
</tr>
<tr>
	<th>一言メモ</th>
	<td>
		<?php echo $this->Form->textarea("comment",array("class"=>"high")); ?>
	</td>
</tr>
</table>

<div class="center">
	<?php echo $this->Form->submit("変更する",array("div"=>false,"class"=>"buttons")); ?>
</div>
<?php echo $this->Form->end(); ?>

</div>