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
		<?php echo $this->Form->input("title",array("error"=>false)); ?>
		<?php echo $this->Form->error("name"); ?>
	</td>
</tr>
<tr>
	<th>管理番号(任意)</th>
	<td>
		<?php echo $this->Form->input("number",array("error"=>false)); ?>
		<?php echo $this->Form->error("number"); ?>
	</td>
</tr>
<tr>
	<th>カテゴリー</th>
	<td>
		<?php echo $this->Form->input("category_id",array("error"=>false)); ?>
		<?php echo $this->Form->error("category_id"); ?>
	</td>
</tr>
<tr>
	<th>地区</th>
	<td>
		<?php echo $this->Form->input("district_id",array("error"=>false)); ?>
		<?php echo $this->Form->error("district_id"); ?>
	</td>
</tr>
<tr>
	<th colspan="2">イメージ</th>
</tr>
<tr>
	<th>メイン</th>
	<td></td>
</tr>
<tr>
	<th>サブ1</th>
	<td></td>
</tr>
<tr>
	<th>サブ2</th>
	<td></td>
</tr>
<tr>
	<th colspan="2">詳細内容</th>
</tr>
<tr>
	<th>セクションタイトル1</th>
	<td></td>
</tr>
<tr>
	<th>詳細テキスト1</th>
	<td></td>
</tr>
<tr>
	<th>セクションタイトル2</th>
	<td></td>
</tr>
<tr>
	<th>詳細テキスト2</th>
	<td></td>
</tr>
<tr>
	<th>セクションタイトル3</th>
	<td></td>
</tr>
<tr>
	<th>詳細テキスト3</th>
	<td></td>
</tr>
<tr>
	<th>セクションタイトル4</th>
	<td></td>
</tr>
<tr>
	<th>詳細テキスト4</th>
	<td></td>
</tr>





<tr>
	<th></th>
	<td>
		セクション1・タイトル
		セクション1・詳細テキスト
		セクション2・タイトル
		セクション2・詳細テキスト	
		セクション3・タイトル
		セクション3・詳細テキスト	
		セクション4・タイトル
		セクション4・詳細テキスト	
		セクション5・タイトル
		セクション5・詳細テキスト			
	</td>
</tr>
<tr>
	<th>店舗情報</th>
	<td>
		住所：大阪市中央区南船場3-10-26-吉川ビル6F
		郵便番号：〒542-0081
		電話番号：06-6243-7757
		電話番号補足：【受付時間】10:00 ～ 19:00
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