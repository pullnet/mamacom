<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("コラボ参加表明情報一覧",array("controller"=>"cparty","action"=>"index")); ?>　＞　
コラボ参加表明情報詳細
</div>
<h1>コラボ参加表明情報詳細</h1>
<div class="main_content">
<?php
if(isset($alert)){
?>
	<div class="alert-message"><?php echo $alert; ?></div>
<?php
}
?>
<div class="mb20">
	<?php echo $this->Html->link("コラボ参加表明情報を変更",array("controller"=>"cparty","action"=>"edit",$result["Collaboparty"]["id"]),array("class"=>"buttons")); ?>
</div>
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
	</td>
</tr>
<tr>
	<th>希望予算</th>
	<td>
		<p class="h3">￥<?php echo number_format($result["Collaboparty"]["hope_price"]); ?></p>
	</td>
</tr>
<tr>
	<th>一言メモ</th>
	<td>
		<?php echo h($result["Collaboparty"]["comment"]); ?>
	</td>
</tr>
</table>

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
					参加表明ステータスを「<?php echo $partystatus[$log_caption["party_status"]["after"]]; ?>」に変更。<br>
				<?php
				}
				else if($log_caption["type"]=="edit"){
					?>
					コラボ参加情報を変更しました。<br>
					<変更箇所><br>
					<?php
						$keylist=array(
							"hope_price"=>"希望予算",
							"comment"=>"一言メモ",
						);
						foreach($log_caption["edit"]["after"] as $key=>$l_){
							if(@$log_caption["edit"]["before"][$key]!=@$log_caption["edit"]["after"][$key]){
								echo $keylist[$key].":".$log_caption["edit"]["before"][$key]." => ".$log_caption["edit"]["after"][$key];
							}
						}
				}
				else if($log_caption["type"]=="new"){
				?>
				受注情報を受付開始しました。<br>
				<?php
				}

				if($l_["Collabopartylog"]["changeuser_status"]==0){
					echo '(変更者:コラボ管理オーナー)';
				}
				else if($l_["Collabopartylog"]["changeuser_status"]==1){
					echo '(変更者:コラボ参加ユーザー)';
				}
				else if($l_["Collabopartylog"]["changeuser_status"]==2){
					echo '(変更者:コラボス運営)';
				}

				?>
				</dd>
				<?php

				}


			?>
			</dd>
		</dl>
</div>