<?php echo $this->Html->script("pintarest_3"); ?>
<script type="text/javascript">
$(function(){
	//pintarestIII

	pibox3({
		contents:".ap_block",
		item:".item",
		time:500,
		mincolum:2,
		align:"center",
		ajax_enabled:false,
		autotop:false,
	});

});
</script>

<?php
if($this->params["controller"]=="collabo")
{
	$typename="コラボ";
	$types="collabo";
}
else if($this->params["controller"]=="library")
{
	$typename="ライブラリ";
	$types="library";
}
?>
<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $result["Content"]["title"]; ?>の詳細</div>
<h1>「<?php echo $result["Content"]["title"]; ?>」の情報詳細</h1>
<div class="main_content">
	<div class="gnavi">
	</div><!--//.gnavi-->
	<h2>コラボ基本情報</h2>
	<?php
	if(isset($alert))
	{
		?>
		<div class="alert-message"><?php echo $alert; ?></div>
		<?php
	}
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<td colspan="4">
			<div class="center">
				<?php echo $this->Html->link("この".$typename."のページを見る",$wwwurl.$result["User"]["username"]."/".$types."/detail/id:".$result["Content"]["id"],array("target"=>"_blank")); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>登録日</th>
		<td>
			<?php echo date("Y.m.d H:i", strtotime($result["Content"]["record_date"])); ?>
		</td>
		<th>公開ステータス</th>
		<td>
			<?php echo $openstatus[$result["Content"]["open_status"]]; ?>
		</td>
	</tr>
	<tr>
		<th><?php echo $typename; ?>タイトル</th>
		<td colspan="3"><?php echo $result["Content"]["title"]; ?></td>
	</tr>
	<tr>
		<th>登録ユーザー名</th>
		<td colspan="3">
			<?php echo $result["User"]["username"]."[".$result["User"]["nickname"]."]"; ?>
			<div class="center">
				<?php
				echo $this->Form->create("Forcelogin",array(
					"url"=>$wwwurl."user/forcelogin",
					"target"=>"_blank",
				));
				echo $this->Form->hidden("username",array("value"=>$result["User"]["username"]));
				echo $this->Form->hidden("password",array("value"=>$result["User"]["password"]));
				echo $this->Form->hidden("redirecturl",array("value"=>$wwwurl.$result["User"]["username"]."/".$this->params["controller"]."/add/".$result["Content"]["id"]));
				echo $this->Form->submit("このユーザーで編集",array("div"=>false,"class"=>"buttons"));
				echo $this->Form->end();
				?>
				<?php echo $this->Html->link("登録ユーザーを変更",array("controller"=>$this->params["controller"],"action"=>"changeuser",$result["Content"]["id"]),array("class"=>"underline")); ?>
			</div>
		</td>
	</tr>
	<?php
	/*
	2016 2月現在　グループからの登録機能はオミット
	<tr>
		<th>登録グループ名</th>
		<td colspan="3">group_aaa<br>
				リーダー:user_name<br>
				人数：4人
		</td>
	</tr>
	*/?>
	<tr>
		<th>カテゴリー</th>
		<td colspan="3"><?php echo $contents_category[$result["Content"]["contentscategory_id"]]; ?></td>
	</tr>

	<tr>
		<th><?php echo $typename; ?>説明文</th>
		<td colspan="3">
			<?php echo nl2br(htmlspecialchars($result["Content"]["caption_short"])); ?>
		</td>
	</tr>
	<tr>
		<th><?php echo $typename; ?>概要文</th>
		<td colspan="3">
			<?php echo $result["Content"]["caption"]; ?>
		</td>
	</tr>
	</table>

	<h2>サムネイル・追加コンテンツ情報</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>サムネイル情報</th>
		<td colspan="3">
			<div class="thumbnail">
					<?php
					if($result["Additem"][0]["contents_type"]==0)
					{
						echo $this->Html->image($itemurl."data/contents/".$result["Additem"][0]["content"],array("onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png"'));
					}
					else if($result["Additem"][0]["contents_type"]==1)
					{
						?>
						<iframe src="<?php echo $result["Additem"][0]["content"]; ?>"></iframe>
						<?php
					}
					else if($result["Additem"][0]["contents_type"]==2)
					{
						echo $this->Html->image($result["Additem"][0]["content"],array("onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png"'));
					}
					?>
			</div><!--//.thumbnail-->
		</td>
	</tr>
	<tr>
		<th colspan="2"  style="text-align:center">追加コンテンツ</th>
	</tr>
	<tr>
		<td colspan="2">
			<div class="ap_block">
						<?php
						$counts=0;
						foreach($result["Additem"] as $ra_)
						{

							if($counts>0)
							{
								?>
								<div class="item">
									<div class="base">
								<?php
								if($ra_["contents_type"]==0)
								{
									//画像
									 echo $this->html->image($itemurl."data/contents/".$ra_["content"]);
								}
								else if($ra_["contents_type"]==1)
								{
									//動画
									?>
									<iframe src="<?php echo $ra_["content"]; ?>" scrolling="no"></iframe>
									<?php
								}
								else if($ra_["contents_type"]==2)
								{
									//Web画像
									echo $this->html->image($ra_["content"]);
								}
								?>
								<p><?php echo nl2br($ra_["comment"]); ?></p>
								</div>
							</div>
								<?php
							}

							$counts++;
						}
						?>
			</div><!--//.ap_block-->
		</td>
	</tr>
	</table>

	<h2>その他オプション設定</h2>
				<table cellspacing="0" cellpadding="0" class="mb20">
				<tr>
					<th>メタタグ情報</th>
					<td colspan="3">
						<?php echo $result["Content"]["metatag"]; ?>
					</td>
				</tr>
				<tr>
				<?php
				if($result["Content"]["permalink"])
				{
				?>
				<tr>
					<th><?php echo $typename; ?>URL</th>
					<td colspan="3">
					<?php
						echo $result["Content"]["permalink"];
						if($result["Content"]["shorturl_status"])
						{
						echo "<p>ショートURL機能：有効</p>";
						}
					?>
					</td>
				</tr>
				<?php
				}
				?>
				</table>

	<div class="center mb20">
	<?php echo $this->Html->link("データのダウンロード",array("controller"=>"contents","action"=>"ziptest",$result["Content"]["id"]),array("class"=>"buttons")); ?>
	</div>
</div>


