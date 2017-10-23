<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　サイト基本設定</div>
	<h1>サイト基本設定</h1>
	
	<?php
		if(isset($alert)){
	?>
	<div class="alert-message"><?php echo $alert; ?></div>
	<?php
		}
	?>


	<div class="main_content">
		<?php /* echo $this->Element("common/hpset_gnavi"); */ ?>
		<?php echo $this->Form->create("Defaultbasic",array(
			"inputDefaults"=>array(
				"div"=>false,
				"label"=>false,
				"legend"=>false,
				"required"=>false,
			),
		));
		?>
		
		<table cellspacing="0" cellpadding="0">
		<tr>
			<th>稼働設定</th>
			<td>
				<?php echo $this->Form->select("status",array(0=>"稼働中",1=>"停止"),array("class"=>"mini","empty"=>false)); ?>
			</td>
		</tr>
		<tr>
			<th>設定ドメイン</th>
			<td>
				<table cellspacing="0" cellpadding="0" style="margin:15px 0px 15px 0px;">
				<tr>
					<th>一般サイト</th>
					<td>
						<?php echo $this->Form->input("wwwurl"); ?>
					</td>
				</tr>
				<tr>
					<th>管理サイト</th>
					<td>
						<?php echo $this->Form->input("adminurl"); ?>
					</td>
				</tr>
				<tr>
					<th>コンテンツ管理用</th>
					<td>
						<?php echo $this->Form->input("itemurl"); ?>
					</td>
				</tr>
				<tr>
					<th>専用API</th>
					<td>
						<?php echo $this->Form->input("apiurl"); ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>				
		<tr>
			<th>img service secret</th>
			<td>
					<?php echo $this->Form->input("img_service_secret"); ?>
			</td>
		</tr>			
		<tr>
			<th>img lisence key</th>
			<td>
					<?php echo $this->Form->input("img_lisence_key"); ?>
			</td>
		</tr>
		<tr>
			<th>API service_secret</th>
			<td>
					<?php echo $this->Form->input("service_secret"); ?>
			</td>
		</tr>			
		<tr>
			<th>API lisence_key</th>
			<td>
					<?php echo $this->Form->input("lisence_key"); ?>
			</td>
		</tr>
		<tr>
			<th>access token</th>
			<td>
					<?php echo $this->Form->input("token"); ?>
			</td>
		</tr>

		<tr>
			<th>メール設定</th>
			<td>
				<table cellspacing="0" cellpadding="0" style="margin:15px 0px 15px 0px;">
				<tr>
					<th>メールホスト</th>
					<td>
						<?php echo $this->Form->input("mail_host",array("error"=>false)); ?>
						<?php echo $this->Form->error("mail_host"); ?>
					</td>
				</tr>
				<tr>
					<th>送信メールアドレス</th>
					<td>
						<?php echo $this->Form->input("mail_address",array("error"=>false)); ?>
						<?php echo $this->Form->error("mail_address"); ?>
					</td>
				</tr>
				<tr>
					<th>送信者名</th>
					<td>
						<?php echo $this->Form->input("mail_sendname",array("error"=>false)); ?>
						<?php echo $this->Form->error("mail_sendname"); ?>
					</td>
				</tr>
				<tr>
					<th>ポート番号</th>
					<td>
						<?php echo $this->Form->input("mail_port",array("class"=>"mini","error"=>false)); ?>
						<?php echo $this->Form->error("mail_port"); ?>
					</td>
				</tr>
				<tr>
					<th>アカウント</th>
					<td>
						<?php echo $this->Form->input("mail_username",array("error"=>false)); ?>
						<?php echo $this->Form->error("mail_username"); ?>
					</td>
				</tr>
				<tr>
					<th>パスワード</th>
					<td>
						<?php echo $this->Form->input("mail_password",array("error"=>false)); ?>
						<?php echo $this->Form->error("mail_password"); ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
<!--
	<tr>
		<th>SNS設定</th>
		<td>
			<table cellspacing="0" cellpadding="0">
			<tr>
				<th>facebookアプリ情報</th>
				<td>
					<p>アプリID</p>
					<p class="mb5"><?php echo $this->Form->input("facebook_appid"); ?></p>
					<p>シークレットキー</p>
					<p><?php echo $this->Form->input("facebook_appsecret"); ?></p>
				</td>
			<tr>
			</tr>
				<th>facebookページURL</th>
				<td>
					<?php echo $this->Form->input("facebook_url"); ?>
				</td>
			</tr>
			<tr>
				<th>twitterアプリ情報</th>
				<td>
					<p>アプリID</p>
					<p class="mb5"><?php echo $this->Form->input("twitter_appid"); ?></p>
					<p>シークレットキー</p>
					<p><?php echo $this->Form->input("twitter_appsecret"); ?></p>

				</td>
			</tr>
			</table>
		</td>
	</tr>
	
-->
	
	</table>
	
<!--
	<div class="right mt20 mb20">
		<?php echo $this->Html->link("メール送信確認テスト",array("controller"=>"hpset","action"=>"sendmailtest")); ?>
	</div>
-->


	<div class="center mt20 mb20">
		<?php echo $this->Form->submit("基本情報を更新する",array("class"=>"buttons","div"=>false)); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
