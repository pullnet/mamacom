<?php $title="お問い合わせ";?>
<?php $active_contact = true;?>
<?php include("common/header.php"); ?>

<style>

</style>

<div class="lp_contact">
	<a href="index.php"><h2 class="mtitle">各種お問い合わせ</h2></a>
	
	<form action="/inquiry/contact" id="ContactContactForm" method="post" accept-charset="utf-8">
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
				<td><input name="data[Contact][mailaddress]" class="short" placeholder="例) mamacom@email.co.jp" type="text" id="ContactMailaddress"/>
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
			<input class="buttons big add" type="submit" value="お問い合わせする"/>
		</div>
	</form>
</div>
<?php include("common/footer.php"); ?>
