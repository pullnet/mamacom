<?php
echo $this->Html->script("ace.js");
echo $this->Html->script("ace_advance.js");
?>
<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("緊急お役立ち一覧",array("controller"=>"emergency","action"=>"index")); ?>　＞　
緊急お役立ち編集・登録
</div>
<h1>緊急お役立ち編集・登録</h1>
<?php
echo $this->Form->create("Contents",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("id");

?>

<table cellspacing="0" cellpadding="0" class="mb30">
		<tr>
			<th>タイトル（施設名）<span class="required_red">[必須]</span></th>
			<td>
				<?php echo $this->Form->input("title",array("error"=>false,"class"=>"","width"=>"50")); ?>
				<?php echo $this->Form->error("title"); ?>
			</td>
		</tr>
		<tr>
			<th>公開設定</th>
			<td>
				<div id="swradio">
					<?php echo $this->Form->radio("open_status",array(0=>"公開",1=>"非公開"),array("legend"=>false,"default"=>0)); ?>
				</div>
			</td>
		</tr>
		<tr>
			<th>管理番号(任意)</th>
			<td>
				<?php echo $this->Form->input("number",array("error"=>false,"class"=>"short")); ?>
				<?php echo $this->Form->error("number"); ?>
			</td>
		</tr>
		<tr>
			<th>地区<span class="required_red">[必須]</span></th>
			<td>
				<?php echo $this->Form->select("district_id",$district_list,array("class"=>"long","empty"=>"----","required"=>false)); ?>
				<?php echo $this->Form->error("district_id"); ?>
			</td>
		</tr>
		<tr>
			<th colspan="2">イメージ</th>
		</tr>
		
		<tr>
			<th>メイン<span class="required_red">[必須]</span></th>
			<td>
				<div style="width:300px;margin-top:10px;">
					<?php
					if(file_exists("buffer/".date("Ymd")."/".@$this->request->data["Contents"]["img_file"])){
						$img_url=Router::url("/",true)."buffer/".date("Ymd")."/".@$this->request->data["Contents"]["img_file"];
					}
					else{
						$img_url=$domain_item."app/webroot/Content/".@$find_additem0["Additems"]["content"];
					}
					echo $this->Html->image($img_url,array("style"=>"width:100%;display:block;","onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png"',"id"=>"thumbnail_image")); ?>
				</div>
				<p class="mt5 mb5">
					<label for="editimage" class="buttons">画像を設定</label>
				</p>
				<?php echo $this->Form->hidden("img_file",array("id"=>"image_tag")); ?>
				<?php echo $this->Form->hidden("img_file_source",array("id"=>"image_source")); ?>
				<?php echo $this->Form->hidden("img_file_changed",array("id"=>"image_tag_changed")); ?>
			</td>
		</tr>


		<tr>
			<th colspan="2">詳細内容</th>
		</tr>
		
		<?php echo $this->Form->hidden("ttl1",array("value"=>"-","class"=>"")); ?>
		<?php echo $this->Form->hidden("ttl2",array("value"=>"-","class"=>"")); ?>
		<?php echo $this->Form->hidden("ttl3",array("value"=>"-","class"=>"")); ?>
		<?php echo $this->Form->hidden("ttl4",array("value"=>"-","class"=>"")); ?>
		<?php echo $this->Form->hidden("ttl5",array("value"=>"-","class"=>"")); ?>
		
		<tr class="row_display1">
			<th>
				<span class="ttl01">概要</span>
			</th>
			<td><?php echo $this->Form->textarea("text1",array("error"=>false,"class"=>"","required"=>false)); ?></td>			
		</tr>
		<tr class="row_display2">
			<th>
				<span class="ttl02">注意事項</span>
			</th>
			<td><?php echo $this->Form->textarea("text2",array("error"=>false,"class"=>"","required"=>false)); ?></td>
		</tr>		
		<tr>
			<th colspan="2">施設情報</th>
		</tr>
		<tr>
			<th>電話番号<span class="required_red">[必須]</span></th>
			<td><?php echo $this->Form->input("tel",array("error"=>false,"class"=>"short")); ?><?php echo $this->Form->error("tel"); ?><span  class="mini_text" style="margin-top:0;">ハイフン付きで入力して下さい。例:06-0555-0000</span></td>
		</tr>
		<tr>
			<th>電話番号2</th>
			<td><?php echo $this->Form->textarea("tel_text",array("error"=>false,"class"=>"")); ?><?php echo $this->Form->error("tel_text"); ?><span class="mini_text">例:＃8000（NTTプッシュ回線、携帯電話）または06-6765-3650（ダイヤル回線、IP電話）</span></td>
		</tr>
		<tr>
			<th>開設時間</th>
			<td><?php echo $this->Form->input("open_text",array("error"=>false,"class"=>"")); ?></td>
		</tr>
		
</table>

<div class="center mb30">
	<?php echo $this->Form->submit("緊急お役立ちを設定",array("div"=>false,"class"=>"buttons")); ?>
</div>

<?php echo $this->Form->end(); ?>


<style>

.required_red{
	display:inline-block;
	vertical-align:middle;
	color:#C00;
	font-size:80%;
}
textarea {
  line-height: 1.4em;
	height:125px;
}
.mini{
	display:inline-block;
}
.mini_text{
    font-size: 90%;
    line-height: 1.0;
    margin: -5px 5px 10px;
    display: block;
}

</style>

<?php
/*-メイン画像処理-*/
$this->set("set_width",600);
$this->set("set_height",600);
echo $this->Element("image/imageedit");
?>

