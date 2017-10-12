<?php echo $this->Html->script("pintarest_3"); ?>
<?php echo $this->Html->script("content_add"); ?>

<script type="text/javascript">

var params={
	contents:".addcontentslist",
	item:".item",
	time:500,
	mincolum:2,
	align:"auto",
};
$(function(){
	pibox3(params);
});
</script>

<?php /* ▼AJAX URL */ ?>
<div id="index_buffersave" style="display:none"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"buffersave",$admindata["Admin"]["admin_number"])); ?></div>
<div id="index_shorurlavaliable" style="display:none"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"shorturl_avaliable")); ?></div>
<div id="index_itemreadurl" style="display:none"><?php echo Router::url("/",true)."buffer/Admin/".$admindata["Admin"]["admin_number"]; ?></div>
<div id="index_defaultimageurl" style="display:none"><?php echo Router::url("/",true)."img/notcontents_1.png"; ?></div>
<div id="index_defaultimageurl_notfound" style="display:none"><?php echo Router::url("/",true)."img/notimage_notfound.png"; ?></div>
<?php /* ▼AJAX URL */ ?>



<?php
if($this->params["controller"]=="collabo")
{
	$typename="コラボ";
	$types="collabo";
	$status=0;
}
else if($this->params["controller"]=="library")
{
	$typename="ライブラリ";
	$types="library";
	$status=1;
}
?>
<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("登録".$typename."一覧",array("controller"=>$types,"action"=>"index")); ?>　＞　<?php echo $typename; ?>編集
</div>
<h1><?php echo $typename; ?>の編集</h1>
<div class="main_content">
	<?php
	if(isset($post))
	{
	?>
	<div class="gnavi">
		<ul class="float">
			<li class="active"><?php echo $this->Html->link($typename."を編集",array("controller"=>$types,"action"=>"view",$post["Content"]["id"])); ?></li>
			<?php
			if($this->params["controller"]=="collabo")
			{
			?>
			<li><?php echo $this->Html->link("参加表明設定一覧",array("controller"=>"collabo","action"=>"partysetlist",$post["Content"]["id"])); ?></li>
			<?php
			}
			else if($this->params["controller"]=="library")
			{
			?>
			<li><?php echo $this->Html->link("受注設定一覧",array("controller"=>"library","action"=>"ordersetlist",$post["Content"]["id"])); ?></li>
			<?php
			}
			?>
		</ul>
	</div><!--//.gnavi-->
	<?php
	}
	?>
	<h2><?php echo $typename; ?>の基本情報</h2>
	<?php echo $this->Form->create("Content",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("user_id",array("value"=>$result_user["User"]["id"]));
	echo $this->Form->hidden("group_id");
	echo $this->Form->hidden("number");
	echo $this->Form->hidden("status",array("value"=>$status));
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>コラボ/ライブラリ種別</th>
		<td colspan="3">
			<?php echo $typename; ?>
		</td>
	</tr>
	<tr>
		<th>登録日</th>
		<td>
			<?php echo $this->Form->input("record_date",array("class"=>"short","type"=>"text")); ?>
		</td>
		<th>公開ステータス</th>
		<td>
			<?php echo $this->Form->select("open_status",$openstatus,array("class"=>"short","empty"=>false)); ?>
		</td>
	</tr>
	<tr>
		<th><?php echo $typename; ?>タイトル</th>
		<td colspan="3">
			<?php echo $this->Form->input("title",array("error"=>false)); ?>
			<?php echo $this->Form->error("title"); ?>
		</td>
	</tr>
	<tr>
		<th>登録ユーザー名</th>
		<td colspan="3">
		<?php
			echo $result_user["User"]["username"]."[".$result_user["User"]["nickname"]."]";
		?>
		</td>
	</tr>
	<?php
	/*
	2016 2月時点でグループからの登録機能をオミット
		<tr>
			<th>登録グループ名</th>
			<td colspan="3">group_aaa<br>
				リーダー:user_name<br>
				人数：4人
			</td>
		</tr>
	*/
	?>
	<tr>
		<th>カテゴリー</th>
		<td colspan="3">
			<?php echo $this->Form->select("contentscategory_id",$contents_category,array("required"=>false,"empty"=>"--未設定---","error"=>false)); ?>
			<?php echo $this->Form->error("contentscategory_id"); ?>
		</td>
	</tr>
	<tr>
		<th><?php echo $typename; ?>の説明文</th>
		<td colspan="3">
			<?php echo $this->Form->textarea("caption_short",array("required"=>false,"class"=>"high","required"=>false,"error"=>false)); ?>
			<?php echo $this->Form->error("caption_short"); ?>
		</td>
	</tr>
	<tr>
		<th><?php echo $typename; ?>の概要文</th>
		<td colspan="3">
			<?php echo $this->Form->textarea("caption",array("required"=>false,"class"=>"high","required"=>false,"error"=>false)); ?>
			<?php echo $this->Form->error("caption"); ?>
		</td>
	</tr>
	</table>

	<h2>サムネイル・追加コンテンツ情報</h2>
	
	<?php echo $this->element("content/addcache"); ?>
	
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>サムネイル情報</th>
		<td colspan="3">
						<div onclick='$("#pol0001").click();' class="thumbnail" id="open_thumbnail" style="cursor:pointer">
					<?php
					//公開ステータスの選別
					if(isset($post["Additem"][0]["content"]))
					{
						if($post["Additem"][0]["content"])
						{
							if($post["Additem"][0]["open_status"]==0)
							{
								$openclass="all";
							}
							else if($post["Additem"][0]["open_status"]==1)
							{
								$openclass="useronly";
							}
							else if($post["Additem"][0]["open_status"]==2)
							{
								$openclass="memberonly";
							}
							else if($post["Additem"][0]["open_status"]==3)
							{
								$openclass="not";
							}
						}
						else
						{
							$openclass="";
						}
					}
					else
					{
						$openclass="";
					}
					?>
					<span class="thumbnail_openstatusview <?php echo $openclass; ?>"></span>
					<?php
					//postされて帰った来た場合の
					if(isset($post["Additem"][0]["content"]))
					{
						if($post["Additem"][0]["content"])
						{
							if($post["Additem"][0]["contents_type"]==0)
							{
								//画像の場合
								echo $this->Html->image(Router::url("/",true)."buffer/Admin/".$admindata["Admin"]["admin_number"]."/".$post["Additem"][0]["content"],array("id"=>"thumbnail_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"'));
								?>
								<div id="thumbnail_movie" style="display:none">
									<div class="movie">
										<p><iframe src="" id="thumbnail_movie_i"></iframe></p>
									</div>
									<div class="buttons">サムネイルを変更する</div>
								</div><!--//.thumbnail_movie-->
								<?php
							}
							else if($post["Additem"][0]["contents_type"]==1)
							{
								//動画の場合
								echo $this->Html->image("notcontents_1.png",array("id"=>"thumbnail_image","style"=>"display:none","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"')); 
								?>
								<div id="thumbnail_movie">
									<div class="movie">
										<p><iframe src="<?php echo $post["Additem"][0]["content"]; ?>" id="thumbnail_movie_i"></iframe></p>
									</div>
									<div class="buttons">サムネイルを変更する</div>
								</div><!--//.thumbnail_movie-->
								<?php
							}
							else if($post["Additem"][0]["contents_type"]==2)
							{
								//web画像の場合
								echo $this->Html->image($post["Additem"][0]["content"],array("id"=>"thumbnail_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"')); 
								?>
								<div id="thumbnail_movie" style="display:none">
									<div class="movie">
										<p><iframe src="<?php echo $post["Additem"][0]["content"]; ?>" id="thumbnail_movie_i"></iframe></p>
									</div>
									<div class="buttons">サムネイルを変更する</div>
								</div><!--//.thumbnail_movie-->
								<?php
							}
						}
						else
						{
						?>
						<span class="thumbnail_openstatusview"></span>
						<?php echo $this->Html->image("notcontents_1.png",array("id"=>"thumbnail_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"')); ?>
							<div id="thumbnail_movie" style="display:none">
								<div class="movie">
									<p><iframe src="" id="thumbnail_movie_i"></iframe></p>
								</div>
								<div class="buttons">サムネイルを変更する</div>
							</div><!--//.thumbnail_movie-->

						<?php
						}
					}
					else
					//postされていない場合は空を表示
					{
						?>
						<span class="thumbnail_openstatusview"></span>
						<?php
						echo $this->Html->image("notcontents_1.png",array("id"=>"thumbnail_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"')); 
						?>
							<div id="thumbnail_movie" style="display:none">
								<div class="movie">
									<p><iframe src="" id="thumbnail_movie_i"></iframe></p>
								</div>
								<div class="buttons">サムネイルを変更する</div>
							</div><!--//.thumbnail_movie-->
						<?php
					}
					?>
				</div>
				<p class="mt10"><?php echo $this->Form->error("thumbnail"); ?></p>
		</td>
	</tr>
	<tr>
		<th colspan="2"  style="text-align:center">追加コンテンツ</th>
	</tr>
	<tr>
		<td colspan="2">

				<?php //▼コンテンツソース ?>
				<div id="open_addcontents_source" style="display:none">
					<div onclick='$("#pol0001").click();' style="cursor:pointer" class="labels open_addcontents">
						<span class="addcontents_openstatusview"></span>
						<?php echo $this->Html->image("notcontents_1.png",array("class"=>"addcontents_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"')); ?>
						<div class="addcontents_movie" style="display:none">
							<div class="movie">
								<p><iframe src="" class="addcontents_movie_i"></iframe></p>
							</div>
							<div style="padding-bottom:10px;">
								<div class="buttons">コンテンツ情報を変更する</div>
							</div>
						</div><!--//.addcontents_movie-->
						<div class="comment_view"></div>
					</div>
					<a id="delete_contents" class="deletecontents_btn"><span class="over480">このコンテンツを</span>削除</a>
				</div>
				<?php //▲コンテンツソース ?>

				<div class="addcontentslist colum3">
				<?php

				//postされた場合の追加コンテンツを表示
				$pa_count=0;//初期値
			

				if(isset($post["Additem"]))
				{
					foreach($post["Additem"] as $pa_)
					{
						if($pa_["type"]==0)
						{
							$pa_count++;
							
							//post時の公開ステータスをset
							if(isset($pa_["content"]))
							{
							?>
					<div class="item" adc_index="<?php echo $pa_count; ?>">
						<div onclick='$("#pol0001").click();' style="cursor:pointer" class="labels open_addcontents" adc_index="<?php echo $pa_count; ?>">
						<?php
								if($pa_["content"])
								{
									if($pa_["open_status"]==0)
									{
										$openclass="all";
									}
									else if($pa_["open_status"]==1)
									{
										$openclass="useronly";
									}
									else if($pa_["open_status"]==2)
									{
										$openclass="memberonly";
									}
									else if($pa_["open_status"]==3)
									{
										$openclass="not";
									}
								}
								else
								{
									$openclass="";
								}
							}
							else
							{
								$openclass="";
							}
						?>
						<span class="addcontents_openstatusview <?php echo $openclass; ?>"></span>
						<?php

						//post時の画像、動画を表示
						if(isset($pa_["content"]))
						{
							//if($pa_["content"])
							//{
								if($pa_["contents_type"]==0)
								{
								//画像が設定されている状態
								echo $this->Html->image(Router::url("/",true)."buffer/Admin/".$admindata["Admin"]["admin_number"]."/".$pa_["content"],array("class"=>"addcontents_image"));//,"onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"'));
								?>
								<div id="addcontents_movie" style="display:none">
									<div class="movie">
										<p><iframe src="" class="addcontents_movie_i"></iframe></p>
									</div>
									<div style="padding-bottom:10px;">
										<div class="buttons">コンテンツ情報を変更する</div>
									</div>
								</div><!--//.thumbnail_movie-->
								<?php
								}
								else if($pa_["contents_type"]==1)
								{
								//動画の場合
								echo $this->Html->image("notcontents_1.png",array("class"=>"addcontents_image","style"=>"display:none","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"'));
								?>
								<div id="addcontents_movie">
									<div class="movie">
										<p><iframe src="<?php echo $pa_["content"]; ?>" class="addcontents_movie_i"></iframe></p>
									</div>
									<div style="padding-bottom:10px;">
										<div class="buttons">コンテンツ情報を変更する</div>
									</div>
								</div><!--//.thumbnail_movie-->

								<?php
								}
								else if($pa_["contents_type"]==2)
								{
								//web画像の場合
								echo $this->Html->image($pa_["content"],array("class"=>"addcontents_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"'));
								?>
								<div id="addcontents_movie" style="display:none">
									<div class="movie">
										<p><iframe src="" class="addcontents_movie_i"></iframe></p>
									</div>
									<div style="padding-bottom:10px;">
										<div class="buttons">コンテンツ情報を変更する</div>
									</div>
								</div><!--//.thumbnail_movie-->
								<?php
								}
								else
								{
								echo $this->Html->image(Router::url("/",true)."buffer/Admin/".$admindata["Admin"]["admin_number"]."/".$pa_["content"],array("class"=>"addcontents_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"'));
								?>
								<div id="addcontents_movie" style="display:none">
									<div class="movie">
										<p><iframe src="" class="addcontents_movie_i"></iframe></p>
									</div>
									<div style="padding-bottom:10px;">
										<div class="buttons">コンテンツ情報を変更する</div>
									</div>
								</div><!--//.thumbnail_movie-->
								<?php
								}

							//}
							?>

							<?php
							if( $pa_["comment"])
							{
							?>
								<div class="comment_view" style="margin-bottom:45px;padding:0px 10px"><?php echo nl2br(htmlspecialchars($pa_["comment"])); ?></div>
							<?php
							}
							else
							{
							?>
								<div class="comment_view"></div>
							<?php
							}
							?>
							</div>
							<?php
						}
						else
						{
						//postも何も設定されていない状態
						?>
						<?php echo $this->Html->image("notcontents_1.png",array("class"=>"addcontents_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"')); ?>
							<div class="addcontents_movie" style="display:none">
								<div class="movie">
									<p><iframe src="" class="addcontents_movie_i"></iframe></p>
								</div>
								<div class="buttons">コンテンツを変更する</div>

							</div><!--//.addcontents_movie-->
							<div class="comment_view"></div>
						</div>
						<?php
						}

						?>
						
						<a id="delete_contents" class="deletecontents_btn" adc_index="<?php echo $pa_count; ?>"><span class="over480">このコンテンツを</span>削除</a>
					</div><!--//.item-->
					<?php
							}
						}
					}
					else
					{
						?>
						<div class="item" adc_index="1">
							<div onclick='$("#pol0001").click();' style="cursor:pointer" class="labels open_addcontents" adc_index="1">
								<span class="addcontents_openstatusview"></span>
								<?php echo $this->Html->image("notcontents_1.png",array("class"=>"addcontents_image","onerror"=>'this.src="'.Router::url("/",true).'img/notcontents_1.png"')); ?>
								<div class="addcontents_movie" style="display:none">
									<div class="movie">
										<p><iframe src="" class="addcontents_movie_i"></iframe></p>
									</div>
									<div class="buttons">コンテンツを変更する</div>
								</div><!--//.addcontents_movie-->
								<div class="comment_view"></div>
							</div>
							<a id="delete_contents" class="deletecontents_btn" adc_index="1"><span class="over480">このコンテンツを</span>削除</a>
						</div><!--//.item-->
						<?php
					}
					?>
				</div><!--//.addcontentslist-->
				<div class="center">
					<a class="buttons" id="btn_addcontents_add">さらにコンテンツを追加</a>
				</div>
		</td>
	</tr>
	</table>

	<h2>その他オプション</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>コラボURL</th>
		<td colspan="3">
			<?php echo $this->Form->input("permalink",array("class"=>"long")); ?>
			<p><label><?php echo $this->Form->input("shorturl_status",array("type"=>"checkbox")); ?>ショートURLを使用する</label></p>
		</td>
	</tr>
	<tr>
		<th>メタタグ情報</th>
		<td colspan="3">
			<?php echo $this->Form->textarea("metatag",array("class"=>"high")); ?></textarea>
		</td>
	</tr>
	</table>

		<div class="center mb20">
			<?php echo $this->Form->submit("コラボを設定する",array("div"=>false,"class"=>"short")); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>

<!--■コンテンツ追加popup-->
<?php echo $this->element("content/addform"); ?>