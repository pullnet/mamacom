<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>＞ユーザー管理</div>
<h1>ユーザー管理</h1>
<?php
$mode=array(
	0=>"仮登録",
	1=>"一般",
	2=>"退会",
);
$status=array(
	0=>"通常",
	1=>"利用停止",
);
?>
<div class="main_content">
	<div class="search">
		<input type="checkbox" id="shdk" style="display:none" <?php if(@$this->request->query){ echo "checked"; } ?>>
		<label for="shdk" class="toggle">検索フォーム</label>
		<div class="window">
				<?php echo $this->Form->create(null,array(
					"type"=>"get",
					"url"=>array("controller"=>"users","action"=>"index",$page),
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
				</table>
				<div class="center">
					<?php echo $this->Form->submit("検索する",array("div"=>false,"class"=>"buttons")); ?>
				</div>
			<?php echo $this->Form->end(); ?>
		</div><!--//.window-->
	</div><!--//.search-->
	<p class="h3">全<?php echo $totalcount; ?>件</p>
	<p class="mb10">(<?php echo $page; ?>P/<?php echo $totalpage; ?>P)</p>

	<div class="right mb20">
		<?php echo $this->Html->link("新規会員登録",array("controller"=>"users","action"=>"edit"),array("class"=>"buttons")); ?>
	</div>

	<?php

	echo $this->Form->create("User",array(
		"url"=>array("controller"=>"users","action"=>"changestatus"),
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	?>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th class="minishort">登録日</th>
		<th class="short">ユーザー名</th>
		<th class="short">メールアドレス</th>
		<th>ニックネーム</th>
		<th class="mini">状況</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=$limit*($page-1);
	foreach($result as $r_){
		$count++;
	?>
	<tr>
		<td class="center"><?php echo $count; ?></td>
		<td>
			<?php echo date("Y.m.d H:i",strtotime(@$r_["User"]["createdate"])); ?>
		</td>
		<td>
			<?php echo @$r_["User"]["username"]; ?>
		</td>
		<td>
			<?php echo @$r_["User"]["mailaddress"]; ?>
		</td>
		<td>
			<?php echo @$r_["User"]["nickname"]; ?>
		</td>
		<td>
		<?php
			echo @$mode[@$r_["User"]["role"]]."<br>[".@$status[@$r_["User"]["status"]]."]";
		?>
		</td>
		<td>
			<?php echo $this->Html->link("詳細",array("controller"=>"users","action"=>"view",$r_["User"]["id"]),array("class"=>"buttons")); ?>
			<label for="delete_<?php echo $count; ?>" class="buttons backbtn">削除</label>
			<div id="popup">
				<input type="checkbox" id="delete_<?php echo $count; ?>" class="checks">
				<label></label>
				<label for="delete_<?php echo $count; ?>" class="basejavar"></label>
				<div class="window short">
					<div class="bs">
						<h2 class="mb20">ユーザー情報の削除</h2>
						<p class="mb20">「<?php echo h($r_["User"]["nickname"]); ?>」さんのユーザー情報を削除します。<br>よろしいですか？</p>
						<div class="center">
							<label for="delete_<?php echo $count; ?>" class="buttons backbtn">キャンセル</label>
							<?php echo $this->Html->link("削除する",array("controller"=>"users","action"=>"delete",$r_["User"]["id"]),array("class"=>"buttons add")); ?>
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
			<li><?php echo $this->Html->link("<",array("controller"=>"users","action"=>"index",($page-1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			for($svc=1;$svc<=$totalpage;$svc++){
			?>
			<li class="<?php if($svc==$page){ echo "active"; } ?>"><?php echo $this->Html->link($svc,array("controller"=>"users","action"=>"index",$svc,"?"=>@$this->request->query)); ?></li>
			<?php
			}
			if($page<=($totalpage-1)){
			?>
			<li><?php echo $this->Html->link(">",array("controller"=>"users","action"=>"index",($page+1),"?"=>@$this->request->query)); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.pager-->
	<?php
	}
	?>

	<div class="right mb20">
		<?php echo $this->Html->link("一覧情報をcsv出力",array("controller"=>"users","action"=>"dataexport"),array("class"=>"buttons")); ?>
	</div>
</div>