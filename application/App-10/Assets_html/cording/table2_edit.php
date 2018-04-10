<?php $title="Table2の登録・編集"; ?>
<?php include("common/header.php"); ?>
<div class="body">
	<form class="submit_form">
		<input type="hidden" name="id">
		<div class="absolute_area">
			<div class="tr">
				<div class="t_cell">
					<div class="m10">
						<dl class="form">
							<dt class="need">レコード名</dt>
							<dd>
								<input type="text" name="name" placeholder="">
								<div class="error-message" name="name"></div>

							</dd>
							<dt class="need">項目名AAAA</dt>
							<dd>
								<input type="text" name="colum_a">
								<div class="error-message" name="colum_a"></div>

							</dd>
							<dt class="need">サムネイル画像</dt>
							<dd>
								<div class="mb10">
									<div class="image_w80">
										<img src="images/sample.png" class="image image_output_view">
									</div>
								</div>
								<input type="hidden" name="thumbnail" class="image_output_input">
								<input type="hidden" name="thumbnail_path" class="image_output_path">
								<input type="hidden" name="thumbnail_changed" class="image_output_changed">
								<label for="edit_image" class="buttons new">画像を設定</label>
								<div class="error-message" name="thumbnail"></div>
							</dd>
							<dt>背景画像1</dt>
							<dd>
								<div class="mb20">
									<img src="images/sample.png" class="image background_output_view">
									<div style="background:#f0f0f0;position:relative;height:300px;display:none" class="beforesendview">
										<div class="waiting">
											<div class="icon">
												<p></p>
												<p></p>
												<p></p>
												<p></p>
												<p></p>
												<p></p>
												<p></p>
												<p></p>
												<span>Loading..</span>
											</div>
										</div>
									</div>
									<div class="mm5">
										<label id="background_clear" class="underline">クリア</label>
									</div>
								</div>
								<label for="edit_image_simple" class="buttons new">画像を設定</label>
								<input type="hidden" name="background" class="background_output_input">
								<input type="hidden" name="background_path" class="background_output_path">
								<input type="hidden" name="background_changed" class="background_output_changed">
							</dd>
							<dt>選択項目BBB</dt>
							<dd>
								<label class="select">
									<select name="select_b"></select>
								</label>
							</dd>
							<dt>その他備考欄</dt>
							<dd>
								<textarea name="caption" class="h300"></textarea>
							</dd>
						</dl>
						<div class="error-message total"></div>
					</div>
				</div>
			</div>
			<div class="tr h50 controls">
				<div class="t_cell">
					<ul class="float m5">
						<li><a href="table2_list.php" class="buttons">戻る</a></li>
						<li class="f_right"><input type="submit" value="確認画面へ" class="buttons submit_btn"></li>
					</ul>
				</div>
			</div>
		</div>
	</form>
</div>
<form enctype="multipart/form-data" id="background_buffer_form">
	<input type="hidden" name="access_token" value="" hidden-access_token>
	<input type="file" name="file" class="hidden" id="edit_image_simple">
</form>
<script type="text/javascript">
$(function(){

	//URL LIST...

	var url_imagesimplebuffer="ups/fileup_buffer";
	var url_get_table2="v1/get_table2";
	var url_get_table2_select_b="v1/get_table2_select_b/1";

	var url_submit="v1/edit_table2_pre";
	var url_redirect="table2_confirm.php";

	//初期動作

	//・select_aの選択項目を取得
	var post={
		access_token:JSession.read("token_"+API.authcode)
	};

	$.ajax({
		url:API.domain+url_get_table2_select_b,
		type:"post",
		async:false,
		data:post,
		success:function(htmldata){

			$(".submit_form select[name=select_b]").html(htmldata);
		}
	});

	//SessionからGET
	var post_cash=JSession.read("post_cash");

	if(post_cash!=null){

		$(".submit_form input[name=id]").val(post_cash.id);
		$(".submit_form input[name=name]").val(post_cash.name);
		$(".submit_form input[name=colum_a]").val(post_cash.colum_a);
		$(".submit_form input[name=thumbnail]").val(post_cash.thumbnail);
		$(".submit_form input[name=thumbnail_path]").val(post_cash.thumbnail_path);
		$(".submit_form .image_output_view").attr("src",post_cash.thumbnail_path);
		$(".submit_form input[name=background]").val(post_cash.background);
		$(".submit_form input[name=background_path]").val(post_cash.background_path);
		$(".submit_form select[name=select_b]").val(post_cash.select_b);
		$(".submit_form textarea[name=caption]").val(post_cash.caption);
		$(".submit_form .background_output_view").attr("src",post_cash.background_path);
	}
	else
	{
		var get=Params.get();
		if(get!=null){
			if(get["id"]){

				var post={
					access_token:JSession.read("token_"+API.authcode)
				};

				$.ajax({
					url:API.domain+url_get_table2+"/"+get["id"],
					type:"post",
					data:post,
					success:function(data){
						var result=JSON.parse(data);

						if(result.Table2){
							$(".submit_form input[name=id]").val(result.Table2.id);
							$(".submit_form input[name=name]").val(result.Table2.name);
							$(".submit_form input[name=colum_a]").val(result.Table2.colum_a);
							$(".submit_form input[name=thumbnail]").val(result.Table2.thumbnail);
							$(".submit_form input[name=thumbnail_path]").val(result.Table2.thumbnail_path);
							$(".submit_form .image_output_view").attr("src",result.Table2.thumbnail_path);
							$(".submit_form input[name=background]").val(result.Table2.background);
							$(".submit_form input[name=background_path]").val(result.Table2.background_path);
							$(".submit_form select[name=select_b]").val(result.Table2.select_b);
							$(".submit_form textarea[name=caption]").val(result.Table2.caption);
							$(".submit_form .background_output_view").attr("src",result.Table2.background_path);

						}
					}
				});
			}
		}
	}
	

	//以上、初期設定終わり

	//背景画像選択...
	$("#edit_image_simple").on("change",function(){

		$("*[hidden-access_token]").val(JSession.read("token_"+API.authcode));

		$.ajax({
			url:API.domain+url_imagesimplebuffer,
			type:"post",
			processData:false,
			contentType:false,
			async:true,
			data:new FormData($("#background_buffer_form").get(0)),
			beforeSend:function(){
				$(".background_output_view").css("display","none");
				$(".beforesendview").css("display","");
			},
			success:function(data){
				var result=JSON.parse(data);
				$(".beforesendview").css("display","none");
				$(".background_output_view").css("display","");
				$(".background_output_view").attr("src",result.path+"?"+result.uniqId);
				$(".background_output_input").val(result.tag);
				$(".background_output_path").val(result.path);
				$(".background_output_changed").val(1);
			}
		});
	});

	//背景画像クリア
	$("#background_clear").on("click",function(){
		$(".background_output_view").attr("src","images/sample.png");
		$(".background_output_input").val("");
		$(".background_output_path").val("");
		$(".background_output_changed").val(0);
	});

	//SUBMIT....
	$(".submit_btn").on("click",function(){

		$(".error-message").removeClass("active").text("");

		var post=$(".submit_form").Formdat();
		post.access_token=JSession.read("token_"+API.authcode);

		$.ajax({
			url:API.domain+url_submit,
			type:"post",
			data:post,
			success:function(data){
				var result=JSON.parse(data);

				if(result.mode==200){
					JSession.write("post_cash",result.cash.Table2);
					location.href=url_redirect;
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
</script>
<?php include("part/edit_image.php"); ?>
<?php include("common/footer.php"); ?>