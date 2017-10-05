<?php $title="メッセージを送受信する";?>
<?php /*include("common/header_msg.php");*/ ?>
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

    background: #E688B5;
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

.message_talk .arrive_block{
margin:15px 8px 15px 4px;
overflow:hidden;
}
.message_talk .arrive_block .arrive_icon{
float:left;
width:18%;
padding:2px;
border:solid 1px #CCCCCC;
}
.message_talk .arrive_block .r_block{
text-align:left;
float:left;
width:75%;
margin-left:5px;
}
.message_talk .arrive_block .arrive_name{
font-size:14px;
margin-bottom:3px;
margin-left:8px;
}
.message_talk .arrive_block .arrive_name::after{
content:"さん";
font-size:12px;
margin-left:5px;
}

.message_talk .arrive_block .arrive_balloon{
padding:8px 10px;
margin-left:8px;
border-radius:6px;
background: #f0f0f0;
position:relative;
}

.message_talk .arrive_block .arrive_balloon::after{
content:"";
position:absolute;
display:block;
width:10px;
height:10px;
background: #f0f0f0;
top:13px;
left:-5px;
transform: rotate(-45deg);
}

.message_talk .arrive_block.unread .arrive_balloon{
padding:8px 10px;
margin-left:8px;
border-radius:6px;
background: #FDF0C4;
position:relative;
}

.message_talk .arrive_block.unread .arrive_balloon::after{
content:"";
position:absolute;
display:block;
width:10px;
height:10px;
background: #FDF0C4;
top:13px;
left:-5px;
transform: rotate(-45deg);
}

.message_talk .arrive_block .arrive_text{
font-size:12px;
line-height:1.5;
}
.message_talk .arrive_block .attach_images{
}
.message_talk .arrive_block .attach_file{
}
.message_talk .arrive_block .arrive_time{
margin-left:8px;
font-size:11px;
margin-top:4px;
}

.message_talk .send_block{
margin:15px 10px 15px 10px;
text-align:right;
}
.message_talk .send_block .r_block{
overflow:hidden;
}
.message_talk .send_block .send_balloon{
padding:8px 15px;
margin-right:8px;
border-radius:6px;
background: #EFB1CF;
position:relative;
float:right;
}
.message_talk .send_block .send_balloon::after{
content:"";
position:absolute;
display:block;
width:10px;
height:10px;
background: #EFB1CF;
top:13px;
right:-5px;
transform: rotate(-45deg);
}
.message_talk .send_block .send_text{
text-align:left;
font-size:12px;
line-height:1.5;
color:#FFFFFF;
}
.message_talk .send_block .send_time{
margin-right:12px;
font-size:11px;
margin-top:4px;
}

.msgfooter {
    position: fixed;
    bottom: 0;
    background: #f0f0f0;
    left: 0;
    width: 100%;
	height:48px;
}
.msgfooter_dmy{
	height:48px;
}
.msgfooter .bs .float li {
    float: left;
    width: 15%;
    padding-right: 3px;
}
.msgfooter .bs .float li .buttons {
    width: 100%;
}
.msgfooter .bs .buttons {
    text-align: center;
    width: 120px;
    line-height: 30px;
    padding: 0px;
}
.msgfooter .bs .submit {
    background: #0B8A82;
    color: #FFF;
    border: solid 1px #0B8A82;
    border-radius: 5px;
    cursor: pointer;
}

.msgfooter .bs .buttons.addfile::before {
    background-image: url(https://www.collabo.work/img/2016new/icon_clip.png);
    width: 16px;
    content: "　";
    display: inline-block;
    margin-right: 5px;
    background-repeat: no-repeat;
    background-position: center center;
}
.msgfooter .bs .float li span {
    display: none;
}

.msgfooter .bs .float li .buttons.addfile {
    width: 100%;
    background: none;
    border: none;
}
.msgfooter .bs .float li:first-child {
    float: left;
    padding-right: 3px;
    width: 70%;
}

input, select, textarea {
    line-height: 0.5em;
    padding: 10px 10px 5px;
    margin: 0px;
    width: 100%;
	margin-left:5px;
}
.msgfooter .bs {
    margin-top: 10px;
    margin-bottom: 10px;
}

#popup input.checks:checked+label~.basejavar, #popup input.checks:checked+label~.window {
    z-index: 1002;
    display: block;
}

</style>
<div class="msgheader">
	<div class="main">
		<div class="w1000 relative" style="overflow:visible">
			<ul class="table">
				<li class="type single"><span>個人</span></li>
				<li class="title">USER_test さん
				<li>
				<li class="right member"></li>
				<a href="message_list.php" class="close smp780"></a>
			</ul>
		</div>
	</div>
	<!--//.main-->
</div>
<!--msgheader-->
<div class="msgheader_dmy"></div>
<div class="message_talk">
	<div class="send_block">
		<div class="r_block">
			<div class="send_balloon">
				<div class="send_text">メッセージを送れます。</div>
			</div>
		</div>
		<p class="send_time">2017.02.03 12:11</p>
	</div>
	<!-- send_block-->
	<div class="arrive_block">
		<p class="arrive_icon"><img src="images/iconpeople.png"></p>
		<div class="r_block">
			<p class="arrive_name">USE_testさん</p>
			<div class="arrive_balloon">
				<p class="arrive_text">メッセージが届きます！</p>
				<p class="attach_images"></p>
				<p class="attach_file"></p>
			</div>
			<p class="arrive_time">2017.02.03 12:11</p>
		</div>
	</div>
	<!-- arrive_block-->
	<div class="arrive_block">
		<p class="arrive_icon"><img src="images/iconpeople.png"></p>
		<div class="r_block">
			<p class="arrive_name">USE_testさん</p>
			<div class="arrive_balloon">
				<p class="arrive_text">画僧も送受信できます。</p>
				<p class="attach_images"><img src="images/top_noimage.jpg"></p>
				<p class="attach_file"></p>
			</div>
			<p class="arrive_time">2017.02.03 12:11</p>
		</div>
	</div>
	<!-- arrive_block-->
	<div class="send_block">
		<div class="r_block">
			<div class="send_balloon">
				<div class="send_text">メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。メッセージが入ります。</div>
			</div>
		</div>
		<p class="send_time">2017.02.03 12:11</p>
	</div>
	<!-- send_block-->
	<div class="arrive_block unread">
		<p class="arrive_icon"><img src="images/iconpeople.png"></p>
		<div class="r_block">
			<p class="arrive_name">USE_testさん</p>
			<div class="arrive_balloon">
				<p class="arrive_text">未読の場合は色が変化し、既読になれば色が戻ります。</p>
				<p class="attach_images"></p>
				<p class="attach_file"></p>
			</div>
			<p class="arrive_time">2017.02.03 12:11</p>
		</div>
	</div>
	<!-- arrive_block-->
</div>
<div class="msgfooter_dmy"></div>
<footer id="msgfooter" class="msgfooter" style="">
<div class="bs">
	<form action="" id="msgdata" method="post" accept-charset="utf-8">
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST"/>
		</div>
		<input type="hidden" name="data[Sendmsg][number]" value="2" id="msgnumber" />
		<ul class="float">
			<li>
				<textarea name="data[Sendmsg][message]" class="message" id="messagetext" placeholder="メッセージを入力"></textarea>
			<li>
			<li>
				<label for="addfile_control" class="buttons addfile"><span>ファイル添付</span></label>
				<span id="total_zipfile_view"></span> </li>
			<li class="f_right">
				<input type="button" value="送信" class="buttons submit" id="submitbtn">
			</li>
		</ul>
		<div id="zipfile_data_source">
			<div class="sec">
				<input type="hidden" name="data[Sendmsg][sources]" class="icontag" id="SendmsgSources"/>
				<input type="hidden" name="data[Sendmsg][sources]" class="filename" id="SendmsgSources"/>
				<input type="hidden" name="data[Sendmsg][sources]" class="filetype" id="SendmsgSources"/>
				<input type="hidden" name="data[Sendmsg][sources]" class="uniqid" id="SendmsgSources"/>
			</div>
		</div>
		<div id="zipfile_data"></div>
	</form>
</div>

</body>
</html>
<?php /*include("common/footer_msg.php");*/ ?>
