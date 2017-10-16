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
		
		
		<!-- カテゴリーで表示変更 -->
		
		<tr class="row_display1">
			<th>
				<span class="cate00">概要</span>
				<span class="cate01">お店の概要</span>
				<span class="cate02">社名</span>
				<span class="cate03">支援室の概要</span>				
				<span class="cate04">公園の概要</span>
				<span class="cate05">授乳室の概要</span>	
				<span class="cate06">サイトの概要</span>
			</th>
			<td><?php echo $this->Form->textarea("text1",array("error"=>false,"class"=>"")); ?></td>
		</tr>
		<tr class="row_display2">
			<th>
				<span class="cate00">補足・その他</span>
				<span class="cate01">補足・その他</span>
				<span class="cate02">給与</span>
				<span class="cate03">補足・その他</span>				
				<span class="cate04">補足・その他</span>
				<span class="cate05">補足・その他</span>	
				<span class="cate06">補足・その他</span>
			</th>
			<td><?php echo $this->Form->textarea("text2",array("error"=>false,"class"=>"")); ?></td>
		</tr>
					
		<tr class="row_display3">
			<th>
				<span class="cate00">-</span>
				<span class="cate01">-</span>			
				<span class="cate02">雇用形態</span>
				<span class="cate03">-</span>				
				<span class="cate04">-</span>
				<span class="cate05">-</span>	
				<span class="cate06">-</span>				
			</th>
			<td><?php echo $this->Form->textarea("text3",array("error"=>false,"class"=>"")); ?></td>
		</tr>		
		
		<tr class="row_display4">
			<th>
				<span class="cate00">-</span>
				<span class="cate01">-</span>			
				<span class="cate02">最寄駅</span>
				<span class="cate03">-</span>				
				<span class="cate04">-</span>
				<span class="cate05">-</span>	
				<span class="cate06">-</span>
			</th>
			<td><?php echo $this->Form->textarea("text4",array("error"=>false,"class"=>"")); ?></td>
		</tr>			
		
		<tr class="row_display5">
			<th>
				<span class="cate00">-</span>
				<span class="cate01">-</span>			
				<span class="cate02">補足・その他</span>
				<span class="cate03">-</span>				
				<span class="cate04">-</span>
				<span class="cate05">-</span>	
				<span class="cate06">-</span>
			</th>
			<td><?php echo $this->Form->textarea("text5",array("error"=>false,"class"=>"")); ?></td>
		</tr>			

		<!-- カテゴリーで表示変更 -->
			
		<tr>
			<th colspan="2">店舗情報</th>
		</tr>
		<tr>
			<th>郵便番号</th>
			<td><?php echo $this->Form->input("postnumber",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>住所</th>
			<td><?php echo $this->Form->input("address",array("error"=>false,"class"=>"")); ?></td>
		</tr>
		<tr>
			<th>電話番号</th>
			<td><?php echo $this->Form->input("tel",array("error"=>false,"class"=>"short")); ?></td>
		</tr>
		<tr>
			<th>補足（受付時間など）</th>
			<td><?php echo $this->Form->input("shop_text",array("error"=>false,"class"=>"")); ?></td>
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

<style>
.cate01,
.cate02,
.cate03,
.cate04,
.cate05,
.cate06{
	display:none;
}
.row_display3,
.row_display4,
.row_display5{
	display:none;
}
textarea {
  line-height: 1.4em;
	height:125px;
}
</style>

<script type="text/javascript">

$(function(){

		//カテゴリーを選択すると下の入力項目が変化するjs
		$('#ContentsCategoryId').bind('change', function() {
				var val = $('#ContentsCategoryId').val();
				
				//一旦全部消す関数
				function clear_display(){
					$('.cate00').css('display','none');		
					$('.cate01').css('display','none');						
					$('.cate02').css('display','none');						
					$('.cate03').css('display','none');						
					$('.cate04').css('display','none');						
					$('.cate05').css('display','none');						
					$('.cate06').css('display','none');	
					$('.row_display1').css('display','none');		
					$('.row_display2').css('display','none');						
					$('.row_display3').css('display','none');						
					$('.row_display4').css('display','none');						
					$('.row_display5').css('display','none');	
				}

				if(val == "1"){
					clear_display();									
					$('.cate01').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');
				}
				else if(val == "2"){
					clear_display();									
					$('.cate02').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');
					$('.row_display3').css('display','table-row');						
					$('.row_display4').css('display','table-row');						
					$('.row_display5').css('display','table-row');
				}		
				else if(val == "3"){
					clear_display();								
					$('.cate03').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');			
				}		
				else if(val == "4"){
					clear_display();								
					$('.cate04').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');	
				}
				else if(val == "5"){
					clear_display();								
					$('.cate05').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');		
				}
				else if(val == "6"){
					clear_display();								
					$('.cate06').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');			
				}
				else{
					clear_display();								
					$('.cate00').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');	
				}
		});


});
</script>
</script>