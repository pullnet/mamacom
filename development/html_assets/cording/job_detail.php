<?php $title="コラボ詳細";?>
<?php include("common/header.php"); ?>


<div class="wrapper">

	<div class="content_detail" style="position:fixed;width:100%;z-index:100">
		<a href="javascript:history.back();"><h1 class="mtitle"></h1></a>
	</div><!--//.content_detail-->

</div>
<div style="height:50px"></div>

<div class="waiting"></div>
<div class="slide_page hidden">
	<div class="tab">
		<ul class="float">
			<li><a href="#" data-slide-index="0"><label for="content_detail" class="detail">写真</label></a></li>
			<li><a href="#" data-slide-index="1"><label for="collabo_list" class="collabo">詳細説明</label></a></li>
			<li><a href="#" data-slide-index="2"><label for="owner_data" class="owner">会社情報</label></a></li>
		</ul>
	</div>
	<ul class="pages">
		<li class="sec">
			<div class="bs0">
				<div id="html_sample001">
                
                
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
                
                </div>
			</div>
		</li>
		<li class="sec">
			<div class="bs0">
				<div id="html_sample002">
                
                              <div class="pageview type_collabo_list">
                                  <div class="collabo_list">
                                  <!--js処理-->					
                                  </div>
                              </div>   
                               
                </div>
			</div>
		</li>
		<li class="sec">
			<div class="bs0">
				<div id="html_sample003">
                      
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
                
                </div>
			</div>
		</li>
	</ul>
</div>


<script type="text/javascript" src="js/jquery.bxslider.js"></script>
<script type="text/javascript" src="js/slide_MN_04.js"></script>



<style>
.slide_page .tab li label {
    display: block;
    font-size: 16px;
    border-bottom: solid 1px #fff;
    color: #FF6486;
    padding: 8px 0px;
    text-align: center;
}

.slide_page .tab .float li{
    width: 33.3%;
    margin: 0 0% 0px;
}

.slide_page .tab li a.active label{
    border-bottom: solid 1px #FF6486;
}

.slide_page .h4 {
    font-size: 14px;
    padding: 5px;
    margin-bottom: 10px;
    color: #950;
    border: solid 1px #950;
    text-align: center;
}

.slide_page p{
    font-size: 14px;
    color: #950;
}

.slide_page .pageview {
    margin: 4%;
}
</style>

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

				$(".slide_page").animate({
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
						$(".copy_base1 .mb20").html(nl2br(caption_array[i]));
						$('.collabo_list').append($(".copy_base1").html());
					}
				}

				
				//店舗情報書き換え
				if('address2' in shop_info){
					$(".s2").text("〒"+shop_info.postnumber.substr(0,3)+"-"+shop_info.postnumber.substr(3,4));
					$(".s3").text(shop_info.address1+shop_info.address2);				
				}
				else{
					$('.s1 , .s2 , .s3 ').css('display','none');
				}

				if('tel' in shop_info){
					$(".s5").text(shop_info.tel);				
					var tel_number = shop_info.tel.replace( /-/g , "" ) ;　tel_number = tel_number.replace( /─/g , "" ) ;　tel_number = tel_number.replace( /一/g , "" ) ;
					var tel_number = shop_info.tel;
					$(".s7 a").attr('href','tel:'+tel_number);
				}
				else{
					$('.s4 , .s5 , .s6 , .s7 ').css('display','none');
				}
				
				if('shop_text' in shop_info){
					$(".s6").text(shop_info.shop_text);	
				}
				
				//newアイコン処理　　　　　
				//更新月が1か月経過でアイコンを消す（1か月：155520000ミリ秒）
				var today_date =new Date();
				var new_icon_date = today_date.getTime() - 155520000;
				var update_date = Date.parse(result[0]["Contents"].refreshdate);
				
				if(new_icon_date > update_date){
					$(".head .type").css('display','none');	
				}

				//検索用に一旦住所格納		
				$('.copy_address').text(shop_info.address1+shop_info.address2);
				
				map_create();
				
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

	<div class="copy_address" style="display:none;"></div>
	

<script type="text/javascript">

function map_create(){
	
		var address = $('.copy_address').text();
		
		//console.log(address);
		var geocoder = new google.maps.Geocoder();//Geocode API
		
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

/*
//タブクリックでgoogleマップ表示
$('.owner').on('click',function(){
	map_create();
});
*/

</script>

<?php include("common/footer.php"); ?>