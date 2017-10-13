<?php
echo $this->Html->script("ace.js");
echo $this->Html->script("ace_advance.js");
?>
<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("地区編集",array("controller"=>"category","action"=>"index")); ?>　＞　
地区編集
</div>
<h1>地区編集</h1>
<?php
echo $this->Form->create("Category",array(
	"inputDefaults"=>array(
		"div"=>false,
		"label"=>false,
		"legend"=>false,
		"required"=>false,
	),
));
echo $this->Form->hidden("id");
echo $this->Form->hidden("type_mode",array("value"=>"1"));

?>
<table cellspacing="0" cellpadding="0" class="mb30">
<tr>
	<th>地区名</th>
	<td>
		<?php echo $this->Form->input("name",array("error"=>false)); ?>
		<?php echo $this->Form->error("name"); ?>
	</td>
</tr>
<tr>
	<th>html情報</th>
	<td>
		<?php echo $this->Form->textarea("html",array("id"=>"html_data","style"=>"display:none")); ?>
		<div class="ace_textarea" id="html_textarea"></div>
	</td>
</tr>
</table>

<div class="center mb30">
	<?php echo $this->Form->submit("地区を設定",array("div"=>false,"class"=>"buttons")); ?>
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