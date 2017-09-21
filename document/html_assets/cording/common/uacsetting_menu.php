
<script type="text/javascript">
window.onload = function () {
    autoScroll();
}
var $scrollX = 0;
function autoScroll() {
    var $overflow_menu = document.getElementById( 'overflow_menu' );
	var element = document.getElementById('taget'); 
    var rect = element.getBoundingClientRect();
    $overflow_menu.scrollLeft = $scrollX + rect.left-40;
}
</script>


<div class="overflow_wap">
<nav id="overflow_menu">
<ul class="overflow_menu-inner">
<li id="<?php if(@$active_uac=="basic"){ echo "taget"; } ?>"> <a href="uacsetting_basic.php">基本情報設定</a> </li>
<li id="<?php if(@$active_uac=="account"){ echo "taget"; } ?>"> <a href="uacsetting_account.php">アカウント設定</a> </li>
<li id="<?php if(@$active_uac=="openinfo"){ echo "taget"; } ?>"> <a href="uacsetting_openinfo.php">公開情報設定</a> </li>
<li id="<?php if(@$active_uac=="layout"){ echo "taget"; } ?>"> <a href="uacsetting_layout.php">レイアウト設定</a> </li>
<li id="<?php if(@$active_uac=="bank"){ echo "taget"; } ?>"> <a href="uacsetting_bank.php">支払振込設定</a> </li>
<li id="<?php if(@$active_uac=="servicestatus"){ echo "taget"; } ?>"> <a href="uacsetting_servicestatus.php">通知設定</a> </li>
<li id="<?php if(@$active_uac=="payment"){ echo "taget"; } ?>"> <a href="uacsetting_payment.php">支払管理</a> </li>
<li id="<?php if(@$active_uac=="transfer"){ echo "taget"; } ?>"> <a href="uacsetting_transfer.php">振込管理</a> </li>
</ul>
</nav>

<style>
#overflow_menu {
    height: 57px;/*メニューの縦幅*/
	margin-bottom:5px;
	overflow-x: scroll;
	overflow-y: hidden;
	-webkit-overflow-scrolling: touch;
	position:relative;
}
#overflow_menu .overflow_menu-inner {
    list-style-type: none;
    width: 782px;/*メニューの横幅*/
    height: 100%;
    margin: 0;
    padding: 0;
    text-align: center;
}
#overflow_menu li {
    float: left;
    height: 40px;
}
#overflow_menu li:first-child{
margin-left:0px;
}
#overflow_menu a {
    display: block;
    height: 100%;
    padding-right: 15px;
    padding-left: 15px;
    color:;/*文字色*/
	background-color: #E7E7E7;/*メニューの背景色*/	
    font-size: 90%;
    font-weight: bold;
    text-decoration: none;
    line-height: 40px;/*メニューの縦幅*/
	border-radius:7px;
	margin-left:3px;
}
#overflow_menu #taget a{
    color: #fff;/*文字色*/
	background-color:#999999;	

}
#overflow_menu a:hover {
    opacity:0.6;/*マウスホバー時の背景色*/
}
</style>