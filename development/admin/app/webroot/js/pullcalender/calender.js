var holidaydata=[];
var nowdate=new Date();
var yssm=["日","月","火","水","木","金","土"];
var now_year=nowdate.getFullYear();
var now_month=nowdate.getMonth()+1;
var now_day=nowdate.getDate();
var now_youbi=yssm[nowdate.getDay()];

var select_year=now_year;
var select_month=now_month;
var select_day=now_day;

calender_setweek(now_year,now_month);

function set_calender(array)
{
	holidaydata=array["holiday"];
	if(array["id"]==undefined)
	{
		array["id"]="calender";
	}
	set_calender_2(array);
}
function set_calender_2(array)
{
	if(array["id"]==undefined)
	{
		array["id"]="calender";
	}
	if(array["toggle"]!=undefined)
	{

		$("#"+array["id"]).css({"display":"none"});

		$("#"+array["toggle"]).on("click",function(){
			if($("#"+array["id"]).css("display")=="block")
			{
				//close
				var heights=$("#"+array["id"]).height();
				$("#"+array["id"]).animate({"height":"0px"},200,function(){
					$(this).css({"display":"none","height":""});
				});
			}
			else
			{
				//open
				if($("#"+array["input"]).val())
				{
					var setdate=new Date($("#"+array["input"]).val());
					select_year=setdate.getFullYear();
					select_month=setdate.getMonth()+1;
					select_day=setdate.getDate();
					calender_setweek(array,select_year,select_month,select_day);
				}
				
				var heights=$("#"+array["id"]).height();
				$("#"+array["id"]).css({
					"display":"block",
					"height":"0px",
				}).animate({"height":heights+"px"},200,function(){
					$(this).css("height","auto");	
				});
				

			}
		});
	}
	if(array["open"]!=undefined)
	{
		$("#"+array["id"]).css({"display":"none"});

		$("#"+array["open"]).on("click",function(){
			if($("#"+array["id"]).css("display")!="block")
			{
				//open
				if($("#"+array["input"]).val())
				{
					var setdate=new Date($("#"+array["input"]).val());
					select_year=setdate.getFullYear();
					select_month=setdate.getMonth()+1;
					select_day=setdate.getDate();
					calender_setweek(array,select_year,select_month,select_day);
				}
				
				var heights=$("#"+array["id"]).height();
				$("#"+array["id"]).css({
					"display":"block",
					"height":"0px",
				}).animate({"height":heights+"px"},200,function(){
					$(this).css("height","auto");	
				});

				if(!$("#"+array["input"]).val())
				{
					var nowdates=new Date();
					$("#"+array["output"]).val(nowdates.getFullYear()+"-"+(nowdates.getMonth()+1)+"-"+nowdates.getDate());
				}
			}
			return false;
		});
	}

		$("body,html").on("click",function(){
			if($("#"+array["id"]).css("display")=="block")
			{
				//close
				var heights=$("#"+array["id"]).height();
				$("#"+array["id"]).animate({"height":"0px"},200,function(){
					$(this).css({"display":"none","height":""});
				});
			}
		});
		$("#"+array["id"]).on("click",function(){
			//伝搬防止用
			return false;
		});
	
	var chtml='\
	<div class="calenderbox">\n\
		<div class="head">\
			<div class="button back"><span></span></div>\
			<div class="center"><span class="set_year">XxXX</span><span class="set_monthly">y</span></div>\
			<div class="button next"><span></span></div>\
		</div>\
		<div class="base">\
			<div class="weekly index">\
				<div class="day nichi index" data-date=""><span>日</span></div>\
				<div class="day getu index" data-date=""><span>月</span></div>\
				<div class="day ka index" data-date=""><span>火</span></div>\
				<div class="day sui index" data-date=""><span>水</span></div>\
				<div class="day moku index" data-date=""><span>木</span></div>\
				<div class="day kin index" data-date=""><span>金</span></div>\
				<div class="day do index" data-date=""><span>土</span></div>\
			</div>\
			<div class="weekly" data-sec="1">\
				<div class="day nichi" data-date=""><span></span></div>\
				<div class="day getu" data-date=""><span></span></div>\
				<div class="day ka" data-date=""><span></span></div>\
				<div class="day sui" data-date=""><span></span></div>\
				<div class="day moku" data-date=""><span></span></div>\
				<div class="day kin" data-date=""><span></span></div>\
				<div class="day do" data-date=""><span></span></div>\
			</div>\
			<div class="weekly" data-sec="2">\
				<div class="day nichi" data-date=""><span></span></div>\
				<div class="day getu" data-date=""><span></span></div>\
				<div class="day ka" data-date=""><span></span></div>\
				<div class="day sui" data-date=""><span></span></div>\
				<div class="day moku" data-date=""><span></span></div>\
				<div class="day kin" data-date=""><span></span></div>\
				<div class="day do" data-date=""><span></span></div>\
			</div>\
			<div class="weekly" data-sec="3">\
				<div class="day nichi" data-date=""><span></span></div>\
				<div class="day getu" data-date=""><span></span></div>\
				<div class="day ka" data-date=""><span></span></div>\
				<div class="day sui" data-date=""><span></span></div>\
				<div class="day moku" data-date=""><span></span></div>\
				<div class="day kin" data-date=""><span></span></div>\
				<div class="day do" data-date=""><span></span></div>\
			</div>\
			<div class="weekly" data-sec="4">\
				<div class="day nichi" data-date=""><span></span></div>\
				<div class="day getu" data-date=""><span></span></div>\
				<div class="day ka" data-date=""><span></span></div>\
				<div class="day sui" data-date=""><span></span></div>\
				<div class="day moku" data-date=""><span></span></div>\
				<div class="day kin" data-date=""><span></span></div>\
				<div class="day do" data-date=""><span></span></div>\
			</div>\
			<div class="weekly end" data-sec="5">\
				<div class="day nichi" data-date=""><span></span></div>\
				<div class="day getu" data-date=""><span></span></div>\
				<div class="day ka" data-date=""><span></span></div>\
				<div class="day sui" data-date=""><span></span></div>\
				<div class="day moku" data-date=""><span></span></div>\
				<div class="day kin" data-date=""><span></span></div>\
				<div class="day do" data-date=""><span></span></div>\
			</div>\
			<div class="weekly end" data-sec="6">\
				<div class="day nichi" data-date=""><span></span></div>\
				<div class="day getu" data-date=""><span></span></div>\
				<div class="day ka" data-date=""><span></span></div>\
				<div class="day sui" data-date=""><span></span></div>\
				<div class="day moku" data-date=""><span></span></div>\
				<div class="day kin" data-date=""><span></span></div>\
				<div class="day do" data-date=""><span></span></div>\
			</div>\
		</div>\
	</div>\
<div class="selectdate"></div>\
';

	$("#"+array["id"]).html(chtml);
	calender_setweek(array,select_year,select_month);
	
	$("#"+array["id"]+" .calenderbox .next").on("click",function(){
		select_month++;
		if(select_month>12){
			select_month=1;
			select_year++;
		}
		calender_setweek(array,select_year,select_month);
	});
	$("#"+array["id"]+" .calenderbox .back").on("click",function(){
		select_month--;
		if(select_month<=0){
			select_month=12;
			select_year--;
		}
		calender_setweek(array,select_year,select_month);
	});
	
	$("#"+array["id"]+" .day").not(".index").on("click",function(){
		$("#"+array["output"]).val($(this).attr("data-date"));
		select_day=new Date($(this).attr("data-date")).getDate();
		$(".day").removeClass("selectday");
		$(this).addClass("selectday");
	});
	
}

function calender_setweek(array,setyear,setmonth,setdate)
{
	$("#"+array["id"]+" .calenderbox .set_year").text(setyear);
	$("#"+array["id"]+" .calenderbox .set_monthly").text(setmonth);

	var monthlydays=[31,28,31,30,31,30,31,31,30,31,30,31];
	var weeks=new Date(setyear+"/"+setmonth+"/1");

	
	var w_youbi=weeks.getDay();
	
	var countex=0;
	for(var s0=0;s0<6;s0++)
	{
		var checks=false;
		
		for(var s1=0;s1<7;s1++)
		{
			if(s0==0 && s1>=w_youbi)
			{
				countex++;
			
			}
			if(s0>0)
			{
				countex++;			
			}
			
			//当日(today)
			if(countex==now_day && setyear==now_year && setmonth==now_month)
			{
				$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).addClass("today");
			}
			else
			{
				$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).removeClass("today");
			}
			//選択日(selectday)
			if(countex==select_day && setyear==select_year && setmonth==select_month)
			{
				$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).addClass("selectday");
			}
			else
			{
				$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).removeClass("selectday");
			}

				$("#"+array["id"]+" .weekly .day").not(".index").removeClass("notnull");

			if(countex>0 && countex<=monthlydays[setmonth-1])
			{
				var ssid=parseInt(Math.random()*1000);
				$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).attr("id","c-"+setyear+setmonth+countex+ssid)
				$("#c-"+setyear+setmonth+countex+ssid).attr("data-date",setyear+"-"+setmonth+"-"+countex);
				$("#c-"+setyear+setmonth+countex+ssid+" span").text(countex);
				checks=true;
			}
			else
			{
				$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day span").not(".index").eq(s1).text("");
				$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).addClass("notnull");
			}

			//休日判定
			$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).removeClass("holiday");

			for(var s2=0;s2<holidaydata.length;s2++)
			{
				var juge1=false;
				var juge2=false;
				var juge3=false;
				var juge4=false;
				var juge5=false;
				if(holidaydata[s2][0]==0 || holidaydata[s2][0]==setyear)
				{
					juge1=true;
				}
				if(holidaydata[s2][1]==setmonth && setmonth!="")
				{
					juge2=true;
				}
				if(holidaydata[s2][2]==countex && countex!=0)
				{
					juge3=true;
				}
				if(holidaydata[s2][3]==s0)
				{
					juge4=true;
				}
				var exyoubi=new Date(setyear+"-"+setmonth+"-"+countex);
				if(holidaydata[s2][4]==exyoubi.getDay())
				{
					juge5=true;
				}

				if(juge1==true && juge2==true && juge3==true)
				{
					$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).addClass("holiday");
				}
				if(juge1==true && juge2==true && juge4==true && juge5==true)
				{
					$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"] .day").not(".index").eq(s1).addClass("holiday");

				}
			}

		}
		if(checks==false)
		{
			$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"]").css("display","none");			
		}
		else
		{
			$("#"+array["id"]+" .weekly[data-sec="+(s0+1)+"]").css("display","table");			
		}

	}
}