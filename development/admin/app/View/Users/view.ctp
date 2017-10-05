<style>
.pr_html h1,
.pr_html h2,
.pr_html h3{
	background:none;
	border:none;
	text-align:left;
	font-weight:normal;
}
.pr_html h1{
	font-size:30px;
}
.pr_html h2{
	font-size:25px;
}
.pr_html h3{
	font-size:20px;
}
</style>

<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link("ユーザー管理",array("controller"=>"users","action"=>"index")); ?>　＞　会員情報詳細(「<?php echo $result["User"]["nickname"]; ?>」さん)</div>
<h1>「<?php echo $result["User"]["nickname"]; ?>」さんの会員情報詳細</h1>
<div class="main_content">
	<?php //echo $this->element("users/gnavi"); ?>
	<h2>アカウント情報</h2>
	<?php
	if(isset($alert))
	{
		?>
		<div class="alert-message"><?php echo $alert; ?></div>
		<?php
	}
	
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<td colspan="4">
			<?php echo $this->Form->create("Forcelogin",array(
				"url"=>$wwwurl."user/forcelogin/",
				"target"=>"_blank",
			)); 
			
			echo $this->Form->hidden("username",array("value"=>$result["User"]["username"]));
			echo $this->Form->hidden("password",array("value"=>$result["User"]["password"]));
			?>
			<p class="center"><?php echo $this->Form->submit("このユーザーで強制ログイン",array("div"=>false,"class"=>"buttons")); ?></td>
			<?php echo $this->Form->end(); ?>
	</tr>
	<tr>
		<th>ID番号</th>
		<td>
			<?php echo @$result["User"]["id"]; ?>
		</td>
		<th>管理番号</th>
		<td>
			<?php echo @$result["User"]["user_number"]; ?>
		</td>
	</tr>
	<tr>
		<th>登録日</th>
		<td>
			<?php echo date("Y.m.d H:i",strtotime($result["User"]["createdate"])); ?>
		</td>
		<th>会員ステータス</th>
				<td>
			<?php
			$mode=array(
				0=>"仮登録",
				1=>"一般会員",
				2=>"退会",
				3=>"??",
			);
			$status=array(
				0=>"通常",
				1=>"利用停止",
			);
			echo @$mode[@$result["User"]["role"]]."[".@$status[@$result["User"]["status"]]."]";
			?>
		</td>
	</tr>
	<tr>
		<th>メールアドレス</th>
		<td colspan="3">
			<?php echo @$result["User"]["mailaddress"]; ?>
		</td>
	</tr>
		<tr>
			<th>ユーザー名</th>
			<td colspan="3"><?php echo @$result["User"]["username"]; ?></td>
		</tr>
	</table>

	<h2>会員個人(法人)情報</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>お名前</th>
		<td colspan="3">
			<?php echo @$result["Useroption"]["name_sei"]." ".@$result["Useroption"]["name_mei"]; ?>
			<?php echo "[".@$result["Useroption"]["name_sei_kana"]." ".@$result["Useroption"]["name_mei_kana"]."]"; ?>
		</td>
	</tr>
	<tr>
		<th>ニックネーム</th>
		<td colspan="3"><?php echo $result["User"]["nickname"]; ?></td>
	</tr>
	<tr>
		<th>アイコン</th>
		<td colspan="3">
			<div class="iconimage">
				<?php echo $this->Html->image($itemurl."smpimg/usericon/".@$result["Useroption"]["icontag"],array("onerror"=>'this.src="'.Router::url("/",true).'img/iconpeople.png"')); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>性別</th>
		<td><?php
		if(isset($result["Useroption"]["gender"])){
			$result["Useroption"]["gender"];
		}
		else
		{
			echo "-";
		}
		?></td>
	</tr>
	<?php
	if(@$result["Useroption"]["postnumber"])
	{
	?>
	<tr>
		<th>所在地</th>
		<td colspan="3">〒
		<?php echo $result["Useroption"]["postnumber"]; ?><br>
		<?php
		echo @$locationarea[@$result["Useroption"]["locationarea_id"]].@$result["Useroption"]["address1"].@$result["Useroption"]["address2"].@$result["Useroption"]["address3"];
		?>
		</td>
	</tr>
	<?php
	}
	if(@$result["Useroption"]["tel"])
	{
	?>
	<tr>
		<th>電話番号</th>
		<td colspan="3"><?php echo @$result["Useroption"]["tel"]; ?></td>
	</tr>
	<?php
	}
	?>
	<tr>
	<th>法人or個人</th>
	<td colspan="3">
		<?php
			$corporate_status=array(
				0=>"個人",
				1=>"法人",
			);
			echo @$corporate_status[@$result["Useroption"]["corporate_status"]]; ?>
	</td>
	</tr>
	<?php
	if(@$result["Useroption"]["corporate_status"]==1)
	{
	?>
	<tr>
		<th>法人会社名</th>
		<td colspan="3">
			<?php echo @$result["Useroption"]["corporate_company"]; ?>
		</td>
	</tr>
	<tr>
		<th>法人事業内容</th>
		<td colspan="3">
			<?php echo @$result["Useroption"]["corporate_overview"]; ?>
		</td>
	</tr>
	<tr>
		<th>法人連絡先電話番号</th>
		<td colspan="3">
			<?php echo @$result["Useroption"]["corporate_tel"]; ?>
		</td>
	</tr>

	<?php
	}
	?>

	</table>

	<h2>SNS設定情報</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>facebook連携</th>
		<td>
		<?php
			if($result["User"]["fb_id"]){
				echo "連携中[連携ID:".$result["User"]["fb_id"]."]";
			}
			else
			{
				echo "-";
			}
		?>
		</td>
	</tr>
	<tr>
		<th>twitter連携</th>
		<td>
		<?php
			if($result["User"]["tw_id"]){
				echo "連携中[連携ID:".$result["User"]["tw_id"]."]";
			}
			else
			{
				echo "-";
			}

		?>
		</td>
	</tr>
	</table>

	<h2>公開情報設定</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>職種</th>
		<td>
			<?php
			if(@$result["Useroption"]["job_id"])
			{
				echo @$job[@$result["Useroption"]["job_id"]];
			}
			else
			{
				echo "未設定";
			}
			?>
			<p>[公開設定:<?php echo @$openstatus[@$result["Useroption"]["job_status"]]; ?>]</p>
		</td>
	</tr>
	<tr>
		<th>生年月日</th>
		<td>
			<?php
			if(@$result["Useroption"]["birthday"])
			{
				echo date("Y年m月生まれ",strtotime($result["Useroption"]["birthday"]));
			}
			else
			{
				echo "未設定";
			}
			?>
			<p>[公開設定:<?php echo @$openstatus[@$result["Useroption"]["age_status"]]; ?>]</p>
		</td>
	</tr>
	<tr>
		<th>所在地公開設定</th>
		<td>
			<?php echo @$openstatus[@$result["Useroption"]["from_status"]]; ?>
		</td>
	</tr>
	<tr>
		<th>自己PR</th>
		<td>
			<div class="pr_html mb30">
				<?php echo @$result["Useroption"]["pr_html"]; ?>
				<p>[公開設定:<?php echo @$openstatus[@$result["Useroption"]["pr_status"]]; ?>]</p>
			</div>
			<div class="short">
				<?php echo nl2br(@$result["Useroption"]["pr_short"]); ?>
			</div>

		</td>
	</tr>
	</table>

	<h2>支払・振込設定</h2>

	<table cellspacing="0" cellpadding="0" class="mb20">
	<?php
	if($result["User"]["credit_json"]){
		$credit=json_decode($result["User"]["credit_json"],true);
	?>
	<tr>
		<th>支払設定</th>
		<td>
			<p>クレジットカード会社名 : <?php echo $credit["corporate"]; ?></p>
			<p>カード番号 : <?php echo $credit["number"]; ?></p>
			<p>有効期限：<?php echo $credit["limit_m"]; ?>月<?php echo $credit["limit_y"]; ?>年</p>
			<p>名義人 : <?php echo $credit["user"]; ?></p>
		</td>
	</tr>
	<?php
	}
	if($result["User"]["paypool_json"]){

		$paypool=json_decode($result["User"]["paypool_json"],true);
		$types=array(
		0=>"普通",
		1=>"当座",
		);
	?>
	<tr>
		<th>振込設定</th>
		<td>
			<p>銀行名 : <?php echo $paypool["name"]; ?></p>
			<p>支店名 : <?php echo $paypool["area"]; ?></p>
			<p>口座種別：<?php echo $types[$paypool["type"]]; ?></p>
			<p>口座番号：<?php echo $paypool["number"]; ?></p>
			<p>講座名義人：<?php echo $paypool["user"]; ?></p>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

	<div class="right mb20">
		<label for="deletepop" class="buttons">会員情報を削除</label>
	</div>
</div>


