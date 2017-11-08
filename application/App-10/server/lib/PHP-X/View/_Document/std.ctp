<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_document"); ?>

	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">screen transition diagram</h1>
			<?php echo $this->Html->active(@$alert,array("class"=>"error-message")); ?>

			<?php echo $this->Form->create("Diagram"); ?>
			<div class="snap_guide_left"></div>
			<div class="snap_guide_top"></div>

<style>
body{
	<?php
	if(@$this->request->post["Diagram"]["screen"]["width"]){
		echo "	width:".$this->request->post["Diagram"]["screen"]["width"]."px;";
	}
	if(@$this->request->post["Diagram"]["screen"]["height"]){
		echo "	height:".$this->request->post["Diagram"]["screen"]["height"]."px;";
	}
	?>
	user-select: none;
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}
#phpx_lib .ac_list{
}
#phpx_lib .ac_list .sec{
	width:300px;
	border:solid 2px #ccc;
	background:#f0f0f0;
	padding:10px;
	position:absolute;
	margin-bottom:10px;
	cursor:pointer;
	user-select: none;
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}
#phpx_lib .ac_list .sec.no_render a{
	color:#fff;
}
#phpx_lib .ac_list .sec.no_render{
	background:#789;
	color:#fff;
}
#phpx_lib .snap_guide_left{
	display:none;
	position:absolute;
	left:-100px;
	top:0px;
	border-left:solid 2px #c00;
	<?php
	if(@$this->request->post["Diagram"]["screen"]["height"]){
		echo "	height:".$this->request->post["Diagram"]["screen"]["height"]."px;";
	}
	else
	{
		echo "	height:100%;";
	}
	?>
}
#phpx_lib .snap_guide_top{
	display:none;
	position:absolute;
	top:-100px;
	left:0px;
	border-top:solid 2px #c00;
	<?php
	if(@$this->request->post["Diagram"]["screen"]["width"]){
		echo "	width:".$this->request->post["Diagram"]["screen"]["width"]."px;";
	}
	else
	{
		echo "	width:100%;";
	}
	?>
}
#phpx_lib .co_menu{
	display:none;
}
#phpx_lib .create_object_hover:hover .co_menu{
	display:block;
	padding-top:10px;
}
#phpx_lib .co_menu ul{
	border:solid 1px #999;
	z-index:10;
	position:absolute;

	background:#fff;
}
#phpx_lib .co_menu label{
	display:block;
	padding:10px;

}
@media print{
	body{
		-webkit-print-color-adjust: exact;
	}
	#phpx_lib .ac_list .sec{
		color:#333;
		border:solid 1px #333;
	}
	#phpx_lib .ac_list .sec a{
		color:#333;
	}
	#phpx_lib .ac_list .sec.no_render{
		background-color:#555 !important;
	}
}

</style>
			<div class="ac_menu mb20">
				<?php echo $this->Form->submit("diagram save",array("class"=>"buttons add")); ?>
				<label for="screen_setting" class="buttons">Screen set</label>
				<label class="buttons create_object_hover">Create Object
					<div class="co_menu">
						<ul>
						<li><label class="type_line">Line</label></li>
						<li><label class="type_memo">Memo</label></li>
						</ul>
					</div>
				</label>

			</div>
			<div class="ac_list">
			<?php
			$count=0;
			foreach($ac_list as $c_key=>$a_){
				foreach($a_ as $aa_){
					$count++;
				?>
				<div class="sec <?php if(!$aa_["autoRender"]){ echo "no_render"; } ?>" index="<?php echo $count; ?>">
					<?php
						echo $this->Form->hidden("position.".$count.".x",array("class"=>"hidden_position_x","index"=>$count));
						echo $this->Form->hidden("position.".$count.".y",array("class"=>"hidden_position_y","index"=>$count));
					?>
					<p class="h4"><?php echo @$aa_["title"]; ?></p>
					<p><?php echo $this->Html->link(str_replace("Controller","",$c_key)."/".h(@$aa_["action"]),array("controller"=>str_replace("Controller","",$c_key),"action"=>h(@$aa_["action"])),array("class"=>"underline","target"=>"_blank")); ?></p>
				</div>
				<?php
				}
			}
			?>
			</div><!--//.ac_list-->
			<div class="ac_line_source hidden"></div>
			<div class="ac_line"></div>
		</div>
	</div>


</div>


<div id="Modal">
	<input type="checkbox" id="screen_setting" class="checks">
	<label></label>
	<label for="screen_setting" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				Screen Setting..
			</div>
		</div>
		<div class="tr">
			<div class="main">
				<div class="mm10">
					<?php echo $this->Form->input("screen.width",array("class"=>"w100")); ?> x 
					<?php echo $this->Form->input("screen.height",array("class"=>"w100")); ?>
				</div>
			</div>
		</div>

		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="screen_setting" class="buttons clearbtn backbtn">cancel</label></li>
					<li class="f_right"><?php echo $this->Form->submit("save",array("class"=>"buttons clearbtn add")); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
	<div id="Modal">
		<div class="basejavar"></div>
	</div>
<script type="text/javascript">
$(function(){
	var mm_type="move";
	var m_toggle=false;
	var index;
	var touch_position;
	$(".type_line").on("click",function(){
		mm_type="line";
	});
	$(".ac_list .sec").on("mousedown",function(e){
		if(mm_type=="move"){
			m_toggle=true;
			touch_position={
				left:(e.clientX-$(this).offset().left)/$(this).width(),
				top:((e.clientY+$(window).scrollTop())-$(this).offset().top)/$(this).height(),
			};
			index=$(this).attr("index");
		}
		else if(mm_type=="line"){
			m_toggle=true;
			touch_position={
				left:(e.clientX-$(this).offset().left)/$(this).width(),
				top:((e.clientY+$(window).scrollTop())-$(this).offset().top)/$(this).height(),
			};
		}

	});
	$(".ac_list .sec").on("touchstart",function(){
		if(mm_type=="move"){
			m_toggle=true;
			index=$(this).attr("index");
			no_scroll();
		}
		else if(mm_type=="line"){
			m_toggle=true;
			index=$(this).attr("index");
			no_scroll();
		}
	});
	$(".ac_list .sec").on("mouseup",function(){
		if(mm_type=="move"){
			m_toggle=false;
			$(".snap_guide_left").css({
				"display":"none",
			});
			$(".snap_guide_top").css({
				"display":"none",
			});
			index=0;
		}
		else if(mm_type=="line"){
			m_toggle=false;
		}
	});
	$(".ac_list .sec").on("touchend",function(){
		if(mm_type=="move"){
			m_toggle=true;
			index=$(this).attr("index");
			$(".snap_guide_left").css({
				"display":"none",
			});
			return_scroll();
		}
	});
	$("body").on("mousemove",function(e){
		if(mm_type=="move"){
			if(m_toggle){
				var set_left=(e.clientX-parseInt($(".ac_list .sec[index="+index+"]").width()*touch_position.left));
				var set_top=((e.clientY-parseInt($(".ac_list .sec[index="+index+"]").height()*touch_position.top))+$(window).scrollTop());

				moving(set_left,set_top);
			}
		}
		else if(mm_type=="line"){
			if(m_toggle){
				var set_left=(e.clientX-parseInt($(".ac_list .sec[index="+index+"]").width()*touch_position.left));
				var set_top=((e.clientY-parseInt($(".ac_list .sec[index="+index+"]").height()*touch_position.top))+$(window).scrollTop());

				line_create(set_left,set_top);
			}
		}
	});
	$("body").on("touchmove",function(e){
		if(mm_type=="move"){
			if(m_toggle){

				var set_left=e.originalEvent.touches[0].pageX-parseInt($(".ac_list .sec[index="+index+"]").width()/2);
				var set_top=e.originalEvent.touches[0].pageY-parseInt($(".ac_list .sec[index="+index+"]").height()/2);
				moving(set_left,set_top);

			}
		}
	});

	function no_scroll(){
		//PC用
		var scroll_event = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';
		$(document).on(scroll_event,function(e){e.preventDefault();});
		//SP用
		$(document).on('touchmove.noScroll', function(e) {e.preventDefault();});
		$('*').on('touchmove.noScroll', function(e) {
		    e.preventDefault();
		});
	}

	function return_scroll(){
		//PC用
		var scroll_event = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';
		$(document).off(scroll_event);
		//SP用
		$("*").off('.noScroll');
	}
		
	setting();
	function setting(){
		for(var vv=0;vv<$(".ac_list .sec").length;vv++){
			var index=$(".ac_list .sec").eq(vv).attr("index");

		//	console.log($(".hidden_position_x[index="+index+"]").val()+".."+$(".hidden_position_y[index="+index+"]").val());

			if($(".hidden_position_x[index="+index+"]").val() || $(".hidden_position_y[index="+index+"]").val()){
				$(".ac_list .sec").eq(vv).css({
					"position":"absolute",
					left:$(".hidden_position_x[index="+index+"]").val()+"px",
					top:$(".hidden_position_y[index="+index+"]").val()+"px",
				});
			
			}
		}

	}
	function moving(left,top){

		var target_left=null;
		var target_top=null;

		for(var usa=0;usa<$(".ac_list .sec").length;usa++){
		
			if($(".ac_list .sec").eq(usa).attr("index")!=index){

				var snap_left=$(".ac_list .sec").eq(usa).offset().left;
				var snap_top=$(".ac_list .sec").eq(usa).offset().top;

				if(Math.abs(snap_left-left)<15){
					target_left=usa;
				}
				if(Math.abs(snap_top-top)<15){
					target_top=usa;
				}
			}


		}

		if(target_left){
			$(".snap_guide_left").css({
				"display":"block",
				"left":$(".ac_list .sec").eq(target_left).css("left"),
			});
			left=parseInt($(".ac_list .sec").eq(target_left).css("left"));
		}
		else
		{
			$(".snap_guide_left").css({"display":"none"});
		}

		if(target_top){
			$(".snap_guide_top").css({
				"display":"block",
				"top":$(".ac_list .sec").eq(target_top).css("top"),
			});
			top=parseInt($(".ac_list .sec").eq(target_top).css("top"));
		}
		else
		{
			$(".snap_guide_top").css({"display":"none"});
		}


		$(".ac_list .sec[index="+index+"]").css({
			"position":"absolute",
			left:left+"px",
			top:top+"px",
		});

		$(".hidden_position_x[index="+index+"]").val($(".ac_list .sec[index="+index+"]").offset().left);
		$(".hidden_position_y[index="+index+"]").val($(".ac_list .sec[index="+index+"]").offset().top);

	}
	function line_create(left,top){
		$(".ac_line").append($(".ac_line_source").html());
		
	}
});
</script>
