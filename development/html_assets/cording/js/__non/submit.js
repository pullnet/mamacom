/*
2017/09/04 使わない方針...
$(function(){
	$("form input[type=submit]").on("click",function(){

		$(".error-message").removeClass("active").text("");
		var forms=$(this).attr("data-submit");
		var redirect_uri=$("form[data-submit="+forms+"]").attr("redirect");
		var target_uri=$("form[data-submit="+forms+"]").attr("action");
		var post_data=$("form[data-submit="+forms+"]").serialize();
		
		post_data+="&service_secret="+API.service_secret;
		post_data+="&lisence_key="+API.lisence_key;
		
		$.ajax({
			url:API.domain+target_uri,
			type:"post",
			data:post_data,//$(this).parent().serialize(),
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					//go next
					if(result.message){
						window.sessionStorage.setItem("alert",result.message);
					}
					console.log(window.sessionStorage.length);
					location.href=redirect_uri;
				}
				else{
					if(result.validate){
						var colums=Object.keys(result.validate);
						for(var us=0;us<colums.length;us++){
							$(".error-message[name="+colums[us]+"]").addClass("active").text(result.validate[colums[us]]);
						}
						$(".error-message.total").addClass("active").text("入力に誤りがあります。再度ご確認ください");
					}
					
					
				}
			}
		});
		return false;
	});
});
*/