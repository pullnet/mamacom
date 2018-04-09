<?php $title="Table1の登録・編集"; ?>
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
								<input type="text" name="name">
								<div class="error-message" name="name"></div>
							</dd>
							<dt class="need">項目名AAA</dt>
							<dd>
								<input type="text" name="colum_a1" claas="w150">
								<div class="error-message" name="colum_a1"></div>
							</dd>
							<dt>項目名BBB</dt>
							<dd>
								<input type="text" name="colum_a2">
							</dd>
							<dt>設定</dt>
							<dd>
								<div id="swradio" class="colum2">
									<input type="radio" name="status" value="1" id="sw0001" checked>
									<label for="sw0001">一般公開</label>
									<input type="radio" name="status" value="2" id="sw0002">
									<label for="sw0002">公開しない</label>
								</div>
							</dd>
							<dt>その他説明</dt>
							<dd>
								<textarea name="caption" class="h200"></textarea>
							</dd>
						</dl>
						<div class="error-message total"></div>
					</div>
				</div>
			</div>
			<div class="tr h50 controls">
				<div class="t_cell">
					<ul class="float m5">
						<li><a href="table1_list.php" class="buttons">戻る</a></li>
						<li class="f_right"><input type="submit" value="レコードを登録する" class="buttons submit_btn"></li>
					</ul>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(function(){

	//URL LIST..
	var url_get_table1="v1/get_table1";
	var url_submit="v1/edit_table1";
	var url_redirect="table1_list.php";

	var get=Params.get();
	if(get!=null){
		if(get["id"]){
			var post={
				access_token:JSession.read("token_"+API.authcode)
			};

			$.ajax({
				url:API.domain+url_get_table1+"/"+get["id"],
				type:"post",
				data:post,
				success:function(data){
					var result=JSON.parse(data);
					
					if(result.Table1){
						$("input[name=id]").val(result.Table1.id);
						$("input[name=name]").val(result.Table1.name);
						$("input[name=colum_a1]").val(result.Table1.colum_a1);
						$("input[name=colum_a2]").val(result.Table1.colum_a2);
						$("input[name=status]").val([result.Table1.status]);
						$("textarea[name=caption]").val(result.Table1.caption);
					}
				}
			});
		}
	}

	//SUBMIT
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
					//go next
					if(result.message){
						JSession.write("alert",result.message);
					}
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
<?php include("common/footer.php"); ?>