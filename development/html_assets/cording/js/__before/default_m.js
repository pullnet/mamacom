
window.onunload=function(){}
$(function(){

	//タップ高速化用
		var touch_px_b=0;
		var touch_py_b=0;
		var touch_px_a=0;
		var touch_py_a=0;
	
	$("label").on("touchstart",function(e){
		touch_px_b=e.originalEvent.touches[0].pageX;
		touch_py_b=e.originalEvent.touches[0].pageY;
		return true;
	});
	$("label").on("touchend",function(e){
	
		var fors=$(this).attr("for");
		
		if(fors)
		{

			//距離を計算
			touch_px_a=e.originalEvent.changedTouches[0].pageX;
			touch_py_a=e.originalEvent.changedTouches[0].pageY;
			var vectol_x=Math.abs(touch_px_b-touch_px_a);
			var vectol_y=Math.abs(touch_py_b-touch_py_a);

			var vect=Math.sqrt(Math.pow(vectol_x,2)+Math.pow(vectol_y,2));
			
			if(vect<=6)
			{
				if($("input[id="+fors+"]").attr("type")=="checkbox"){
					if($("input[id="+fors+"]:checked").val())
					{
						$("input[id="+fors+"]").prop("checked",false);
						return false;
					}
					else
					{
						$("input[id="+fors+"]").prop("checked",true);
						return false;
					}
				}
				else if($("input[id="+fors+"]").attr("type")=="radio"){

					if(!$("input[id="+fors+"]:checked").val()){
						$("input[id="+fors+"]").prop("checked",true);
						return false;
					}
				}
			}
		}
		
		return true;
	});
	
});