<?php
if(!@$ief_width){
	$ief_width=300;
}
if(!@$ief_height){
	$ief_height=300;
}
if($ief_width && $ief_height){
	$w_rate=($ief_height/$ief_width)*100;
}
if(!@$output_width){
	$output_width=300;
}
if(!@$output_height){
	$output_height=300;
}
$w_rate=($output_width/$output_height)*100;
?>
<style>
#XXXXXXXXX #Modalslide.image_editor .window .image_area{
	width:90%;
	padding:25px;
	margin:0px auto;
	position:relative;
	margin-bottom:30px;
}
#XXXXXXXXX #Modalslide.image_editor .window .image_area .control a{
	position:absolute;
	background:#e0e0e0;
	border:solid 1px #aaa;
}
#XXXXXXXXX #Modalslide.image_editor .window .image_area .control a:hover{
	opacity:1;
	-webkit-opacity:1;
	-moz-opacity:1;
	-ms-opacity:1;
	-o-opacity:1;
}
#XXXXXXXXX #Modalslide.image_editor .window .image_area .control a.snap_left{
	left:0px;
	top:30%;
	height:40%;
	width:20px;
}
#XXXXXXXXX #Modalslide.image_editor .window .image_area .control a.snap_top{
	left:30%;
	top:0px;
	height:20px;
	width:40%;
}
#XXXXXXXXX #Modalslide.image_editor .window .image_area .control a.snap_right{
	right:0px;
	top:30%;
	width:20px;
	height:40%;
}
#XXXXXXXXX #Modalslide.image_editor .window .image_area .control a.snap_bottom{
	right:30%;
	bottom:0px;
	width:40%;
	height:20px;
}
#XXXXXXXXX #Modalslide.image_editor .window .image_area .control a.rotation{
	right:-20px;
	text-align:center;
	bottom:-30px;
	width:60px;
	height:25px;
	color:#333;
	line-height:25px;
}
#XXXXXXXXX #Modalslide.image_editor .window .trim{
	padding-bottom:<?php echo $w_rate; ?>%;
	position:relative;
	overflow:hidden;
	border:solid 1px #ccc;
	<?php
	if(@$mode_circle){
		echo 'border-radius:50%;';
	}
	?>
}
#XXXXXXXXX #Modalslide.image_editor .window .trim .image_source{
	position:absolute;
	left:0px;
	top:0px;
	width:100%;
}
#XXXXXXXXX #Modalslide.image_editor .window .progressbar{
	background:#999;
	height:20px;
	position:relative;
	overflow:hidden;
}
#XXXXXXXXX #Modalslide.image_editor .window .progressbar .value{
	position:absolute;
	width:0%;
	left:0px;
	top:0px;
	height:20px;
	background:#36c;
}
#XXXXXXXXX #Modalslide.image_editor .window #html_image_defaultlist{
	margin-right:-5px;
}
#XXXXXXXXX #Modalslide.image_editor .window #html_image_defaultlist div{
	float:left;
	width:33.3%;
}
#XXXXXXXXX #Modalslide.image_editor .window #html_image_defaultlist div p{
	margin-right:5px;
	margin-bottom:5px;
}
#XXXXXXXXX #Modalslide.image_editor .window #html_image_defaultlist div img{
	width:100%;
	<?php
	if(@$mode_circle){
		echo 'border-radius:50%;';
	}
	?>
	display:block;
}
</style>
<div class="hidden">
	<form enctype="multipart/form-data" id="image_editor_buffer">
		<input type="hidden" name="access_token" value="" hidden-access_token>
		<input type="file" name="file" id="edit_setfile" accept="image/*">
	</form>
</div>
<div id="Modalslide" class="image_editor">
	<input type="checkbox" id="edit_image" class="checks">
	<table class="window">
	<tr>
		<td class="hf head">
			<div class="float h4">
				<?php
				if(@$editor_title){
					echo h($editor_title);
				}
				else
				{
					echo "画像の設定";
				}
				?>
				<label for="edit_image" class="f_right h4">×</label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="main">
			<div class="bs">
				<div class="m10">
					<div class="step1">
						<p class="mb10">下記より画像ファイルを選択して下さい</p>
						<label onclick='$("#edit_setfile").click();' class="buttons new">ギャラリーからファイルを選択</label>
						<?php
						if(@$default_image){
						?>
						<h3 class="mm10">プリセットから画像を選択できます</h3>
						<div id="html_image_defaultlist" class="float"></div>
						<?php
						}
						?>
					</div>
					<div class="waiting" style="display:none">
						<div class="icon">
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<span>Loading..</span>
						</div>
					</div>
					<div class="step2" style="display:none">
						<p>タップしてトリミング位置を調整してください</p>
						<div class="image_area">
							<div class="trim">
								<img class="image_source">
							</div>
							<ul class="control">
								<li><a class="snap_left"></a></li>
								<li><a class="snap_top"></a></li>
								<li><a class="snap_right"></a></li>
								<li><a class="snap_bottom"></a></li>
								<?php /* <li><a class="rotation">○回転</a></li> */ ?>
							</ul>
						</div>
						<p>下記のバーで拡大縮小することができます。</p>
						<div class="progressbar zoom mb10">
							<div class="value"></div>
						</div>

						<a class="underline image_clear">クリアにする</a>
				
						<form enctype="multipart/form-data" id="image_editor_form">
							<input type="hidden" name="access_token" value="" hidden-access_token>
							<input type="hidden" name="buffer" id="hidden_buffer">
							<input type="hidden" name="output_width" value="<?php echo $output_width; ?>">
							<input type="hidden" name="output_height" value="<?php echo $output_height; ?>">
							<input type="hidden" name="trim_width" id="hidden_trim_width">
							<input type="hidden" name="trim_height" id="hidden_trim_height">
							<input type="hidden" name="offset_left" id="hidden_offset_left">
							<input type="hidden" name="offset_top" id="hidden_offset_top">
							<input type="hidden" name="zoom" id="hidden_zoom">
						</form>
					</div>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="hf">
			<ul class="float">
				<li><label for="edit_image" class="buttons">キャンセル</label></li>
				<li class="f_right"><a class="buttons btn_submit" style="display:none">決定する</a></li>
			</ul>
		</td>
	</tr>
	</table>
</div><!--//#Modalslide-->

<div class="hidden">
	<div id="default_image"><?php echo @$default_image; ?></div>
	<div id="url_domain_item"></div>
	<div id="url_image_defaultsave">ups/get_imagelist_save</div>
</div>
<script type="text/javascript">
$(function(){

	$("*[hidden-access_token]").val(JSession.read("token_"+API.authcode));

	var url={
		image_edit:"ups/fileup/true",
		image_editbuffer:"ups/fileup_buffer",
		image_defaultlist:"ups/get_imagelist",
		image_defaultsave:"ups/get_imagelist_save"
	};

	$(window).on("resize",function(){
		$("#hidden_trim_width").val($(".image_editor .image_area").width());
		$("#hidden_trim_height").val($(".image_editor .image_area").height());
	});

	if($("#default_image").text()){
		$.ajax({
			url:url.image_defaultlist+"/"+$("#default_image").text(),
			success:function(data){
				var result=JSON.parse(data);
				
				var html="";
				for(var v1=0;v1<result.length;v1++){
					var path=$("#url_domain_item").text()+"wdata/"+result[v1].path;
					var html_buff='<div><p><a class="select_image" data-path="'+path+'" data-filename="'+result[v1].name+'"><img src="'+path+'"></a></p></div>';
					html+=html_buff;
				}
				$("#html_image_defaultlist").html(html);
			}
		});
	}

	$("body").on("click",".select_image",function(){
		var path=$(this).attr("data-path");
		var name=$(this).attr("data-filename");

		$.ajax({
			url:$("#url_image_defaultsave").text()+"/"+name,
			success:function(data){
				var result=JSON.parse(data);

				$(".image_output_view").attr("src",result.path+"?"+result.uniqId);
				$(".image_output_input").val(result.tag);
				$(".image_output_path").val(result.path);
				$(".image_output_changed").val(1);

				$("#edit_image").prop("checked",false);
			}
		});


	});

	$("#edit_setfile").on("change",function(){

		$.ajax({
			url:API.domain+url.image_editbuffer,
			type:"post",
			processData:false,
			contentType:false,
			async:true,
			data:new FormData($("#image_editor_buffer").get(0)),
			beforeSend:function(){
				$(".image_editor .step1").css("display","none");
				$(".image_editor .step2").css("display","none");
				$(".image_editor .waiting").css("display","");
			},
			success:function(data){
				var result=JSON.parse(data);

				$(".image_editor .image_source").attr("src",result.path+"?"+result.uniqId);
				$("#hidden_buffer").val(result.path);

				$(".image_editor .step1").css("display","none");
				$(".image_editor .waiting").css("display","none");
				$(".image_editor .step2").css("display","");

				$(".image_editor .trim .image_source").css({
					"top":"0px",
					"left":"0px",
				});

				$("#hidden_trim_width").val($(".image_editor .image_area").width());
				$("#hidden_trim_height").val($(".image_editor .image_area").height());
				$("#hidden_offset_left").val(0);
				$("#hidden_offset_top").val(0);
				$("#hidden_zoom").val(1);

				$(".image_editor .zoom .value").css({
					"width":"0%",
				});

				$(".image_editor .image_source").css("width","100%");
				$("#hidden_zoom").val(1);

				$(".btn_submit").css("display","");
			}
		});
	});

	var touch_enabled=false;
	var start_y=0;
	var start_x=0;
	var zoom=0;
	
	$(".image_editor .trim").on("touchstart",function(event){
		start_x=event.originalEvent.touches[0].clientX;
		start_y=event.originalEvent.touches[0].clientY;
		return false;
	});
	$(".image_editor .trim").on("touchmove",function(event){
		var vectol_y=start_y-event.originalEvent.touches[0].clientY;
		var vectol_x=start_x-event.originalEvent.touches[0].clientX;
		start_y=event.originalEvent.touches[0].clientY;
		start_x=event.originalEvent.touches[0].clientX;
		$(".image_editor .trim .image_source").css({
			"top":parseInt($(".image_editor .trim .image_source").css("top"))- vectol_y+"px",
			"left":parseInt($(".image_editor .trim .image_source").css("left"))- vectol_x+"px",
		});

	//	$(".view_offset_left").text(parseInt($(".image_editor .trim .image_source").css("left"))- vectol_x+"px");
	//	$(".view_offset_top").text(parseInt($(".image_editor .trim .image_source").css("top"))- vectol_y+"px");

	//	$(".view_width").text($(".image_editor .image_area").width());
	//	$(".view_height").text($(".image_editor .image_area").height());
		
		$("#hidden_offset_left").val(parseInt($(".image_editor .trim .image_source").css("left"))- vectol_x);
		$("#hidden_offset_top").val(parseInt($(".image_editor .trim .image_source").css("top"))- vectol_y);
	});

	$(".image_editor .zoom").on("touchstart",function(event){
		zoom=event.originalEvent.touches[0].clientX;
		return false;
	});
	$(".image_editor .zoom").on("touchmove",function(event){
		var vx=event.originalEvent.touches[0].clientX-$(this).offset().left;
		var p_left=parseInt(vx/$(".image_editor .zoom").width()*100);

		$(".image_editor .zoom .value").css({
			"width":p_left+"%",
		});
		$(".image_editor .image_source").css("width",(p_left*4)+100+"%");

	//	$(".view_zoom").text((p_left*4)/100+1);

		$("#hidden_zoom").val((p_left*4)/100+1);
	});

	$(".image_clear").on("click",function(){
		$(".getfiles").val("");
		$(".image_editor .step1").css("display","");
		$(".image_editor .step2").css("display","none");

		$(".btn_submit").css("display","none");

	});

	//submit...
	$(".btn_submit").on("click",function(){
		$.ajax({
			url:API.domain+url.image_edit,
			type:"post",
			processData:false,
			contentType:false,
			async:false,
			data:new FormData($("#image_editor_form").get(0)),
			success:function(data){
				var result=JSON.parse(data);

				$(".image_output_view").attr("src",result.path);
				$(".image_output_input").val(result.tag);
				$(".image_output_path").val(result.path);
				$(".image_output_changed").val(1);
				
				$("#edit_image").prop("checked",false);
				
			}
		});
	});

	//offset left

	$(".image_editor .snap_left").on("click",function(){

		$(".image_editor .trim .image_source").css({
			"left":"0px",
		});

		$("#hidden_offset_left").val(0);
	
	});

	//offset top
	$(".image_editor .snap_top").on("click",function(){

		$(".image_editor .trim .image_source").css({
			"top":"0px",
		});

		$("#hidden_offset_top").val(0);
	
	});
	//offset right
	$(".image_editor .snap_right").on("click",function(){

		$(".image_editor .trim .image_source").css({
			"left":-($(".image_editor .trim .image_source").width()-$(".image_editor .trim").width())+"px",
		});

		$("#hidden_offset_left").val(parseInt($(".image_editor .trim .image_source").css("left")));
	});
	//offset bottom
	$(".image_editor .snap_bottom").on("click",function(){
	
		$(".image_editor .trim .image_source").css({
			"top":-($(".image_editor .trim .image_source").height()-parseInt($(".image_editor .trim").css("height")))+"px",
		});

		$("#hidden_offset_top").val(parseInt($(".image_editor .trim .image_source").css("top")));

	});
});
</script>
</body>
</html>