//Option...

//GET取得...
var Param=function(){
	this.get=function(){
		var url   = location.href;
		if(url){
			var parameters = url.split("?");
			if(parameters){
				if(parameters[1]!=undefined){
					var params   = parameters[1].split("&");
					var paramsArray = [];
			
					for ( i = 0; i < params.length; i++ ) {
						var buff = params[i].split("=");
						if(location.hash){
							var b1=buff[1].split(location.hash);
							var bb1=b1[0];
						}
						else
						{
							var bb1=buff[1];
						}
						buff[1]=bb1;
						paramsArray[buff[0]]=decodeURIComponent(buff[1]);
					}
					return paramsArray;
				}
			}
		}
		
		
		return null;
	}
};
var Params=new Param();

//nl2br
function nl2br(strings){
	strings=strings.replace(/\r?\n/g, '<br>');
	strings=strings.replace("<script","");
	return strings;
}

//session control
var ses=function(){
	this.read=function(code){
		var inputdata=window.sessionStorage.getItem(code);
		var result=JSON.parse(inputdata);
		return result;
	};
	this.write=function(code,writedata){
		var json=JSON.stringify(writedata);
		window.sessionStorage.setItem(code,json);
	};
	this.delete=function(code){
		window.sessionStorage.removeItem(code)
	};
};
var JSession=new ses();

var les=function(){
	this.read=function(code){
		var inputdata=window.localStorage.getItem(code);
		var result=JSON.parse(inputdata);
		return result;
	};
	this.write=function(code,writedata){
		var json=JSON.stringify(writedata);
		window.localStorage.setItem(code,json);
	};
	this.delete=function(code){
		window.localStorage.removeItem(code)
	};
	
};
var LSession=new les();

//session alert
$(function(){
	var get_alert=JSession.read("alert");
	if(get_alert){
		$(".alert-message").addClass("active");
		$(".alert-message p").text(get_alert);
	}
	JSession.delete("alert");
});


//form data convert
$.fn.Formdat=function(){
	var output={};
	var buff=$(this).serializeArray();
	for(var n1=0;n1<buff.length;n1++){
		var colum=buff[n1].name;
		var value=buff[n1].value;
		output[colum]=value;
	}
	return output;
}

//エラーページ表示処理（仮）
function view_error_page(){
	console.log("error_page");
	setTimeout('location.reload();', 2000);
}
