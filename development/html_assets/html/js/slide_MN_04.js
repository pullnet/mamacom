$(function(){

	var start_index=0;
	var intervals=null;
	var gethash=location.hash;
	
	///スライドするページの高さ調整用
	$(".slide_page .pages .sec .bs0").css({
		height:($(window).height()-100)+"px",
	});
	$(window).on("resize",function(){
		$(".slide_page .pages .sec .bs0").css({
			height:($(window).height()-100)+"px",
		});
	});


	//スライド部分(bxSlider)
	$(".slide_page .pages").bxSlider({
		auto:false,
		speed:300,
		controls:false,
		pager:true,
		pagerCustom:".slide_page .tab",
		infiniteLoop:false,
		swipeThreshold:50,
		startSlide:start_index,
//		oneToOneTouch:false,
		preventDefaultSwipeY:false,
		onSlideBefore: function($slideElement, oldIndex, newIndex){
			slide_before_action(newIndex);
		},
	});

	//スライドする直前またはページ開いた時の初期状態のfunction
	slide_before_action(start_index,true);
	function slide_before_action(newIndex,loadingmode){

		//更新間隔の設定。ms単位
		var interval_time=15000;

		//スライドのヘッダーナビ部分のスライドの設定(押すと自動的にスライドされる仕組み)
		if(newIndex-1>=0){
			var target_left=parseInt($(".slide_page .tab a[data-slide-index="+(newIndex-1)+"]").offset().left)-5;
			if(loadingmode){
				$(".slide_page .tab").animate({"scrollLeft":"+="+target_left+"px"},5);
			}
			else
			{
				$(".slide_page .tab").animate({"scrollLeft":"+="+target_left},300);
			}
		}

		if(newIndex==0){
			$("#c_title").text("サンプルページ 001");


		}
		else if(newIndex==1){
			$("#c_title").text("サンプルページ 002");

		}
		else if(newIndex==2){
			$("#c_title").text("サンプルページ 003");

		}
	}


	//2017/7/06 まだiOSで下までスクロールしきると、スクロールできなくなる問題が残っている...。

	$("body").on("click",".if_noscroll",function(){
		var index=$(this).attr("index");
		$(".slide_page .pages:nth-child("+index+") .bs0").animate({scrollTop:"-=5px"},300);
	});
	var juge_chance=true;
	$(".slide_page .pages .bs0").on("scroll",function(){
		var juges=($(this).get(0).scrollHeight-$(this).height())<=$(this).scrollTop();
		$("#c_title").text($(this).get(0).scrollHeight-$(this).height()+".."+$(this).scrollTop());
	});
});