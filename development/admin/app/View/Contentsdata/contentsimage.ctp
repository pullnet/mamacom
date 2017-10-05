<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　登録画像・データ一覧</div>
<h1>登録画像・データ一覧</h1>
<div class="mb10">
	<?php echo $this->Html->link("使用していないコンテンツ情報をまとめる",array("controller"=>"contentsdata","action"=>"contentsimage_unview"),array("class"=>"underline")); ?>
	<br>
	<?php echo $this->Html->link("使用していないショートサムネイル情報をまとめる",array("controller"=>"contentsdata","action"=>"contentsshortimg_unview"),array("class"=>"underline")); ?>
</div>
<div class="main_content">
	<div class="search">
		<input type="checkbox" id="shdk" style="display:none">
		<label for="shdk" class="toggle">検索フォーム</label>
		<div class="window">
			<form method="post">
						<table cellspacing="0" cellpadding="0" class="mb20">
						<tr>
							<th>キーワード検索</th>
							<td>
								<input type="text" name="keyword">
							</td>
						</tr>
						<tr>
							<th>ステータス</th>
							<td>
								<label style="margin-right:10px">
								<input type="checkbox" name="status[0]" checked>本会員
								</label>
								<label style="margin-right:10px">
								<input type="checkbox" name="status[0]" checked>仮会員
								</label>
								<label style="margin-right:10px">
								<input type="checkbox" name="status[0]" checked>会員停止
								</label>
								<label style="margin-right:10px">
								<input type="checkbox" name="status[0]" checked>退会済
								</label>
							</td>
						</tr>
						<tr>
							<th>登録日</th>
							<td>
								<input type="text" name="start_date" class="short"> ～ <input type="text" name="end_date" class="short">
							</td>
						</tr>
						<tr>
							<th>検索件数</th>
							<td>
								<input type="text" name="limitcount" class="mini"> 件
							</td>
						</tr>
						<tr>
							<td colspan="2" class="center">
								<input type="submit" value="検索する" class="mini">
							</td>
						</tr>
						</table>
					</form>
					</div><!--//.window-->
	</div><!--//.search-->
	<h2>コンテンツデータ一覧</h2>
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">✓</th>
		<th class="minishort">登録日</th>
		<th class="mini">形式</th>
		<th>タグ番号</th>
		<th class="mini">イメージ</th>
		<th></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td>
			<?php echo date("Y-m-d H:i:s",strtotime($r_["Additem"]["createdate"])); ?>
		</td>
		<td>
			<?php echo $content_type[$r_["Additem"]["contents_type"]]; ?>
		</td>
		<td>
			<?php 
			if($r_["Additem"]["contents_type"]==0)
			{
				echo $r_["Additem"]["content"];
			}
			echo "<br>".$r_["Additem"]["shortimgtag"]; ?>
		</td>
		<td>

			<div style="position:relative;width:100%;overflow:hidden;padding-bottom:80%;">
				<?php echo $this->Html->image($itemurl."smpimg/contents/".$r_["Additem"]["shortimgtag"],array("style"=>"position:absolute")); ?>
			</div>
		</td>	
		<td>
			<a href="area_view.html" class="buttons">詳細</a>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"contentsdata","action"=>"contentsimage",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"contentsdata","action"=>"contentsimage",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"contentsdata","action"=>"contentsimage",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>

</div>
