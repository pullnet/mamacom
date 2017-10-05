$(function(){
	//ここからコンテンツ追加フォーム(popup)

	//コンテンツ追加フォーム内のバッファリセット
	function contentform_reset(){
		$("#dat_type").val("");
		$("#dat_index").val("");
		$("#dat_tag").val("");
		$("#dat_image_url").val("");
		$("#image_review").attr("src",$("#index_defaultimageurl").text());
		$("#image_upload_form #file").val("");
		$("#movie_url").val("");
		$("#movie_preview").attr("src","");
		$("#web_url").val("");
		$("#web_review").attr("src",$("#index_defaultimageurl_notfound").text());
		$("#openstatus0").prop("checked","checked");
		$("#openstatus1").prop("checked","");
		$("#openstatus2").prop("checked","");
		$("#openstatus3").prop("checked","");
		$("#commentarea").val("");

	}
	//サムネイルのフォームを開く
	$("#open_thumbnail").on("click",function(){
		//フォーム内のリセット処理用
		contentform_reset();

		//フォームのタイトルを変更
		$("#contentform_title").text("サムネイル編集フォーム");
		$("#contentsform_typeindex").val($("#thumbnail_contents_type").val())	;//コンテンツ形式
		$("#dat_tag").val($("#thumbnail_content").val());//コンテンツURL・タグ番号
		$("#oepnstatus").val($("#thumbnail_open_status").val());//公開ステータス

		//コメント記入欄をオミット
		$("#commentfield").css("display","none");

		//現サムネイル情報をフォームにセット
		if($("#thumbnail_contents_type").val()==0)
		{
			//画像の場合
			$("#contentsform_typeindex").val(0);
			$("#sth_001").prop("checked","checked");
			$("#sth_002").prop("checked","");
			$("#sth_003").prop("checked","");

			//現画像を画像をプレビュー
			if($("#thumbnail_content").val())
			{
				$("#image_review").attr("src",$("#index_itemreadurl").text()+"/"+$("#thumbnail_content").val());
			}
		}
		else if($("#thumbnail_contents_type").val()==1)
		{
			//動画の場合
			$("#contentsform_typeindex").val(1);
			$("#sth_001").prop("checked","");
			$("#sth_002").prop("checked","checked");
			$("#sth_003").prop("checked","");

			//動画をプレビュー
			if($("#thumbnail_content").val())
			{
				$("#movie_url").val($("#thumbnail_content").val());
				$("#movie_preview").attr("src",$("#thumbnail_content").val());
			}
		}
		else if($("#thumbnail_contents_type").val()==2)
		{
			//web画像の場合
			$("#contentsform_typeindex").val(2);
			$("#sth_001").prop("checked","");
			$("#sth_002").prop("checked","");
			$("#sth_003").prop("checked","checked");

			//$web画像をプレビュー
			if($("#thumbnail_content").val())
			{
				$("#web_url").val($("#thumbnail_content").val());
				$("#web_review").attr("src",$("#thumbnail_content").val());

			}
		}
	});

	//コンテンツ形式のタブを押したとき
	//画像の場合
	$("#sth_001").on("click",function(){
		$("#contentsform_typeindex").val(0);
	});
	$("#sth_002").on("click",function(){		
		$("#contentsform_typeindex").val(1);
	});
	$("#sth_003").on("click",function(){
		$("#contentsform_typeindex").val(2);
	});


	//追加コンテンツのフォームを開く
	$("body").on("click",".open_addcontents",function(){

		//フォーム内のリセット処理用
		contentform_reset();
		//追加コンテンツのインデックス番号を取得
		var c_index=$(this).attr("adc_index");

		//フォームタイトルを変更
		$("#contentform_title").text("追加コンテンツフォーム_"+c_index);
		$("#dat_type").val(1); 									//コンテンツ形式は追加コンテンツ
		$("#dat_index").val(c_index); 								//インデックス番号を設置
		$("#contentsform_typeindex").val($(".addcontents_type[adc_index="+c_index+"]").val());	//コンテンツ形式
		$("#dat_tag").val($(".addcontents_content[adc_index="+c_index+"]").val());			//コンテンツURL・タグ番号
		$("#oepnstatus").val($(".addcontents_open_status[adc_index="+c_index+"]").val());		//公開ステータス

		//コメント記入欄をオミットを解除+コメントがあれば入れる
		$("#commentfield").css("display","");
		$("#commentarea").val($(".addcontents_comment[adc_index="+c_index+"]").val());



		//現追加コンテンツ情報をフォームにセット
		if($(".addcontents_contents_type[adc_index="+c_index+"]").val()==0)
		{
			//画像の場合
			$("#contentsform_typeindex").val(0);
			$("#sth_001").prop("checked","checked");
			$("#sth_002").prop("checked","");
			$("#sth_003").prop("checked","");

			//現画像を画像をプレビュー
			if($(".addcontents_content[adc_index="+c_index+"]").val())
			{
				$("#image_review").attr("src",$("#index_itemreadurl").text()+"/"+$(".addcontents_content[adc_index="+c_index+"]").val());
			}
		}
		if($(".addcontents_contents_type[adc_index="+c_index+"]").val()==1)
		{
			//動画の場合
			$("#contentsform_typeindex").val(1);
			$("#sth_001").prop("checked","");
			$("#sth_002").prop("checked","checked");
			$("#sth_003").prop("checked","");

			//動画をプレビュー
			if($(".addcontents_content[adc_index="+c_index+"]").val())
			{
				$("#movie_url").val($(".addcontents_content[adc_index="+c_index+"]").val());
				$("#movie_preview").attr("src",$(".addcontents_content[adc_index="+c_index+"]").val());
			}
		}
		if($(".addcontents_contents_type[adc_index="+c_index+"]").val()==2)
		{
			//web画像の場合
			$("#contentsform_typeindex").val(2);
			$("#sth_001").prop("checked","");
			$("#sth_002").prop("checked","");
			$("#sth_003").prop("checked","checked");

			//$web画像をプレビュー
			if($(".addcontents_content[adc_index="+c_index+"]").val())
			{
				$("#web_url").val($(".addcontents_content[adc_index="+c_index+"]").val());
				$("#web_review").attr("src",$(".addcontents_content[adc_index="+c_index+"]").val());

			}
		}

	});
	//追加コンテンツを削除
	$("body").on("click","#delete_contents",function(){
		//追加コンテンツのインデックス番号を取得
		var c_index=$(this).attr("adc_index");
		//コンテンツのタグを削除
		$(".addcontentslist .item[adc_index="+c_index+"]").animate({"opacity":0},300,function(){
			$(".addcontentslist .item[adc_index="+c_index+"]").remove();
			//配置をリフレッシュ
			pibox3_refresh(params);
		});
		
		//フィールドタグ情報も削除(はしない)
		//$(".field[adc_index="+c_index+"]").remove();
		
		//フィールドタグの削除ステータスをtrueに
		$(".addcontents_deletestatus[adc_index="+c_index+"]").val(true);

		return false;
	});


	//フォーム処理

	//画像を選択した場合、
	$("#image_upload_form #file").change(function(){
		//AJAXで画像のバッファを作成する
		$.ajax({
			url:$("#index_buffersave").text(),
			method: "POST",
			data:new FormData($("#image_upload_form").get(0)),
			processData: false,
			contentType: false,
			success: function(data) {
				var result=JSON.parse(data);
				var dst=new Date();

				//バッファの画像を確認
				$("#image_review").attr("src",result.url+"?"+dst.getTime());
				$("#dat_tag").val(result.number);
				$("#dat_image_url").val(0);//画像URLステータスをバッファーに変更
			},

		});
	});
	//ドラッグアンドドロップした場合も(したいのだができない..)
	$("#image_upload_form #file").on("drop",function(event, ui){
		console.log("ドロップされました");
		return false;
	});

	//動画URLを入力した場合
	$("#movie_url").change(function(){
		//youtube動画を読み込む(一旦embedのurlに変換)
		var url_b=$(this).val();
		//動画の識別コードを読み取る
		var url_code=url_b.split("/")[url_b.split("/").length-1];
		var url="https://www.youtube.com/embed/"+url_code;
		
		//動画をプレビュー
		$('#movie_preview').attr("src",url);
		$("#dat_tag").val(url);
	});
	//画像URLを入力した場合
	$("#web_url").change(function(){
		//youtube動画を読み込む(一旦embedのurlに変換)
		var url=$(this).val();

		//web画像をプレビュー
		$('#web_review').attr("src",url);
		$("#dat_tag").val(url);

	});


	//コンテンツ情報を適用
	$("#submit_btn").on("click",function(){

		if($("#dat_type").val()==0)
		{
			//サムネイルの場合
			$("#thumbnail_contents_type").val($("#contentsform_typeindex").val());//コンテンツ形式
			$("#thumbnail_content").val($("#dat_tag").val());//コンテンツURL・タグ番号
			$("#thumbnail_movie_stauts").val(0);//動画ステータス(※現状youtubeしか対応できないので今は固定)
			$("#thumbnail_open_status").val(check_openstatus());//公開ステータス
		
			//画像の場合
			if($("#thumbnail_contents_type").val()==0)
			{
				if($("#thumbnail_content").val())
				{
					$("#thumbnail_image").attr("src",$("#index_itemreadurl").text()+"/"+$("#thumbnail_content").val());
					$("#thumbnail_image").css("display","block");
					$("#thumbnail_movie").css("display","none");
				}
			}
			//動画の場合
			else if($("#thumbnail_contents_type").val()==1)
			{
				if($("#thumbnail_content").val())
				{
					$("#thumbnail_image").css("display","none");
					$("#thumbnail_movie").css("display","");
					$("#thumbnail_movie_i").attr("src",$("#thumbnail_content").val());
				}
			}
			//web画像の場合
			else if($("#thumbnail_contents_type").val()==2)
			{
				if($("#thumbnail_content").val())
				{
					$("#thumbnail_image").css("display","");
					$("#thumbnail_movie").css("display","none");
					$("#thumbnail_image").attr("src",$("#thumbnail_content").val());
				}
			}

			//公開ステータス用タグの変更(classだけ)
			if($("#thumbnail_open_status").val()==0)
			{
				$(".thumbnail_openstatusview").addClass("all");
				$(".thumbnail_openstatusview").removeClass("not useronly memberonly");
			}
			if($("#thumbnail_open_status").val()==1)
			{
				$(".thumbnail_openstatusview").addClass("useronly");
				$(".thumbnail_openstatusview").removeClass("all not memberonly");
			}
			if($("#thumbnail_open_status").val()==2)
			{
				$(".thumbnail_openstatusview").addClass("memberonly");
				$(".thumbnail_openstatusview").removeClass("all useronly not");
			}
			if($("#thumbnail_open_status").val()==3)
			{
				$(".thumbnail_openstatusview").addClass("not");
				$(".thumbnail_openstatusview").removeClass("all useronly memberonly");
			}

		}
		else if($("#dat_type").val()==1)
		{
			//追加コンテンツの場合
			var c_index=$("#dat_index").val();

			$(".addcontents_contents_type[adc_index="+c_index+"]").val($("#contentsform_typeindex").val());//コンテンツ形式
			$(".addcontents_content[adc_index="+c_index+"]").val($("#dat_tag").val());//コンテンツURL・タグ番号
			$(".addcontents_movie_stauts[adc_index="+c_index+"]").val(0);//動画ステータス(※現状youtubeしか対応できないので今は固定)
			$(".addcontents_open_status[adc_index="+c_index+"]").val(check_openstatus());//公開ステータス
			$(".addcontents_comment[adc_index="+c_index+"]").val($("#commentarea").val());//コメント

			//画像の場合
			if($(".addcontents_contents_type[adc_index="+c_index+"]").val()==0)
			{
				if($(".addcontents_content[adc_index="+c_index+"]").val())
				{
					$(".item[adc_index="+c_index+"] .addcontents_image").attr("src",$("#index_itemreadurl").text()+"/"+$(".addcontents_content[adc_index="+c_index+"]").val());
					$(".item[adc_index="+c_index+"] .addcontents_image").css("display","block");
					$(".item[adc_index="+c_index+"] .addcontents_movie").css("display","none");
				}
			}
			//動画の場合
			else if($(".addcontents_contents_type[adc_index="+c_index+"]").val()==1)
			{
				if($(".addcontents_content[adc_index="+c_index+"]").val())
				{
					$(".item[adc_index="+c_index+"] .addcontents_image").css("display","none");
					$(".item[adc_index="+c_index+"] .addcontents_movie").css("display","");
					$(".item[adc_index="+c_index+"] .addcontents_movie_i").attr("src",$(".addcontents_content[adc_index="+c_index+"]").val());
				}
			}
			//web画像の場合
			else if($(".addcontents_contents_type[adc_index="+c_index+"]").val()==2)
			{
				if($(".addcontents_content[adc_index="+c_index+"]").val())
				{
					$(".item[adc_index="+c_index+"] .addcontents_image").css("display","");
					$(".item[adc_index="+c_index+"] .addcontents_movie").css("display","none");
					$(".item[adc_index="+c_index+"] .addcontents_image").attr("src",$(".addcontents_content[adc_index="+c_index+"]").val());
				}
			}

			//公開ステータス用タグの変更(classだけ)
			if($(".addcontents_open_status[adc_index="+c_index+"]").val()==0)
			{
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").addClass("all");
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").removeClass("not useronly memberonly");
			}
			else if($(".addcontents_open_status[adc_index="+c_index+"]").val()==1)
			{
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").addClass("useronly");
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").removeClass("all not memberonly");
			}
			else if($(".addcontents_open_status[adc_index="+c_index+"]").val()==2)
			{
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").addClass("memberonly");
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").removeClass("all useronly not");
			}
			else if($("addcontents_open_status[adc_index="+c_index+"]").val()==3)
			{
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").addClass("not");
				$(".item[adc_index="+c_index+"] .addcontents_openstatusview").removeClass("all useronly memberonly");
			}


			//コメントの追加
			var commentstr = $("#commentarea").val();
			commentstr=commentstr.replace(/</g,"＜").replace(/>/g,"＞").replace(/\r?\n/g, '<br>');//表示用は改行コードを入れる,ついでに最低限のサニタイズ処理を
			$(".item[adc_index="+c_index+"] .comment_view").html(commentstr);
			if(commentstr)
			{
				$(".item[adc_index="+c_index+"] .comment_view").css({
					"margin-bottom":"45px",
					"padding":"0px 10px",
				});
			}
			else
			{
				$(".item[adc_index="+c_index+"] .comment_view").css({
					"margin-bottom":"",
					"padding":"",
				});

			}


		}

		var sis=setInterval(
		function(){
			pibox3_refresh(params);
			clearInterval(sis);
		},300);

		$("#pol0001").click();
	});

	//公開ステータス判定
	function check_openstatus()
	{
		if($("#openstatus0").prop("checked"))
		{
			return 0;
		}
		else if($("#openstatus1").prop("checked"))
		{
			return 1;
		}
		else if($("#openstatus2").prop("checked"))
		{
			return 2;
		}
		else if($("#openstatus3").prop("checked"))
		{
			return 3;
		}
	}

	//追加コンテンツを追加
	var contentindex=$("#hidden_additem .field").length;
	$("#btn_addcontents_add").on("click",function(){
		contentindex++;//インクリメント
		$(".addcontentslist").append('<div class="item" adc_index="'+contentindex+'">'+$("#open_addcontents_source").html()+"</div>");
		$(".item[adc_index="+contentindex+"] .labels").attr("adc_index",contentindex);
		$(".item[adc_index="+contentindex+"] .deletecontents_btn").attr("adc_index",contentindex);

		//インデックスが2つ以上の場合は、データ保持用のhiddenタグを別途作成しないといけなくなる....。
		if(contentindex>=2)
		{
			var addtag='\<div class="field" adc_index="'+contentindex+'"><input type="hidden" name="data[Additem]['+contentindex+'][id]" class="addcontents_id" adc_index='+contentindex+' id="Additems1Id"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][content_id]" class="addcontents_content_id" adc_index='+contentindex+' id="Additems1ContentId"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][type]" value="0" class="addcontents_type" adc_index='+contentindex+' id="Additems1Type"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][contents_type]" class="addcontents_contents_type" adc_index='+contentindex+' id="Additems1ContentsType"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][content]" class="addcontents_content" adc_index='+contentindex+' id="Additems1Content"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][movie_stauts]" class="addcontents_movie_stauts" adc_index='+contentindex+' id="Additems1MovieStauts"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][open_status]" class="addcontents_open_status" adc_index='+contentindex+' id="Additems1OpenStatus"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][comment]" class="addcontents_comment" adc_index='+contentindex+' id="Additems1comment"/>\
			<input type="hidden" name="data[Additem]['+contentindex+'][shortimgtag]">\
			<input type="hidden" name="data[Additem]['+contentindex+'][deletestatus]" class="addcontents_deletestatus" adc_index='+contentindex+' id="Additems1deletestatus" value="false" />\
			</div>';
			$("#hidden_additem").append(addtag);

		}

		//配置をリフレッシュ
		pibox3_refresh(params);
	});
});