<?php
//■コンテンツ追加popup

?>
<div id="popup" class="addcontents_form">
	<?php
	//↓コンテンツをアップするためのバッファーみたいなもの....
	echo $this->Form->hidden("type",array("id"=>"dat_type")); //0:サムネイル用、1:追加コンテンツ
	echo $this->Form->hidden("index",array("id"=>"dat_index")); //追加コンテンツでのインデックス番号
	echo $this->Form->hidden("tag",array("id"=>"dat_tag")); //追加コンテンツ・サムネイルで保存したタグ番号
	echo $this->Form->hidden("imageurl",array("id"=>"dat_image_url")); //画像で保存・表示しているデータの格納先(0:バッファ、1:itemドメイン)
	?>
	<input type="checkbox" id="pol0001" class="checks">
		<label></label>
		<div class="basejavar"></div>
		<div class="window">
			<div class="bs">
				<input type="hidden" id="contentsform_typeindex" value="0">
				<input type="radio" id="sth_001" class="sta_01" name="tms" style="display:none" checked>
				<input type="radio" id="sth_002" class="sta_02" name="tms" style="display:none">
				<input type="radio" id="sth_003" class="sta_03" name="tms" style="display:none">
				<h2 class="mb10" id="contentform_title">サムネイル編集</h2>
				<p class="center">以下の３つの項目から選んでください。</p>
				<ul class="float menutab">
					<li><label for="sth_001" class="buttons">画像</label></li>
					<li><label for="sth_002" class="buttons">動画</label></li>
					<li><label for="sth_003" class="buttons">web</label></li>
				</ul><!--//.menutab-->

				<div class="menu img">
					<h3>画像追加</h3>
					<div class="center">
						<?php
						//画像をフォームでまとめて、ajaxで流すー
						echo $this->Form->create("senddata",array(
							"id"=>"image_upload_form",
							"inputDefaults"=>array(
								"div"=>false,
								"label"=>false,
								"legend"=>false,
								"required"=>false,
							),
						));
						?>
						<div onclick='$("#file").click();' style="cursor:pointer">
						<?php echo $this->Html->image("notcontents_3.png",array("id"=>"image_review","onerror"=>'this.src="'.Router::url("/",true).'img/notimage_notfound.png"')); ?>
						</div>
						<?php echo $this->Form->file("uploadicon",array("id"=>"file")); ?>
						
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
				<div class="menu mov">
					<h3>動画(youtube)の設定</h3>
					<p class="mb10"><?php echo $this->Form->input("youtubeurl",array("id"=>"movie_url")); ?></p>
					<div class="movie">
						<p><iframe src="" style="background:#000" id="movie_preview"></iframe></p>
					</div>
				</div>
				<div class="menu web">
					<h3>web画像の設定</h3>
					<p>下記の入力欄にweb上の画像のアドレスを入力してください。</p>
					<div class="mb10">
						<?php echo $this->Form->input("weburl",array("id"=>"web_url")); ?>
					</div>
					<div class="center">
						<?php echo $this->Html->image("notimage_notfound.png",array("id"=>"web_review","onerror"=>'this.src="'.Router::url("/",true).'img/notimage_notfound.png"')); ?>
					</div>
				</div>
				<div class="mm10">
					<div id="swradio" class="center">
						<?php echo $this->Form->radio("",$statuslist,array("id"=>"openstatus","legend"=>false,"default"=>0)); ?>
					</div>
				</div>
				<div class="mm10" id="commentfield">
					<p>コメント備考欄</p>
					<?php echo $this->Form->textarea("",array("id"=>"commentarea","label"=>false,"style"=>"height:4em;resize:none;")); ?>
				</div>
aaa
				<div class="center">
					<!--<label onclick="" for="pol0001" class="buttons" id="close_btn">キャンセル</label>
					<label onclick="" for="pol0001" class="buttons" id="submit_btn">設定する</label>-->
				</div>
				<div class="center">
					<a class="buttons" id="close_btn" onclick='$("#pol0001").click();'>キャンセル</a>
					<a class="buttons" id="submit_btn">設定する</a>
				</div>
			</div><!--//.base-->
		</div><!--//.window-->
</div><!--//.popup-->
