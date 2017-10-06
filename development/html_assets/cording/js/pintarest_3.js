//リサイズ対応
// 自動でトップへ戻る設定。要らなければ外してもOK
//$("html,body").animate({scrollTop:0},"fast");

// Pinterest風になる感じのJSプラグイン
// PULL-NET.inc nakatsuji
// なかなか外で良いプラグインなかったので自作しちゃいましたww(特に追記する機能が微妙...)
// もちろんレスポンシブ＆追加表示(Ajax)にも対応

function pibox3_refresh(array)
{
	
	//強制リサイズ処理
	array["Forcingresize"]=true;
	pibox3(array);
}
function pibox3(array)
{
	var colum=5;
	var columleft=[];
	var columheight=[];
	var centering_left=0;
	var enabledscroll=true;
	var pageindex=1;
	var buffercount=0;
	var itemcount=0;
	var buffercount=0;
	var resized;
	var columwidth=0;
	
	// 自動でトップへ戻る設定。要らなければ外してもOK
	if(array["autotop"])
	{
		$("html,body").animate({scrollTop:0},"fast");
	}
		$(window).on("load",function(){
			pibox3_setting(array);
		});

		$(window).on("resize",function(){
			pibox3_setting(array,true);
		});
		if(array["Forcingresize"])
		{
			pibox3_setting(array,true);
		}
	

	function pibox3_setting(array,resized0)
	{
		if(resized0==undefined){
			resized=false;
		}
		else
		{
			resized=resized0;
		}

		if(array["contents"]==undefined){array["contents"]=".contents";}//対象のコンテンツ領域
		if(array["item"]==undefined){array["item"]=".item";}//配置対象のアイテム(ボックス)
		if(array["time"]==undefined){array["time"]=300;}//アニメーション効果時間
		if(array["effect"]==undefined){array["effect"]="default";}//アニメーションエフェクト
		if(array["easing"]==undefined){array["easing"]="swing";}//アニメーションのイージング的な何か
		if(array["timed"]==undefined){array["timed"]=50;}//配置時のスライド時間
		if(array["mincolum"]==undefined){array["mincolum"]="";}//最小幅での最小列数(デフォルトは1列)
		if(array["align"]==undefined){array["align"]="center";}//左端(デフォルトは中央ぞろえ)
		if(array["autotop"]==undefined){array["autotop"]="";}//ページ再読み込み時に強制的にトップ画面へ移動する

		if(array["ajax_enabled"]==undefined){array["ajax_enabled"]=false;}//Ajax追加機能のオンオフ(デフォルトはoff)
		if(array["ajax_loadmargin"]==undefined){array["json_loadmargin"]=1000;}//下スクロール時の追加ロードの基準高さ(コンテンツ領域からの高さ)
		if(array["ajax_loadurl"]==undefined){array["ajax_loadurl"]="";}//(Ajaxで)追加ロードするURL
		if(array["ajax_query"]==undefined){array["ajax_query"]="";}//(Ajaxで)追加ロードする際の追加Getパラメータ
		if(array["ajax_incrymenttype"]==undefined){array["ajax_incrymenttype"]=1;}//(Ajaxで)追加ロードする際のパラメータ形式(0:cakephp基準、1:getパラメータ、2:何も渡さない...)
		if(array["ajax_type"]==undefined){array["ajax_type"]="json";}//Ajaxの値返すデータ形式

		$(array["item"]).css({"width":""});
		$(array["item"]).css({"position":"static",});
		columwidth=$(array["item"]).width();
		//console.log(columwidth);
	
		$(array["item"]).css({"position":"absolute",});
		if(resized==false)
		{
			$(array["item"]).css({
				"opacity":0,
				"-webkit-opacity":0,
				"-ms-opacity":0,
				"-moz-opacity":0,
				"-o-opacity":0,
			});
		}

		// 2016 1/16 追加、position:relativeで対応...。
		$(array["contents"]).css({
			"position":"relative",
		});

		//カラムを自動設定
	//	colum=parseInt($(array["contents"]).width()/$(array["item"]).width());
		colum=parseInt($(array["contents"]).width()/columwidth);
		if(array["mincolum"]>0 && colum<array["mincolum"])
		{
			colum=array["mincolum"];
		}


		for(var u0=0;u0<colum;u0++)
		{
		//	columleft[u0]=$(array["item"]).width()*u0;
			columleft[u0]=columwidth*u0;
			columheight[u0]=0;
		}

		//中央寄せ用
		if(array["align"]=="center")
		{
			//centering_left=($(window).width()-$(array["item"]).width()*colum)/2;
			centering_left=($(array["contents"]).width()-columwidth*colum)/2;
		}
		else if(array["align"]=="left")
		{
			centering_left=0;
		}
		else if(array["align"]=="auto")
		{
		//	centering_left=$(array["contents"]).offset().left;
		}
		
			for(var u1=0;u1<$(array["item"]).length;u1++)
			{
				//インデックス付
				$(array["item"]).eq(u1).attr("index",u1);
				
				var maxheightcolum=columheight.indexOf(Math.min.apply(null,columheight));
				$(array["item"]).eq(u1).css("left",(columleft[maxheightcolum]+centering_left)+"px");
	//			$(array["item"]).eq(u1).css("top",($(array["contents"]).offset().top+columheight[maxheightcolum])+"px");
				$(array["item"]).eq(u1).css("top",(columheight[maxheightcolum])+"px");
				$(array["item"]).eq(u1).css("width",columwidth+"px");
				
				if(resized==false)
				{
					pibox_effect(array["item"],array["effect"],array["time"],array["timed"],array["easing"],u1);
				}
				else
				{
					pibox_effect(array["item"],"default",0,0,array["easing"],u1);
				}
				columheight[maxheightcolum]+=$(array["item"]).eq(u1).height();
				$(array["item"]).eq(u1).attr("sign","true");
			}

			itemcount=u1;
			buffercount=u1;
			//次のデータ分をバッファリング
			if(array["ajax_enabled"]==true)
			{
				pibox_buffer(array);
			}

			//親要素に高さを指定
			$(array["contents"]).css("height",Math.max.apply(null,columheight)+"px");
			
			//ページ最下部来たら追加表示
			pibox_underadd(array);
		
	}
	//ページ読み込み時にバッファ取る
	function pibox_buffer(array)
	{
		pageindex++;
		var url;
		if(array["ajax_incrymenttype"]==1)
		{
			url=array["ajax_loadurl"]+"?incryment="+pageindex+"&"+array["ajax_query"]+document.location.search;
		}
		else if(array["ajax_incrymenttype"]==2)
		{
			url=array["ajax_loadurl"]+"/"+pageindex+"/"+array["ajax_query"]+document.location.search;
		}
		else if(array["ajax_incrymenttype"]==3)//2の発展系(ajax_queryが無い)
		{
			url=array["ajax_loadurl"]+"/"+pageindex+document.location.search;
		}
		else if(array["ajax_incrymenttype"]==0)
		{
			url=array["ajax_loadurl"]+document.location.search;
		}
		
		$.ajax({
			url:url,
			type:array["ajax_type"],
			async:false,//同期処理用....
			success:function(data){
				if(pageindex>2)
				{
					pibox_add(array,data);
				}
					
				$(array["contents"]).append(data);
				for(var s1a=buffercount;s1a<$(array["item"]).length;s1a++)
				{
						//インデックス付
						$(array["item"]).eq(s1a).attr("index",s1a);
						
						//バッファなのでオフっとく
						$(array["item"]).eq(s1a).css({
							"position":"absolute",
							"opacity":0,
							"-webkit-opacity":0,
							"-ms-opacity":0,
							"-moz-opacity":0,
							"-o-opacity":0,
							"visibility":"hidden",
							"-webkit-visibility":"hidden",
						});
					}
					buffercount=s1a;
			},
		});
	}

	function pibox_add(array,data)
	{
			for(var u2=itemcount;u2<$(array["item"]).length;u2++)
			{
				var maxheightcolum=columheight.indexOf(Math.min.apply(null,columheight));
				$(array["item"]).eq(u2).css("left",(columleft[maxheightcolum]+centering_left)+"px");
	//			$(array["item"]).eq(u2).css("top",($(array["contents"]).offset().top+columheight[maxheightcolum])+"px");
				$(array["item"]).eq(u2).css("top",(columheight[maxheightcolum])+"px");
				$(array["item"]).eq(u2).css("width",columwidth+"px");
				
				$(array["item"]).eq(u2).css({
					"opacity":1,
					"-webkit-opacity":1,
					"-ms-opacity":1,
					"-moz-opacity":1,
					"-o-opacity":1,
					"visibility":"",
					"-webkit-visibility":"",
				});

				columheight[maxheightcolum]+=$(array["item"]).eq(u2).height();
				$(array["item"]).eq(u2).attr("sign","true");
			}

			itemcount=u2;
			//親要素に高さを指定
			$(array["contents"]).css("height",Math.max.apply(null,columheight)+"px");
	}
	function pibox_effect(item,effect,time,timed,easing,index)
	{
		if(effect=="default")
		{
			$(item).eq(index).css({
				"opacity":1,
				"-webkit-opacity":1,
				"-ms-opacity":1,
				"-moz-opacity":1,
				"-o-opacity":1,
				"visibility":"",
				"-webkit-visibility":"",
			});
		}
		else if(effect=="feed")
		{
			$(item).eq(index).css({
				"visibility":"",
				"-webkit-visibility":"",
			}).animate({
				"opacity":1,
				"-webkit-opacity":1,
				"-ms-opacity":1,
				"-moz-opacity":1,
				"-o-opacity":1,
			},time);
		}
		else if(effect=="timed_feed")
		{
			var sis=setTimeout(function(){
				$(item).eq(index).css({
					"visibility":"",
					"-webkit-visibility":"",
				}).animate({
					"opacity":1,
					"-webkit-opacity":1,
					"-ms-opacity":1,
					"-moz-opacity":1,
					"-o-opacity":1,
				},time);
			},timed*index);
		}
		else if(effect=="slide")
		{
			$(item).eq(index).css({
				"visibility":"",
				"-webkit-visibility":"",
				"margin-top":"50px",
			}).animate({
				"margin-top":"0px",
				"opacity":1,
				"-webkit-opacity":1,
				"-ms-opacity":1,
				"-moz-opacity":1,
				"-o-opacity":1,
			},time,easing);
		}
		else if(effect=="timed_slide")
		{
			var sis=setTimeout(function(){
				$(item).eq(index).css({
					"visibility":"",
					"-webkit-visibility":"",
					"margin-top":"50px",
				}).animate({
					"margin-top":"0px",
					"opacity":1,
					"-webkit-opacity":1,
					"-ms-opacity":1,
					"-moz-opacity":1,
					"-o-opacity":1,
				},time);
			},timed*index,easing);
		}
		else if(effect=="timed_slide_down")
		{
			var sis=setTimeout(function(){
				$(item).eq(index).css({
					"visibility":"",
					"-webkit-visibility":"",
					"margin-top":"-50px",
				}).animate({
					"margin-top":"0px",
					"opacity":1,
					"-webkit-opacity":1,
					"-ms-opacity":1,
					"-moz-opacity":1,
					"-o-opacity":1,
				},time);
			},timed*index,easing);
		}
	}
	function pibox_underadd(array)
	{
		if(array["ajax_loadurl"]!="")
		{
			$(window).on("scroll",function(){
				if($("body").scrollTop()==0)
				{
					var bottoms=$(window).height()+$("html").scrollTop();
				}
				else
				{
					var bottoms=$(window).height()+$("body").scrollTop();
				}
				var allheight=$(document).height();
				//console.log(bottoms+"___"+allheight);

				if(bottoms>=allheight-array["json_loadmargin"])
				{
					if(enabledscroll==true)
					{
						enabledscroll=false;
						pibox_buffer(array);
					}
				}
				else
				{
					enabledscroll=true;
				}
			});
		}
	}
}