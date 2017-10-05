<?php
echo $this->Html->script("ace.js");
echo $this->Html->script("ace_advance.js");
?>

<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　LP・固定ページ編集</div>
<h1>LP・固定ページ編集</h1>
<div class="main_content">

<?php echo $this->Form->create("Freepage",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
		),
	));
	echo $this->Form->hidden("id");
	?>

	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>ページタイトル</th>
		<td>
			<?php echo $this->Form->input("name",array("error"=>false)); ?>
			<?php echo $this->Form->error("name"); ?>
		</td>
	</tr>
	<tr>
		<th>ページURL</th>
		<td>
			<?php echo $this->Form->input("permalink",array("class"=>"short","error"=>false)); ?>
			<?php echo $this->Form->error("permalink"); ?>
		</td>
	</tr>
	<tr>
		<th>ページカテゴリー</th>
		<td>
			<?php echo $this->Form->select("freepagecategory_id",$pagecategory_list,array("class"=>"long","empty"=>"----")); ?>
		</td>
	</tr>

	<tr>
		<th>ページタイトル</th>
		<td>
			<?php echo $this->Form->input("title"); ?>
		</td>
	</tr>
	<tr>
		<th>スマホ画面対応</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("smp_status",array(0=>"PCのみ又はレスポンシブ",1=>"スマホ用htmlを設置"),array("legend"=>false,"default"=>0,"class"=>"radio_smp_status")); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>htmlタグ</th>
		<td>
			<?php echo $this->Form->textarea("html",array("id"=>"html_data","style"=>"display:none")); ?>
			<div class="ace_textarea" id="html_textarea"></div>
			<?php echo $this->Form->error("html"); ?>
		</td>
	</tr>
	<tr class="type_smp">
		<th>スマホ判別画面幅</th>
		<td>
			<?php echo $this->Form->input("smp_maxwidth",array("class"=>"mini","default"=>"780")); ?> px
		</td>
	</tr>
	<tr class="type_smp">
		<th>スマホ画面用htmlタグ</th>
		<td>
			<?php echo $this->Form->textarea("smp_html",array("id"=>"smp_html_data","style"=>"display:none")); ?>
			<div class="ace_textarea" id="smp_html_textarea"></div>
		</td>
	</tr>
	<tr>
		<th>ヘッダーフッター表示</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("page_status",array(0=>"表示",1=>"非表示"),array("legend"=>false,"default"=>0)); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>公開設定</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("open_status",array(0=>"公開",1=>"会員のみ",2=>"非公開"),array("legend"=>false,"default"=>0)); ?>
			</div>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Form->submit("固定ページを設定する",array("class"=>"buttons","div"=>false)); ?>
	</div>
</div>

<script type="text/javascript">
aceeditor({
	textarea:"html_textarea",
	textdata:"html_data",
});
aceeditor({
	textarea:"smp_html_textarea",
	textdata:"smp_html_data",
});
$(function(){
	radio_smp_status();
	$(".radio_smp_status").on("change",function(){
		radio_smp_status();
	});

	function radio_smp_status(){
		var index=$(".radio_smp_status:checked").val();
		console.log(index);
		if(index==0){
			$(".type_smp").css("display","none");

		}
		else
		{
			$(".type_smp").css("display","");

		}
	}

});
</script>