<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link("メッセージフィールド一覧",array("controller"=>"talk","action"=>"index")); ?>　＞　<?php echo $this->Html->link("メッセージ詳細",array("controller"=>"talk","action"=>"msgview",$result_m["Message"]["id"])); ?>　＞　
メッセージ添付データ編集</div>
<h1>メッセージ添付データ編集</h1>
<div class="main_content">
	<?php
		echo $this->Form->create("senddata",array("id"=>"sendfileform")); 
		echo $this->Form->file("uploadicon",array("style"=>"display:none","id"=>"uploadicon"));
		echo $this->Form->end();
	?>
	<?php
		echo $this->Form->create("Messagezip",array(
			"inputDefaults"=>array(
				"div"=>false,
				"label"=>false,
				"legend"=>false,
				"required"=>false,
			),
		));
		echo $this->Form->hidden("id");
		echo $this->Form->hidden("message_id",array("value"=>$result_m["Message"]["id"]));
	?>
	<div id="index-uploaddata" style="display:none"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"buffersave_anyfile",$admindata["Admin"]["admin_number"])); ?></div>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>メッセージ番号</th>
		<td>
			<?php echo $result_m["Message"]["talk_number"]; ?>
		</td>
	</tr>
	<tr>
		<th>メッセージ内容</th>
		<td>
			<?php echo $result_m["Message"]["message"]; ?>
		</td>
	</tr>
	</table>

	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th colspan="2">添付データ</th>
	</tr>
	<tr>
		<td colspan="2">
			<div class="center">
				<p><?php echo $this->Html->image("notimage.png",array("id"=>"source_image","class"=>"image","style"=>"max-width:300px","onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png"')); ?></p>
				<p>ファイル名:<span id="view_bufffilename"></span></p>
				<p>ファイル形式:<span id="view_bufffiletype"></span></p>
				<?php echo $this->Form->hidden("data_tag",array("id"=>"bufffiletag")); ?>
				<?php echo $this->Form->hidden("data_name",array("id"=>"bufffilename")); ?>
				<?php echo $this->Form->hidden("type",array("id"=>"bufffiletype")); ?>

			</div>
			
			<div class="center">
				<label for="uploadicon" class="buttons">ファイルを設定</label>
			</div>
				<?php echo $this->Form->error("data_tag"); ?>

			<script type="text/javascript">
			$(function(){
				// JS AJAX - ファイルをbufferにセット
				$("#uploadicon").change(function(){
					upload_data();
				});
				function upload_data(){
					$.ajax({
						url:$("#index-uploaddata").text(),
						method: "POST",
						data:new FormData($("#sendfileform").get(0)),
						processData: false,
						contentType: false,
						success: function(data) {
							var result=JSON.parse(data);
							var dst=new Date();

							if(result.type){
								//画像ファイルの場合は
								$("#bufffiletype").val(1);
								$("#source_image").attr("src",result.url+"?"+dst.getTime());
								$("#view_bufffiletype").text("画像");
							}
							else
							{
								$("#bufffiletype").val(0);
								$("#source_image").attr("src","?"+dst.getTime());
								$("#view_bufffiletype").text("その他data");
							}

							$("#view_bufffilename").text(result.filename);
							$("#bufffilename").val(result.filename);
							$("#bufffiletag").val(result.number);

						},
					});
				}
			});
			</script>
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

	<div class="center mb20">
		<?php echo $this->Form->submit("添付データを設定",array("div"=>false,"class"=>"short")); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div><!--//.main_content-->