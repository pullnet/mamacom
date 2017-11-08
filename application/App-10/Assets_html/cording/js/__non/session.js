$(function(){
	//session受取
	var get_alert=window.sessionStorage.getItem("alert");
	
	if(get_alert){
		$(".alert-message").addClass("active");
		$(".alert-message p").text(get_alert);
	}
	window.sessionStorage.removeItem("alert")
});