<?php $title="お問い合わせ";?>
<?php $active_contact = true;?>
<?php include("common/header.php"); ?>

<style>

</style>



<div class="lp_contact step1">
	<a href="index.php"><h2 class="mtitle">各種お問い合わせ</h2></a>
	
	<form action="" id="ContactContactForm" method="post" accept-charset="utf-8">
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST"/>
		</div>
		<p class="h3">こちらからお問い合わせできます。</p>
		<table cellspacing="0" cellpadding="0" class="">
			<tr>
				<th colspan="2" class="stitle">お問い合わせ内容</th>
			</tr>
			<tr>
				<th>お名前</th>
				<td> 姓
					<input name="data[Contact][name_sei]" class="mini" placeholder="例) 山田" type="text" id="ContactNameSei"/>
					名
					<input name="data[Contact][name_mei]" class="mini" placeholder="例) 太郎" type="text" id="ContactNameMei"/>
				</td>
			</tr>
			<tr>
				<th class="">お名前(フリガナ)</th>
				<td> 姓
					<input name="data[Contact][name_sei_kana]" class="mini" placeholder="例) ヤマダ" type="text" id="ContactNameSeiKana"/>
					名
					<input name="data[Contact][name_mei_kana]" class="mini" placeholder="例) タロウ" type="text" id="ContactNameMeiKana"/>
				</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td><input name="data[Contact][mailaddress]" class="mb10" placeholder="例) mamacom@email.co.jp" type="text" id="ContactMailaddress"/>
					<p>※お問い合わせ後の返答先として利用いたします。</p></td>
			</tr>
			<tr>
				<th>お問い合わせ件名</th>
				<td><input name="data[Contact][subject]" class="middle" type="text" id="ContactSubject"/>
				</td>
			</tr>
			<tr>
				<th>お問い合わせ内容</th>
				<td><textarea name="data[Contact][message]" class="high_2" id="ContactMessage"></textarea>
				</td>
			</tr>
		</table>
		<div class="center mb30">
			<input class="buttons big add" type="submit" value="お問い合わせする" />
		</div>
	</form>
</div>


<div class="lp_contact step2" style="display:none">

	<a href="index.php"><h2 class="mtitle">各種お問い合わせ確認画面</h2></a>
	
	<form action="" id="ContactContactForm2" method="post" accept-charset="utf-8">
		<div style="display:none;">
		<input type="hidden" name="_method" value="POST"/>
		</div>
		<p class="h3">以下のお問い合わせ内容でよろしいでしょうか？</p>
		<table cellspacing="0" cellpadding="0" class="">
			<tr>
				<th colspan="2" class="stitle">お問い合わせ内容</th>
			</tr>
			<tr>
				<th>お名前</th>
				<td>○○ ○○様
				</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>○○○○○○○○○○○○○</td>
			</tr>
			<tr>
				<th>お問い合わせ件名</th>
				<td>○○○○○○○○○○○○○</td>
			</tr>
			<tr>
				<th>お問い合わせ内容</th>
				<td>○○○○○○○○○○○○○○○○○○○○○○○○○○</td>
			</tr>
		</table>
		<div class="center mb30">
			<input class="buttons add" type="submit" value="お問い合わせする" />
			<button class="buttons" type="submit" value="お問い合わせする"></button>
		</div>
	</form>
</div>

<?php include("common/footer.php"); ?>




<script type="text/javascript">

$('#ContactContactForm').submit(function(event) {
	
	// HTMLでの送信をキャンセル
	event.preventDefault();
	
	// フォームの値格納
	var post_name1 = $('#ContactNameSei').val();
	var post_name2 = $('#ContactNameMei').val();	
	var post_name3 = $('#ContactNameSeiKana').val();
	var post_name4 = $('#ContactNameMeiKana').val();
	var post_mail = $('#ContactMailaddress').val();	
	var post_subject = $('#ContactSubject').val();
	var post_text = $('#ContactMessage').val();
	
	//APIへポスト処理
	var url_method="contact/contact_step1";
	var token=JSession.read("token");

	if(token!=null){
		$.ajax({
			url:API.domain+url_method,
			type:"post",
			data:{
				send_token:token,
				post_subject:post_subject,
				post_name1:post_name1,
				post_name2:post_name2,
				post_name3:post_name3,
				post_name4:post_name4,								
				post_mail:post_mail,
				post_text:post_text,
			},
			success:function(data){
				
				var result=JSON.parse(data);
				//console.log(result);
				
				var a=result.errors;
				console.log(a);
				
				
				var b=JSON.parse(data);
				
				if(result.enable){
					$(".step2").css('display','block');
				}
				else{
					console.log("test");
				}

			}
		});
	}
	else{
		view_error_page();
	}		
	
		
});


</script>








