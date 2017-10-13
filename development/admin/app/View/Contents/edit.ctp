<?php
echo $this->Html->script("ace.js");
echo $this->Html->script("ace_advance.js");
?>
<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("コンテンツ一覧",array("controller"=>"contents","action"=>"index")); ?>　＞　
コンテンツ編集・登録
</div>
<h1>コンテンツ編集・登録</h1>
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
			<th>タイトル</th>
			<td>
				<?php echo $this->Form->input("title",array("error"=>false,"class"=>"","width"=>"50")); ?>
				<?php echo $this->Form->error("name"); ?>
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
			<th>カテゴリー</th>
			<td>
				<?php echo $this->Form->select("category_id",$category_list,array("class"=>"long","empty"=>"----")); ?>
			</td>
		</tr>
		<tr>
			<th>地区</th>
			<td>
				<?php echo $this->Form->select("district_id",$district_list,array("class"=>"long","empty"=>"----")); ?>
			</td>
		</tr>
		<tr>
			<th colspan="2">イメージ</th>
		</tr>
		<tr>
			<th>メイン</th>
			<td><?php echo $this->Form->input("img_file1",array('type'=>'file',"error"=>false,"class"=>"")); ?></td>
		</tr>
		<tr>
			<th>サブ 1</th>
			<td><?php echo $this->Form->input("img_file2",array('type'=>'file',"error"=>false,"class"=>"")); ?></td>
		</tr>
		<tr>
			<th>サブ 2</th>
			<td><?php echo $this->Form->input("img_file3",array('type'=>'file',"error"=>false,"class"=>"")); ?></td>
		</tr>
		<tr>
			<th colspan="2">詳細内容</th>
		</tr>
		<tr>
			<th>項目1</th>
			<td><?php echo $this->Form->input("ttl1",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>詳細文1</th>
			<td><?php echo $this->Form->input("text1",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>項目2</th>
			<td><?php echo $this->Form->input("ttl2",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>詳細文2</th>
			<td><?php echo $this->Form->input("text2",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th colspan="2">店舗情報</th>
		</tr>
		<tr>
			<th>郵便番号</th>
			<td><?php echo $this->Form->input("postnumber",array("error"=>false,"class"=>"short")); ?></td>
		</tr>		
		<tr>
			<th>住所</th>
			<td><?php echo $this->Form->input("address",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>電話番号</th>
			<td><?php echo $this->Form->input("tel",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>補足（受付時間など）</th>
			<td><?php echo $this->Form->input("shop_text",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>公開設定</th>
			<td>
				<div id="swradio">
					<?php echo $this->Form->radio("open_status",array(0=>"公開",1=>"非公開"),array("legend"=>false,"default"=>0)); ?>
				</div>
			</td>
		</tr>
</table>

<div class="center mb30">
	<?php echo $this->Form->submit("コンテンツを設定",array("div"=>false,"class"=>"buttons")); ?>
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