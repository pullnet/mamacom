<?php /*--------------------- 画像バッファ用 ---------------------*/ ?>
<div id="url_filebuffer" style="display:none"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"buffersave")); ?></div>
<div style="display:none" id="url_iconedit"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"iconimgedit",$set_width,$set_height)); ?></div>

<style>
#Modal{
	display:block;
}
#Modal .window{
	position:fixed;
	z-index:-2;
	background:#FFF;
	width:80%;
	max-height:80%;
	left:10%;
	top:10%;
	opacity:0;
	overflow:hidden;
	-webkit-opacity:0;
	-moz-opacity:0;
	-ms-opacity:0;
	-o-opacity:0;
}
#Modal .basejavar{
	position:fixed;
	z-index:-1;
	opacity:0;
	background:#000;
	width:100%;
	left:0px;
	top:0px;
	height:100%;
	overflow-y:auto;
}
#Modal input.checks{
	display:none;
}
#Modal input.checks:checked+label~.basejavar,
#Modal input.checks:checked+label~.window{
	z-index:100;
}
#Modal input.checks:checked+label~.window{
	overflow:auto;
	-webkit-overflow-scrolling:touch;
	animation:Modal_open 0.3s;
	opacity:1;
	-webkit-opacity:1;
	-moz-opacity:1;
	-ms-opacity:1;
	-o-opacity:1;
}
#Modal input.checks:checked+label~.basejavar{
	animation:Modal_open_bsj 0.3s;
	opacity:0.8;
	-webkit-opacity:0.8;
	-moz-opacity:0.8;
	-ms-opacity:0.8;
	-o-opacity:0.8;
}
#Modal .window.table{
	height:80%;
}
#Modal .window .tr{
	display:table-row;
}
#Modal .window .tr .hf{
	display:table-cell;
	height:50px;
	padding:15px;
}
#Modal .window .tr .hf.head{
	background:#444;
	color:#FFF;
	position:relative;
}
#Modal .window .tr .main{
	display:table-cell;
	padding:10px 15px;
	position:relative;
}
#Modal .window .tr .main .bs{
	position:absolute;
	width:100%;
	left:0px;
	top:0px;
	height:100%;
	overflow:auto;
}
#Modal .window.short{
	width:640px;
	left:50%;
	margin-left:-320px;
}
#Modal .window.dialog{
	width:400px;
	height:300px;
	left:50%;
	margin-left:-200px;
	top:50%;
	margin-top:-150px;
}

#Modal.iconedit .thumbnail .squrea{
	padding-bottom:<?php echo ($set_height/$set_width)*100; ?>%;
}
#Modal.iconedit .thumbnail{
	max-width:300px;
	margin:0px auto;
}
#Modal.iconedit .thumbnail .squrea {
    border: solid 1px #999;
    margin: 10px auto;
    position: relative;
    overflow: hidden;
}
#Modal.iconedit .thumbnail .squrea #buff_trims {
    position: absolute;
    left: 0px;
    top: 0px;
    bottom: 0px;
    right: 0px;
    width: 100%;
    cursor: pointer;
}
#Modal.iconedit .thumbnail .squrea #buff_trims img {
    position: absolute;
    left: 0px;
    top: 0px;
    cursor: pointer;
}
#Modal.iconedit .gages {
    background: #F0F0F0;
    height: 25px;
    position: relative;
    cursor: pointer;
    margin-bottom:20px;
}
#Modal.iconedit .gages .value {
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
										<?php echo $this->Html->image(null,array("id"=>"buffer_iconimage","onerror"=>'this.src="'.Router::url("/",true).'img/notimage.png"',"class"=>"image")); ?>
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
				$("#buffer_iconimage").attr("src",result.url+"?"+result.number);
				$("#buffer_icontag_original").val(result.url);
				$("#buffer_icontag").val(result.number);
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