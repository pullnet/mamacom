<?php /*--------------------- 画像バッファ用 ---------------------*/ ?>
<div id="url_filebuffer" style="display:none"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"buffersave")); ?></div>
<div style="display:none" id="url_iconedit"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"iconimgedit",$set_width,$set_height)); ?></div>

<style>
#kitao_promo17 #Modal.iconedit .thumbnail .squrea{
	padding-bottom:<?php echo ($set_height/$set_width)*100; ?>%;
}
#kitao_promo17 #Modal.iconedit .thumbnail{
	max-width:300px;
	margin:0px auto;
}
#kitao_promo17 #Modal.iconedit .thumbnail .squrea {
    border: solid 1px #999;
    margin: 10px auto;
    position: relative;
    overflow: hidden;
}
#kitao_promo17 #Modal.iconedit .thumbnail .squrea #buff_trims {
    position: absolute;
    left: 0px;
    top: 0px;
    bottom: 0px;
    right: 0px;
    width: 100%;
    cursor: pointer;
}
#kitao_promo17 #Modal.iconedit .thumbnail .squrea #buff_trims img {
    position: absolute;
    left: 0px;
    top: 0px;
    cursor: pointer;
}
#kitao_promo17 #Modal.iconedit .gages {
    background: #F0F0F0;
    height: 25px;
    position: relative;
    cursor: pointer;
    margin-bottom:20px;
}
#kitao_promo17 #Modal.iconedit .gages .value {
    position: absolute;
    width: 0%;
    height: 25px;
    background: #29C;
}
</style>

<div id="Modal" class="iconedit">
	<input type="checkbox" id="editimage" class="checks">
	<label></label>
	<label for="editimage" class="basejavar"></label>
	<div class="window table short">
		<div class="tr">
			<div class="hf head h3">
				画像の設定
				<label for="editimage" class="f_right h3">×</label>
			</div>
		</div>
		<div class="tr">
			<div class="main">
				<div class="bs">
					<div class="m10">
						<div class="center sec01">
							<p class="h4 mb20">まず画像を選択して下さい</p>
							<label for="upfiles" class="buttons add">画像を設定</label>
						</div>
						<div style="display:none" id="section_2" class="sec02">
							<p class="h4 mb20">
							次に画像のトリミングをします。<br><br>
							マウスでドラッグまたは指でタップして位置を指定します。<br>
							画像を拡大縮小するときは、拡大縮小バーを左右に動かすことで拡大、縮小できます
							</p>
							<div class="thumbnail">
								<div class="squrea">
									<div class="bse" id="buff_trims">
										<?php echo $this->Html->image(null,array("id"=>"buffer_iconimage","onerror"=>'this.src="'.Router::url("/",true).'img/no_image.png"',"class"=>"image")); ?>
									</div>
								</div>
							</div>
							<p class="mt5">拡大縮小</p>
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

							<div class="right">
								<a class="underline btn_clear_image">選択画像をクリア</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="editimage" class="buttons">キャンセル</label></li>
					<li class="f_right"><a class="buttons add" id="buffer_set">画像を決定</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//#Modal-->

<?php
echo $this->Form->create("Uploadimage",array(
	"type"=>"file",
	"id"=>"Uploadimage",
));
echo $this->Form->file("upfile",array("id"=>"upfiles","style"=>"display:none"));
echo $this->Form->end();
?>

<script type="text/javascript">
$(function(){
	$("#upfiles").on("change",function(){
		filebuffer();
	});

	function filebuffer(){
		$.ajax({
			url:$("#url_filebuffer").text(),
			type:"POST",
			data:new FormData($("#Uploadimage").get(0)),
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){
				var result=JSON.parse(data);
				$("#buffer_iconimage").attr("src",result.path+result.data);
				$("#buffer_icontag_original").val(result.data);
				$("#buffer_icontag").val(result.uniqid);
				$(".iconedit .sec01").css({"display":"none"});
				$(".iconedit .sec02").css("display","");

//				$("#imageicontag").val(result.icontag);
//				$("#imagechanged").val(true);
			},
		});

	}


	//この下は某システムからの流用

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

	console.log($("#buffer_iconimage").css("top")+"..."+$("#buffer_iconimage").height());

			var trim_left=parseInt((parseInt($("#buffer_iconimage").css("left"))/$("#buffer_iconimage").width())*100)/($("#buffer_icontag_zoom").val()/100);
			var trim_top=parseInt((parseInt($("#buffer_iconimage").css("top"))/$("#buffer_iconimage").height())*100)/($("#buffer_icontag_zoom").val()/100);
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

	//トリミングしたアイコンで決定！
	$("#buffer_set").on("click",function(){
		iconedit();
	});
	function iconedit()
	{
		$.ajax({
			url:$("#url_iconedit").text(),
			method: "POST",
			processData: false,
			contentType: false,
			data:new FormData($("#editbufferdata").get(0)),
			success:function(data){
				var result=JSON.parse(data);
				var dst=new Date();
				$("#editimage").click();

				$("#thumbnail_image").attr("src",result.url+"?"+dst.getTime());
				$("#image_tag").val(result.number);
				$("#image_tag_changed").val(true);
			},
		});
	}

	$(".btn_clear_image").on("click",function(){

		$(".iconedit .sec01").css({"display":""});
		$(".iconedit .sec02").css("display","none");
		$("#thumbnail_image").attr("src","");
		$("#image_tag").val("");
		$("#buffer_icontag_trim_left").val(0);
		$("#buffer_icontag_trim_top").val(0);
		$("#buffer_iconimage").css({
			"top":"0px",
			"left":"0px",
		});
		$("#buffer_icontag_zoom").val(100);
		$("#buff_iconzoomvalue_view").text("100%");
		$("#buffer_iconimage").css("width","100%");
		$("#buffer_iconzoomvalue .value").css({
			"width":"0%",
		});
		$("#image_tag_changed").val(false);
		$("#upfiles").val("");
	});
});
</script>