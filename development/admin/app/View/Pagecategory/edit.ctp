<?php
echo $this->Html->script("ace.js");
echo $this->Html->script("ace_advance.js");
?>
<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("ページカテゴリー編集",array("controller"=>"pagecategory","action"=>"index")); ?>　＞　
ページカテゴリー一覧
</div>
<h1>ページカテゴリー編集</h1>
<?php
echo $this->Form->create("Freepagecategory",array(
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
	<th>ページカテゴリー名</th>
	<td>
		<?php echo $this->Form->input("name",array("error"=>false)); ?>
		<?php echo $this->Form->error("name"); ?>
	</td>
</tr>
<tr>
	<th>カテゴリーURL</th>
	<td>
		<?php echo $this->Form->input("permalink",array("class"=>"short","error"=>false)); ?>
		<?php echo $this->Form->error("permalink"); ?>
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
	<th>html情報</th>
	<td>
		<?php echo $this->Form->textarea("html",array("id"=>"html_data","style"=>"display:none")); ?>
		<div class="ace_textarea" id="html_textarea"></div>
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
</table>

<div class="center mb30">
	<?php echo $this->Form->submit("フリーページカテゴリーを設定",array("div"=>false,"class"=>"buttons")); ?>
</div>

<?php echo $this->Form->end(); ?>

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
</script>