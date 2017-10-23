<?php $title="お問い合わせ";?>
<?php $active_contact = true;?>
<?php include("common/header.php"); ?>


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
				<th class="need">お名前</th>
				<td><p class="erorr_name"></p>
						姓
						<input name="data[Contact][name_sei]" class="mini" placeholder="例) 山田" type="text" id="ContactNameSei"/>
						名
						<input name="data[Contact][name_mei]" class="mini" placeholder="例) 太郎" type="text" id="ContactNameMei"/>
						
				</td>
			</tr>
			<tr>
				<th class="">お名前(フリガナ)</th>
				<td>姓
						<input name="data[Contact][name_sei_kana]" class="mini" placeholder="例) ヤマダ" type="text" id="ContactNameSeiKana"/>
						名
						<input name="data[Contact][name_mei_kana]" class="mini" placeholder="例) タロウ" type="text" id="ContactNameMeiKana"/>
				</td>
			</tr>
			<tr>
				<th class="need">メールアドレス</th>
				<td><p class="erorr_mail"></p>
					<input name="data[Contact][mailaddress]" class="mb10" placeholder="例) mamacom@email.co.jp" type="text" id="ContactMailaddress"/>
					<p>※お問い合わせ後の返答先として利用いたします。</p></td>
			</tr>
			<tr>
				<th class="need">お問い合わせ件名</th>
				<td><p class="erorr_subject"></p>
					<input name="data[Contact][subject]" class="middle" type="text" id="ContactSubject"/>
				</td>
			</tr>
			<tr>
				<th class="need">お問い合わせ内容</th>
				<td><p class="erorr_text"></p>
					<textarea name="data[Contact][message]" class="high_2" id="ContactMessage"></textarea>
				</td>
			</tr>
		</table>
		<div class="center mb30">
			<input class="buttons big add" type="submit" value="お問い合わせする" />
		</div>
	</form>
</div>


<div class="lp_contact step2" style="display:none">

	<a href="index.php"><h2 class="mtitle">お問い合わせ確認画面</h2></a>
	
	<form action="" id="ContactContactForm2" method="post" accept-charset="utf-8">
		<div style="display:none;">
		<input type="hidden" name="_method" value="POST"/>
		</div>
		<p class="h3">内容のご確認</p>
		<table cellspacing="0" cellpadding="0" class="">
			<tr>
				<th colspan="2" class="stitle">ご入力頂いた内容に誤りがないかご確認下さい。</th>
			</tr>
			<tr>
				<th>お名前</th>
				<td id="name12_text" class="fl"></td>
			</tr>
			<tr>
				<th>フリガナ</th>
				<td id="name34_text" class="fl"></td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td id="mail_text" class="fl"></td>
			</tr>
			<tr>
				<th>お問い合わせ件名</th>
				<td id="subject_text" class="fl"></td>
			</tr>
			<tr>
				<th>お問い合わせ内容</th>
				<td id="main_text" class="fl"></td>
			</tr>
		</table>
		<div class="center mb30 f0">
			<div class="buttons col2" id="cancel_b">入力画面に戻る</div>
			<input class="buttons add col2" type="submit" value="この内容で送信する" />
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
				console.log(result);
				
				var e=result.errors;
				
				if(result.enable){ //成功
					$(".step2").css('display','block');
					$(".step1").css('display','none');
					$('body, html').animate({ scrollTop: 0 }, 0);
					$('#name12_text').text(post_name1+' '+post_name2+' 様');
					$('#mail_text').text(post_mail);
					$('#subject_text').text(post_subject);
					$('#main_text').text(post_text);
					if(post_name3=="" && post_name4==""){ //フリガナは任意
						$('#name34_text').css('display','none');
						$('#name34_text').text(post_name3+' '+post_name4+' 様');
					}else{
						$('#name34_text').css('display','block');
						$('#name34_text').text(post_name3+' '+post_name4+' 様');
					}
				}
				else{ //エラー
					$(".step1").css('display','block');
					$(".step2").css('display','none');
					
					//設置済みメッセージ一旦非表示
					$(".erorr_name").css('display','none');
					$(".erorr_mail").css('display','none');
					$(".erorr_subject").css('display','none');
					$(".erorr_text").css('display','none');

					//エラーメッセージがオブジェクトに存在している場合表示
					if('post_name1' in e) {
						$(".erorr_name").css('display','block');
						$(".erorr_name").html(e.post_name1);
					}
					if('post_name2' in e) {
						$(".erorr_name").css('display','block');
						$(".erorr_name").html(e.post_name2);
					}					
					if('post_mail' in e) {
						$(".erorr_mail").css('display','block');
						$(".erorr_mail").html(e.post_mail);
					}
					if('post_subject' in e) {
						$(".erorr_subject").css('display','block');
						$(".erorr_subject").html(e.post_subject);
					}	
					if('post_text' in e) {
						$(".erorr_text").css('display','block');
						$(".erorr_text").html(e.post_text);
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


<script type="text/javascript">
//step2処理
$('#ContactContactForm2').submit(function(event) {
	
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
	var url_method="contact/contact_step2";
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
				console.log(result);
				
				var e=result.errors;
				
				if(result.enable){ //成功
					location.href="contact_complete.php";
				}
				else{
					$(".step1").css('display','block');
					$(".step2").css('display','none');
					
					//設置済みメッセージ一旦非表示
					$(".erorr_name").css('display','none');
					$(".erorr_mail").css('display','none');
					$(".erorr_subject").css('display','none');
					$(".erorr_text").css('display','none');

					//エラーメッセージがオブジェクトに存在している場合表示
					if('post_name1' in e) {
						$(".erorr_name").css('display','block');
						$(".erorr_name").html(e.post_name1);
					}
					if('post_name2' in e) {
						$(".erorr_name").css('display','block');
						$(".erorr_name").html(e.post_name2);
					}					
					if('post_mail' in e) {
						$(".erorr_mail").css('display','block');
						$(".erorr_mail").html(e.post_mail);
					}
					if('post_subject' in e) {
						$(".erorr_subject").css('display','block');
						$(".erorr_subject").html(e.post_subject);
					}	
					if('post_text' in e) {
						$(".erorr_text").css('display','block');
						$(".erorr_text").html(e.post_text);
					}	
				}
			}
		});
	}
	else{
		view_error_page();
	}	
});

$('#cancel_b').on('click',function() {
		$(".step1").css('display','block');
		$(".step2").css('display','none');
	
		//設置済みメッセージ一旦非表示
		$(".erorr_name").css('display','none');
		$(".erorr_mail").css('display','none');
		$(".erorr_subject").css('display','none');
		$(".erorr_text").css('display','none');
		$('body, html').animate({ scrollTop: 0 }, 0);

});
</script>

<style>
.erorr_text,
.erorr_name,
.erorr_mail,
.erorr_subject{
	color:#F00;
	border:solid 1px #F00;
	padding:2px 8px;
	display:none;
	margin:-5px 0 5px;
}
.buttons {
    background: #e81;
    color: #FFF;
    display: block;
    line-height: 20px;
    padding: 2px 5px;
    text-align: center;
    border: solid 3px #e81;
    /* margin-bottom: 5px; */
    font-size: 12px !important;
    border-radius: 5px;
    width: 100%;
    margin-top: 5px;
}
input::-webkit-input-placeholder{
  color: #CCC;
}
.col2,
input.buttons.col2{
    width: 49.4% !important;
    margin: 0.3% !important;
    display: inline-block;
    vertical-align: top;
    font-size: 14px !important;
}
.f0{
font-size:0;
}
.fl{
font-size:130%;
}

</style>








