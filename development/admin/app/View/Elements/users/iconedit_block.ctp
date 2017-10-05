<?php
//アイコン編集用セット

//画像アップロード用form
echo $this->Form->create("senddata",array("id"=>"sendfileform"));
echo $this->Form->file("uploadicon",array("style"=>"display:none","id"=>"uploadicon"));
echo $this->Form->end();
//画像アップロード用form

?>

<div style="display:none" id="index-usernumber"><?php echo $admindata["Admin"]["admin_number"]; ?></div>
<div style="display:none" id="index-uploadimage"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"buffersave","username"=>"notuser",$admindata["Admin"]["admin_number"])); ?></div>
<div style="display:none" id="index-iconedit"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"iconimgedit","username"=>"notuser",$admindata["Admin"]["admin_number"])); ?></div>

<div id="popup">
	<input type="checkbox" class="checks" id="bigp01">
	<label></label>
	<div class="basejavar"></div>
	<div class="window usersettingicon">
		<div class="bs">
			<h1>アイコン設定</h1>
			<p class="center mb5">アイコン画像のファイルを選択して下さい</p>
			<div class="center mb10">
				<a onclick='$("#uploadicon").click()' class="buttons" id="btn_upload">アイコン画像を設定</a>
			</div>
			<ul>
				<li class="lebel2" style="display:none">
					<p class="center">
						アイコン画像のトリミング位置をタップして調節できます。
					</p>
					<div class="squrea">
						<div class="bse" id="buff_trims">
							<?php echo $this->Html->image(Router::url("/",true)."img/notimage.png",array("id"=>"buffer_iconimage","class"=>"","onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png""')); ?>
						</div>
					</div>
					<p class="mt5">拡大倍率</p>
					<p id="buff_icontrimview"></p>
					<div class="gages" id="buffer_iconzoomvalue">
						<div class="value"></div>
					</div><!--//gages-->
					<?php echo $this->Form->create("buffer",array("id"=>"editbufferdata")); ?>
					<?php echo $this->Form->hidden("buffer_icontag",array("id"=>"buffer_icontag")); ?>
					<?php echo $this->Form->hidden("buffer_icontag_original",array("id"=>"buffer_icontag_original")); ?>
					<?php echo $this->Form->hidden("buffer_icontag_trim_left",array("id"=>"buffer_icontag_trim_left","value"=>"0")); ?>
					<?php echo $this->Form->hidden("buffer_icontag_trim_top",array("id"=>"buffer_icontag_trim_top","value"=>"0")); ?>
					<?php echo $this->Form->hidden("buffer_icontag_zoom",array("id"=>"buffer_icontag_zoom","value"=>"100")); ?>
					<?php echo $this->Form->end(); ?>
					<div class="right mb5">
						<a id="delete_icontag" class="buttons">ファイルをリセット</a>
					</div>
				</li>
				<li>
					<div class="center">
						<label for="bigp01" class="buttons">キャンセル</label>
						<a class="buttons lebel2" id="buffer_iconedit_btn" style="display:none">アイコン決定</a>
					</div>
				</li>
			</ul>

		</div>
	</div><!--//.window-->
</div><!--//#popup-->

<script type="text/javascript">
$(function(){
	//AJAX JS - アイコン画像をbufferにセーブする -
	$("#uploadicon").change(function(){
		upload_iconimage();
	});
	function upload_iconimage(){
		var fdata=new FormData($("#sendfileform").get(0));
		$.ajax({
			url:$("#index-uploadimage").text(),
			method: "POST",
			data:new FormData($("#sendfileform").get(0)),
			processData: false,
			contentType: false,
			success: function(data) {
				var result=JSON.parse(data);
				var dst=new Date();

				$(".lebel2").css("display","");
				$("#buffer_iconimage").attr("src",result.url+"?"+dst.getTime());
				$("#buffer_icontag_original").val(result.number);
				$("#buffer_icontag").val(result.number_copy);

				/*
				$("#iconimage").attr("src",result.url+"?"+dst.getTime());
				$("#icontag-buffer").val(result.number);
				*/
			},
		});
	}

	//アイコントリム・拡大用JS
	//アイコンデータを削除
	$("#delete_icontag").on("click",function(){
		$("#icontag").val("");
		$("#iconimage").attr("src","");
	});

	//トリム場所を指定用
	var mouseenable=false;
	var start_y=0;
	var start_x=0;
	
	$("#buffer_iconimage").mousedown(function(event){
		mouseenable=true;
		start_y=event.clientY;
		start_x=event.clientX;
		return false;
	});
	$("#buffer_iconimage").on("touchstart",function(event){
		start_x=event.originalEvent.touches[0].clientX;
		start_y=event.originalEvent.touches[0].clientY;
		return false;
	});
	$("#buffer_iconimage").mouseup(function(){
		mouseenable=false;
		return false;
	});
	$("#buffer_iconimage").mouseleave(function(){
		mouseenable=false;
		return false;
	});
	$("#buffer_iconimage").on("touchmove",function(event){
		var vectol_y=start_x-event.originalEvent.touches[0].clientX;
		var vectol_x=start_y-event.originalEvent.touches[0].clientY;
		start_x=event.originalEvent.touches[0].clientX;
		start_y=event.originalEvent.touches[0].clientY;

		$("#buffer_iconimage").css({
			"top":parseInt($("#buffer_iconimage").css("top"))- vectol_x+"px",
			"left":parseInt($("#buffer_iconimage").css("left"))- vectol_y+"px",
		});
	
		var trim_left=parseInt($("#buff_trims").scrollLeft()/$("#buffer_iconimage").width()*100);
		var trim_top=parseInt($("#buff_trims").scrollTop()/$("#buffer_iconimage").height()*100);
		$("#buffer_icontag_trim_left").val(trim_left);
		$("#buffer_icontag_trim_top").val(trim_top);
	});
	$("#buffer_iconimage").mousemove(function(event){
		if(mouseenable==true)
		{
			var vectol_y=start_y-event.clientY;
			var vectol_x=start_x-event.clientX;
			start_y=event.clientY;
			start_x=event.clientX;
			$("#buffer_iconimage").css({
				"top":parseInt($("#buffer_iconimage").css("top"))- vectol_y+"px",
				"left":parseInt($("#buffer_iconimage").css("left"))- vectol_x+"px",
			});
	
			var trim_left=parseInt((parseInt($("#buffer_iconimage").css("left"))/$("#buff_trims").width())*100)/($("#buffer_icontag_zoom").val()/100);
			var trim_top=parseInt((parseInt($("#buffer_iconimage").css("top"))/$("#buff_trims").height())*100)/($("#buffer_icontag_zoom").val()/100);
			$("#buffer_icontag_trim_left").val(trim_left);
			$("#buffer_icontag_trim_top").val(trim_top);
			
		}
	});

	//拡大率を指定

	var mouseenable_zo=false;
	var start_vx=0;
	$("#buffer_iconzoomvalue").mousedown(function(event){
		mouseenable_zo=true;
		start_vx=event.clientX;
		return false;
	});
	$("#buffer_iconzoomvalue").on("touchstart",function(event){
		start_vx=event.originalEvent.touches[0].clientX;
		return false;
	});
	$("#buffer_iconzoomvalue").mouseup(function(){
		mouseenable_zo=false;
		return false;
	});
	$("#buffer_iconzoomvalue").mouseleave(function(){
		mouseenable_zo=false;
		return false;
	});

	$("#buffer_iconzoomvalue").on("click",function(event){
			var vx=event.clientX-$(this).offset().left;
			var p_left=vx/$("#buffer_iconzoomvalue").width()*100;
			
			$("#buffer_iconzoomvalue .value").css({
				"width":p_left+"%",
			});

			$("#buff_iconzoomvalue_view").text(p_left+"%");
			$("#buffer_iconimage").css("width",p_left+100+"%");

			$("#buffer_icontag_zoom").val(p_left+100);
	});
	$("#buffer_iconzoomvalue").mousemove(function(event){
		if(mouseenable_zo==true)
		{
			var vx=event.clientX-$(this).offset().left;
			var p_left=vx/$("#buffer_iconzoomvalue").width()*100;
			
			$("#buffer_iconzoomvalue .value").css({
				"width":p_left+"%",
			});

			$("#buff_iconzoomvalue_view").text(p_left+"%");
			$("#buffer_iconimage").css("width",p_left+100+"%");

			$("#buffer_icontag_zoom").val(p_left+100);

		}
	});
	$("#buffer_iconzoomvalue").on("touchmove",function(event){
		var vx=event.originalEvent.touches[0].clientX-$(this).offset().left;
		var p_left=vx/$("#buffer_iconzoomvalue").width()*100;

		$("#buffer_iconzoomvalue .value").css({
			"width":p_left+"%",
		});
		$("#buff_iconzoomvalue_view").text(p_left+"%");
		$("#buffer_iconimage").css("width",p_left+100+"%");

		$("#buffer_icontag_zoom").val(p_left+100);
	});


/*
	$("#buffer_iconzoomvalue").on("click",function(event){
		var p_left=parseInt(event.clientX-$(this).offset().left)/$(this).width()*300;
		$("#buff_iconzoomvalue_view").text((parseInt(p_left)+100)+"%");
		$("#buffer_iconzoomvalue .value").css("width",p_left/3+"%");
		$("#buffer_iconimage").css("width",(p_left)+100+"%");

		$("#buffer_icontag_zoom").val(p_left+100);
	});
*/
	//トリミングしたアイコンで決定！
	$("#buffer_iconedit_btn").on("click",function(){
		iconedit();
	});
	function iconedit()
	{

		$.ajax({
			url:$("#index-iconedit").text(),
			method: "POST",
			processData: false,
			contentType: false,
			data:new FormData($("#editbufferdata").get(0)),
			success:function(data){
				var result=JSON.parse(data);
				var dst=new Date();
				$("#bigp01").click();

				$("#iconimage").attr("src",result.url+"?"+dst.getTime());
				$("#icontag").val(result.number);
			},
		});
	}

});
</script>
