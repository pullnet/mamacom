<?php $title="コラボ詳細";?>
<?php include("common/header.php"); ?>

<div class="wrapper">

	<div class="content_detail">
	
		<input type="radio" name="aaa" id="content_detail" style="display:none" checked>
		<input type="radio" name="aaa" id="collabo_list" style="display:none">
		<input type="radio" name="aaa" id="owner_data" style="display:none">

		<div class="head">
			<div class="type collabo">new</div>
			<a href="javascript:history.back();"><h1 class="mtitle"></h1></a>

			<ul class="tab float">
				<li><label for="content_detail" class="detail">写真</label></li>
				<li><label for="collabo_list" class="collabo">詳細内容</label></li>
				<li><label for="owner_data" class="owner">店舗情報</label></li>
			</ul>
		</div><!--//.head-->
		<div class="head_dmy"></div>
			

		<div class="pageview type_detail">
			<div class="sec mainphoto_area">
				<!--js配置-->
			</div>
			<div class="sec">
				<ul class="subphoto_area float colum2">
					<!--js配置-->
				</ul>
			</div>
		</div>
		<div class="pageview type_collabo_list">
			<div class="collabo_list">
			<!--js処理-->					
			</div>
		</div>
		<div class="pageview type_owner_data">
			<div class-"userdata">
			
				<p class="s1 h4">住所</p>
				<p class="s2"></p>
				<p class="s3 mb20"></p>
				<p class="s4 h4">電話番号</p>
				<p class="s5 tell_num"></p>
				<p class="s6 tell_time mb20"></p>
				<p class="s7 mb20"><a href=""><img src="images/tel_contact.jpg"></a></p>
				
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCk1EWl9nxBgzZS5FeiMzbQtjjlChviuPU" type="text/javascript"></script>
				<div id="google_map" style="width:100%;height:300px"></div>	
		
			</div>

		</div>
	</div><!--//.content_detail-->


<!--//.wrapper--></div>


<?php include("common/footer.php"); ?>





<script type="text/javascript">
$(function(){

/*
str = "2013-04-25";
str2 = "2013-01-25";
x = Date.parse(str);
y = Date.parse(str2);

console.log(x);
console.log(y);
*/


	//パラメータからコンテンツID取得
	var arg  = new Object;
	url = location.search.substring(1).split('&');
	for(i=0; url[i]; i++) {
		var k = url[i].split('=');
		arg[k[0]] = k[1];
	}
	var contents_id = arg.id;
		
	
	var token=JSession.read("token");
	
	//コンテンツの処理
	var url_method="contents/contents_detail";
	var token=JSession.read("token");
	
	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				id:contents_id,
			},
			success:function(data){
				var result=JSON.parse(data);
				console.log(result);
				
				//一部Jsonパース
				var caption = JSON.parse(result[0]["Contents"].caption);//console.log(caption);			
				var shop_info = JSON.parse(result[0]["Contents"].shop_info);//console.log(caption);	
				
				
				$(".mtitle").text(result[0]["Contents"].title);
				

				//写真内容書き換え					
				var item_count = Object.keys(result).length;			
				for(var i = 1; i < item_count; i++){	
					
					if(i==1){
						$(".copy_base2 .photo img").attr('src',result[i]["Additems"].content);
						//書き換え処理		
						$('.mainphoto_area').append($(".copy_base2").html());
					}
					else{
						$(".copy_base3 .photo img").attr('src',result[i]["Additems"].content);
						//書き換え処理		
						$('.subphoto_area').append($(".copy_base3").html());
					}						
				}				
	
				//詳細内容書き換え
				var caption_array =[
															caption.text1,
															caption.text2,
															caption.text3,
															caption.text4,
															caption.text5,
															caption.ttl1,														
															caption.ttl2,
															caption.ttl3,														
															caption.ttl4,	
															caption.ttl5 
														];

				for(var i = 0; i < 5; i++){		
					if( caption_array[i] != "" ){
						
							$(".copy_base1 .h4").text(caption_array[i+5]);
							$(".copy_base1 .mb20").text(caption_array[i]);
							$('.collabo_list').append($(".copy_base1").html());
						
					}
				}
				

				//店舗情報書き換え
				$(".s2").text("〒"+shop_info.postnumber.substr(0,3)+"-"+shop_info.postnumber.substr(3,4));
				$(".s3").text(shop_info.address1+shop_info.address2);
				$(".s5").text(shop_info.tel);
				$(".s6").text(shop_info.shop_text);	
				
				var tel_number = shop_info.tel.replace( /-/g , "" ) ;　tel_number = tel_number.replace( /─/g , "" ) ;　tel_number = tel_number.replace( /一/g , "" ) ;
				$(".s7 a").attr('href','tel:'+tel_number);	
				
				//newアイコン処理　　　　　
				//更新月が1か月経過でアイコンを消す（1か月：155520000ミリ秒）
				var today_date =new Date();
				var new_icon_date = today_date.getTime() - 155520000;
				var update_date = Date.parse(result[0]["Contents"].refreshdate);
				
				if(new_icon_date > update_date){
					$(".head .type").css('display','none');	
				}
						
				
				//COMTOPIA流Google MAP表示方法
				var geocoder = new google.maps.Geocoder();//Geocode APIを使います。
				var address = "大阪市久太郎町";
				geocoder.geocode({'address': address,'language':'ja'},function(results, status){
					if (status == google.maps.GeocoderStatus.OK){
						var latlng=results[0].geometry.location;//緯度と経度を取得
						var mapOpt = {
										center: latlng,//取得した緯度経度を地図の真ん中に設定
										zoom: 15,//地図倍率1～20
										mapTypeId: google.maps.MapTypeId.ROADMAP//普通の道路マップ
								};
						var map = new google.maps.Map(document.getElementById('google_map'),mapOpt);
						var marker = new google.maps.Marker({//住所のポイントにマーカーを立てる
							position: map.getCenter(),
							map: map
						});
					}else{
						//alert("Geocode was not successful for the following reason: " + status);
					}
				});	
				
			}
		});
	}
	else{
		view_error_page();
	}	
	

});
</script>



	<div class="copy_base1" style="display:none;">
			<p class="h4"></p>
			<p class="mb20"></p>
	</div>

	<div class="copy_base2" style="display:none;">
					<p class="photo"><img src="images/test_img.jpg"></p>
	</div>

	<div class="copy_base3" style="display:none;">
					<li>
							<p class="photo"><img src="images/test_img.jpg"></p>
					</li>
	</div>	



