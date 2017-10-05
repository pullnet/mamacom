<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style_type1.css">
<link rel="stylesheet" type="text/css" href="css/style_type2.css">
<link rel="stylesheet" type="text/css" href="css/style_csmp.css">
<script type="text/javascript">
	//iphone用css
	var wnu=window.navigator.userAgent;
	if(wnu.indexOf("iPhone")>0)
	{
		document.write('<link rel="stylesheet" type="text/css" href="css/style_iphone.css">');
	}
</script>
<link rel="stylesheet" type="text/css" href="css/style_csmp_sideways.css">
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1.0">
<!--<meta name="viewport" content="width=640px,maximum-scale=1,user-scalable=0">-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/default_m.js"></script>
</head>
<body>



<style>
.msgheader .close::before {
	font-size:12px;
    content: "閉じる × ";
}
.msgheader .main .close {
    width: auto;
    padding: 5px 10px;
    position: absolute;
    top: 6px;
	right:7px;
    font-size: 13px;
}
.msgheader .close {

    background: #F39A12;
    color: #FFF;
    text-decoration: none;
    padding: 5px 15px;
    margin-right: 0px;
}
.msgheader .smp780 {
    display: block;
}
.msgheader li{
	font-size:14px;
	display:inline-block;
	vertical-align:top;
	padding-left:10px;
	margin-top:10px;
}
.msgheader .main .type.single span {
    background: #4F6AAF;
	font-size:14px;
	color:#FFFFFF;
	width: 80px;
	padding:2px 10px;
	border-radius:5px;
}


.msgheader li.title{
font-size:15px;
}

.msgheader {
    position: fixed;
    width: 100%;
    background: #fff;
    top: 0px;
    left: 0px;
	border-bottom: solid 1px #ccc;
    z-index: 3;
	height:45px;
}
.msgheader_dmy{
	height:40px;
}

</style>
<div class="msgheader">
	<div class="main">
		<div class="w1000 relative" style="overflow:visible">
			<ul class="table">
				<li class="type single"><span>個人</span></li>
				<li class="title">USER_test さん<li>
				<li class="right member"></li>
				<a onclick="window.close()" class="close smp780"></a>
			</ul>
		</div>
	</div><!--//.main-->
</div><!--msgheader-->

<div class="msgheader_dmy"></div>