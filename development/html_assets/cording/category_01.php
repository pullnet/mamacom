<?php $title="ライブラリの検索結果";?>
<?php $active_category_01 = true;?>
<?php include("common/header.php"); ?>

<div class="wrapper category_01">
	<a href="index.php"><h2 class="mtitle">緊急・お役立ち</h2></a>


	<div class="waiting"></div>
	<div class="area01 hidden">

	</div>
	
	<div class="pager mt10 ">
		<ul class="float pager_area">

		</ul>
	</div>

</div>

<script type="text/javascript">
$(function(){

	
	//ＵＲＬパラメータから地区ID取得とページ番号取得
	var arg  = new Object;
	url = location.search.substring(1).split('&');
	for(i=0; url[i]; i++) {
		var k = url[i].split('=');
		arg[k[0]] = k[1];
	}
	
	if('id' in arg){
		var ditrict_id = arg.id;
	}else{
		var ditrict_id = 0;
	}
		
	if('page' in arg){
		var page_num = arg.page;
	}else{
		var page_num = 1;
	}	
	
	
	var token=JSession.read("token");
	
	//コンテンツの処理
	var url_method="emergency/emergency_list";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				page:page_num,
			},
			success:function(data){

				$(".area01").animate({
					"opacity":1,
					"-webkit-opacity":1,
					"-moz-opacity":1,
					"-ms-opacity":1,
					"-o-opacity":1,
				},500);

				$(".waiting").animate({
					"opacity":0,
					"-webkit-opacity":0,
					"-moz-opacity":0,
					"-ms-opacity":0,
					"-o-opacity":0,
				},300);


				var result=JSON.parse(data);
				console.log(result);

							
				var item_count = Object.keys(result).length;			
				for(var i = 0; i < item_count-4; i++){	
					
					
					//一部Jsonパース
					var caption = JSON.parse(result[i]["Contents"].caption);//console.log(caption);			
					var shop_info = JSON.parse(result[i]["Contents"].shop_info);//console.log(caption);	
				
					$(".copy_base1 h3").text(result[i]["Contents"].title);
					
					if('text1' in caption){
						$(".copy_base1 .text").html(caption.text1);	
					}
					else{
						$(".copy_base1 .text").css('display','none');	
					}
					if('text2' in caption){
						$(".copy_base1 .red").html(caption.text2);	
					}
					else{
						$(".copy_base1 .red").css('display','none');	
					}
					
					$(".copy_base1 .buttons span").html(shop_info.tel);
				
					if('tel_text' in shop_info){
						$(".copy_base1 .other").html(shop_info.tel_text);
					}
					else{
						$(".copy_base1 .subt2").css('display','none');	
					}						

					if('open_text' in shop_info){
						$(".copy_base1 .times").html(shop_info.open_text);	
					}
					else{
						$(".copy_base1 .subt1").css('display','none');	
					}					
			
					$(".copy_base1 .photo01 img").attr('src',result[i]["Contents"].content);
					//console.log(result[i],["Contents"].content);
					
					var tel_number = shop_info.tel.replace( /-/g , "" ) ;　tel_number = tel_number.replace( /─/g , "" ) ;　tel_number = tel_number.replace( /一/g , "" ) ;
					$(".copy_base1 p a").attr('href','tel:'+tel_number);	
						
					//書き換え処理
					$('.area01').append($(".copy_base1").html());						

				}
				
				//ページャー処理
				$(".serch_result_text b").text("全 "+result.totalcount+" 件");
				$(".serch_result_text span").text("-うち"+item_count+"件表示-");

				if(result.totalpage>1){

						if(page_num!=1){
							$('.copy_pager a').html("&lt;");
							$(".copy_pager *[content_link]").attr("href","category_01.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)-1) );
							
							$('.pager_area').append($(".copy_pager").html());	
						}
										
						//表示はページャの5個まで
						if(page_num>2){
							if(result.totalpage-page_num+1 > 3){var view_limit = 3;}else{var view_limit = result.totalpage-page_num+1;}
						}
						else if(page_num>1){
							if(result.totalpage-page_num+1 > 4){var view_limit = 4;}else{var view_limit = result.totalpage-page_num+1;}
						}
						else{
							if(result.totalpage-page_num+1 > 5){var view_limit = 5;}else{var view_limit = result.totalpage-page_num+1;}
						}
						
						if(page_num>2){
							
							$('.copy_pager a').html( (parseInt(page_num)-2) );
							$(".copy_pager *[content_link]").attr("href","category_01.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)-2) );
							$('.pager_area').append($(".copy_pager").html());
	
						}
						if(page_num>1){
							
							$('.copy_pager a').html( (parseInt(page_num)-1) );
							$(".copy_pager *[content_link]").attr("href","category_01.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)-1) );
							$('.pager_area').append($(".copy_pager").html());
	
						}						
						
						for(i=0;i<view_limit; i++){
						
							if(i==0){  $('.copy_pager li').addClass("active");  }
							else{  $('.copy_pager li').removeClass("active");  }
							
							$('.copy_pager a').html( (parseInt(page_num)+i) );
							$(".copy_pager *[content_link]").attr("href","category_01.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)+i) );
							
							$('.pager_area').append($(".copy_pager").html());				
						}
						
						if( page_num < result.totalpage){
							$('.copy_pager a').html("&gt;");
							$(".copy_pager *[content_link]").attr("href","category_01.php"+"?id="+ditrict_id+"&page="+ (parseInt(page_num)+1) );
							
							$('.pager_area').append($(".copy_pager").html());	
						}	
				}	
				
			}
		});
	}
	else{
		view_error_page();
	}

});
</script>

<div class="copy_base1" style="display:none;">
	<div class="item">
		<div class="bs">
			<div class="s01">
				<h3></h3>
				<div class="block">
					<p class="text"></p>
					<div class="box">
					<table>
					<tr>
						<td style="width:80px">
							<div class="l_block">
								<div class="s00 photo01"><img src="" alt=""></div>
							</div>
						</td>
						<td>
							<div class="r_block">
								<p><a href="" class="buttons f25"><span></span></a></p>
							</div>
						</td>
					</tr>
					</table>
					</div>
					<p class="subt subt1"><span class="colon">開設時間:</span><span class="times"></span></p>
					<p class="subt subt2"><span class="colon">電話番号:</span><span class="other"></span></p>
					<p class="red"></p>
				</div>
			</div>
		</div>
	</div>
	<!--//.item-->
</div>


	<div class="copy_pager" style="display:none;">
						<li class="pager"><a content_link></a> </li>
	</div>



<style>
.footer_dmy{
	height:50px;
}
.subt{
	padding:0 3% 0;
}
.box{
	padding:0 10px;
}
.category_01 table tr th, table tr td { 
  padding: 0; 
  display: table-cell;
}
body{
		background-color: #FFD0DB;
}
.item .post_date{
		text-align:center;
		margin:2px 5px 0;
		font-size:10px;
}

</style>


<?php include("common/footer.php"); ?>


