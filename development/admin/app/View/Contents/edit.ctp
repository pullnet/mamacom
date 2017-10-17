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
			<th>タイトル<span class="required_red">[必須]</span></th>
			<td>
				<?php echo $this->Form->input("title",array("error"=>false,"class"=>"","width"=>"50")); ?>
				<?php echo $this->Form->error("title"); ?>
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
			<th>カテゴリー<span class="required_red">[必須]</span></th>
			<td>
				<?php echo $this->Form->select("category_id",$category_list,array("class"=>"long","empty"=>"----","required"=>false)); ?>
				<?php echo $this->Form->error("category_id"); ?>
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
		
		<!-- カテゴリーで表示変更 -->
		<tr>
			<th>メイン<span class="required_red">[必須]</span></th>
			<td>
				<div style="width:300px;margin-top:10px;">
					<?php echo $this->Html->image("noimage.png",array("style"=>"width:100%;display:block;","onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png"',"id"=>"thumbnail_image")); ?>
				</div>
				<p class="mt5 mb5">
					<label for="editimage" class="buttons">画像を設定</label>
				</p>
				<?php echo $this->Form->hidden("img_file1",array("id"=>"image_tag")); ?>
				<?php echo $this->Form->hidden("img_file1_changed",array("id"=>"image_tag_changed")); ?>
			</td>
		</tr>
		<tr>
			<th>サブ 1</th>
			<td>
				<div style="width:150px;margin-top:10px;">
					<?php echo $this->Html->image("noimage.png",array("style"=>"width:100%;display:block;","onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png"',"id"=>"thumbnail_image_sub")); ?>
				</div>
				<p class="mt5 mb5">
					<label for="upfiles_sub" class="buttons">画像を設定</label>
				</p>
				<?php echo $this->Form->hidden("imgsub_file",array("id"=>"imagesub_tag")); ?>
				<?php echo $this->Form->hidden("imgsub_file_source",array("id"=>"imagesub_source")); ?>
				<?php echo $this->Form->hidden("imgsub_file_changed",array("id"=>"imagesub_tag_changed")); ?>	
			</td>
		</tr>		
		<tr>
			<th>サブ 2</th>
			<td>
				<p class="mt5 mb5">
					<label for="upfiles2" class="buttons">画像を設定</label>
				</p>			
			</td>
		</tr>
		<tr>
			<th>サブ 3</th>
			<td>
				<p class="mt5 mb5">
					<label for="upfiles3" class="buttons">画像を設定</label>
				</p>
			</td>
		</tr>
		<tr>
			<th>サブ 4</th>
			<td>
				<p class="mt5 mb5">
					<label for="upfiles4" class="buttons">画像を設定</label>
				</p>
			</td>
		</tr>	
		<tr>
			<th>サブ 4</th>
			<td>
				<p class="mt5 mb5">
					<label for="upfiles5" class="buttons">画像を設定</label>
				</p>
			</td>
		</tr>
		
		<tr>
			<th colspan="2">詳細内容</th>
		</tr>
		
		<!-- カテゴリーで表示変更 -->
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
				<span class="ttl02">補足・その他</span>
			</th>
			<td><?php echo $this->Form->textarea("text2",array("error"=>false,"class"=>"","required"=>false)); ?></td>
		</tr>		
		<tr class="row_display3">
			<th>
				<span class="ttl03">-</span>
			</th>
			<td><?php echo $this->Form->textarea("text3",array("error"=>false,"class"=>"","required"=>false)); ?></td>
		</tr>			
		<tr class="row_display4">
			<th>
				<span class="ttl04">-</span>
			</th>
			<td><?php echo $this->Form->textarea("text4",array("error"=>false,"class"=>"","required"=>false)); ?></td>
		</tr>				
		<tr class="row_display5">
			<th>
				<span class="ttl05">-</span>
			</th>
			<td><?php echo $this->Form->textarea("text5",array("error"=>false,"class"=>"","required"=>false)); ?></td>
		</tr>			
		<!-- カテゴリーで表示変更終わり -->		
			
		<tr>
			<th colspan="2">店舗情報</th>
		</tr>
		<tr>
			<th>郵便番号<span class="required_red">[必須]</span></th>
			<td><?php echo $this->Form->input("postnumber",array("error"=>false,"class"=>"short")); ?><?php echo $this->Form->error("postnumber"); ?></td>
		</tr>
		<tr>
			<th>住所<span class="required_red">[必須]</span></th>
			<td><?php echo $this->Form->input("address",array("error"=>false,"class"=>"")); ?><?php echo $this->Form->error("address"); ?></td>
		</tr>
		<tr>
			<th>電話番号<span class="required_red">[必須]</span></th>
			<td><?php echo $this->Form->input("tel",array("error"=>false,"class"=>"short")); ?><?php echo $this->Form->error("tel"); ?></td>
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

</style>

<script type="text/javascript">

$(function(){
	
		//一旦全部消す関数
		function clear_display(){
			$('.row_display1').css('display','none');		
			$('.row_display2').css('display','none');						
			$('.row_display3').css('display','none');						
			$('.row_display4').css('display','none');						
			$('.row_display5').css('display','none');	
		}	

		function display_set(){
				
				var val = $('#ContentsCategoryId').val();

				if(val == "1"){
					clear_display();
					$('.ttl01').text('お店の概要');
					$('.ttl02').text('補足・その他');
					$('#ContentsTtl1').val('お店の概要');
					$('#ContentsTtl2').val('補足・その他');
					$('.cate01').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');
				}
				else if(val == "2"){
					clear_display();	
					$('.ttl01').text('社名');
					$('.ttl02').text('給与');		
					$('.ttl03').text('雇用形態');
					$('.ttl04').text('最寄駅');						
					$('.ttl05').text('補足・その他');	
					$('#ContentsTtl1').val('社名');
					$('#ContentsTtl2').val('給与');					
					$('#ContentsTtl3').val('雇用形態');
					$('#ContentsTtl4').val('最寄駅');					
					$('#ContentsTtl5').val('補足・その他');																	
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');
					$('.row_display3').css('display','table-row');						
					$('.row_display4').css('display','table-row');						
					$('.row_display5').css('display','table-row');
				}		
				else if(val == "3"){
					clear_display();
					$('.ttl01').text('支援室の概要');
					$('.ttl02').text('補足・その他');	
					$('#ContentsTtl1').val('支援室の概要');
					$('#ContentsTtl2').val('補足・その他');															
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');			
				}		
				else if(val == "4"){
					clear_display();
					$('.ttl01').text('公園の概要');
					$('.ttl02').text('補足・その他');	
					$('#ContentsTtl1').val('公園の概要');
					$('#ContentsTtl2').val('補足・その他');												
					$('.cate04').css('display','block');
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');	
				}
				else if(val == "5"){
					clear_display();
					$('.ttl01').text('授乳室の概要');
					$('.ttl02').text('補足・その他');	
					$('#ContentsTtl1').val('授乳室の概要');
					$('#ContentsTtl2').val('補足・その他');												
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');		
				}
				else if(val == "6"){
					clear_display();
					$('.ttl01').text('サイトの概要');
					$('.ttl02').text('補足・その他');	
					$('#ContentsTtl1').val('サイトの概要');
					$('#ContentsTtl2').val('補足・その他');												
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');			
				}
				else{
					clear_display();								
					$('.ttl01').text('概要');
					$('.ttl02').text('補足・その他');
					$('#ContentsTtl1').val('概要');
					$('#ContentsTtl2').val('補足・その他');					
					$('.row_display1').css('display','table-row');		
					$('.row_display2').css('display','table-row');	
				}
		}

		//読み込み後の処理js
		$(window).load(function () {
			display_set();
		});

		//カテゴリを変更する度の処理js
		$('#ContentsCategoryId').bind('change', function() {
			display_set();
		});


});
</script>






<?php

/*-メイン画像処理-*/
$this->set("set_width",600);
$this->set("set_height",600);
echo $this->Element("image/imageedit");

?>


<?php
/*-サブ画像処理-*/
?>

<div id="url_filebuffer_sub" style="display:none">
<?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"buffersave_sub")); //リンクの配置 ?>
</div>

<?php
echo $this->Form->create("Uploadimage_sub",array(
	"type"=>"file",
	"id"=>"Uploadimage_sub",
));
echo $this->Form->file("upfile_sub",array("id"=>"upfiles_sub","style"=>"display:none"));
echo $this->Form->end();
?>



<script type="text/javascript">
$(function(){
	
	$("#upfiles_sub").on("change",function(){
		filebuffer();
	});	

	function filebuffer(){
		
		$.ajax({
			url:$("#url_filebuffer_sub").text(),
			type:"POST",
			data:new FormData($("#Uploadimage_sub").get(0)),
			processData: false,
			contentType: false,
		        async: false,//同期させる

			success:function(data){
				var result=JSON.parse(data);
				console.log(result);

  			$("#thumbnail_image_sub").attr("src",result.url);
				$('#imagesub_tag').val(result.number);
				$('#imagesub_source').val(result.url);
  			$("#imagesub_tag_changed").val(true);
			},

		});
	}
});
</script>


<?php
debug($test);
?>
