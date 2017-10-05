<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("ユーザー管理",array("controller"=>"users","action"=>"index")); ?>　＞　会員情報編集</div>
<h1>会員情報編集</h1>
<div class="main_content">
	<?php 
	if(isset($post))
	{
		$this->set("result",$post);
		echo $this->element("users/gnavi");
	}
	?>
	<h2>アカウント情報</h2>
	<?php
	echo $this->Form->create("User",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	echo $this->Form->hidden("id");
	echo $this->Form->hidden("user_number");
	echo $this->Form->hidden("item_app_id");
	echo $this->Form->hidden("api_app_id");
	?>
		<table cellspacing="0" cellpadding="0" class="mb20">
		<tr>
			<th>会員ステータス</th>
			<td>
				<?php
				$role=array(
					0=>"仮会員",
					1=>"正会員",
					2=>"退会",
				);
				$status=array(
					0=>"公開",
					1=>"利用停止",
				);
				echo $this->Form->select("role",$role,array("empty"=>false)); ?>
			</td>
			<th>有効/無効</th>
			<td>
				<?php echo $this->Form->select("status",$status,array("empty"=>false)); ?>
			</td>
		</tr>
		<tr>
			<th>メールアドレス</th>
			<td colspan="3">
				<?php echo $this->Form->input("mailaddress",array("class"=>"long","error"=>false)); ?>
				<?php echo $this->Form->error("mailaddress"); ?>
			</td>
		</tr>
		<tr>
			<th>ニックネーム</th>
			<td colspan="3">
				<?php echo $this->Form->input("nickname",array("class"=>"short","error"=>false)); ?>
				<?php echo $this->Form->error("nickname"); ?>
			</td>
		</tr>
		<tr>
			<th>ユーザー名</th>
			<td colspan="3">
				<?php echo $this->Form->input("username",array("class"=>"long","error"=>false)); ?>
				<?php echo $this->Form->error("username"); ?>
			</td>
		</tr>
		<tr>
			<th>パスワード</th>
			<td colspan="3">
				<?php echo $this->Form->input("password_1",array("type=">"password","class"=>"short","error"=>false)); ?>
				<p>確認の為、再度入力</p>
				<?php echo $this->Form->input("password_2",array("type=">"password","class"=>"short","error"=>false)); ?>
				<?php echo $this->Form->error("password_2"); ?>
				<?php echo $this->Form->hidden("password"); ?>
			</td>
		</tr>
		</table>

		<h2>会員基本情報</h2>
		<table cellspacing="0" cellpadding="0" class="mb20">
		<tr>
			<th>お名前</th>
			<td colspan="3">
				姓 <?php echo $this->Form->input("name_sei",array("class"=>"mini","error"=>false)); ?> 名 <?php echo $this->Form->input("name_mei",array("class"=>"mini","error"=>false)); ?>
				<?php echo $this->Form->error("name_sei"); ?>
				<?php echo $this->Form->error("name_mei"); ?>
			</td>
		</tr>
		<tr>
			<th>お名前(フリガナ)</th>
			<td colspan="3">
				姓 <?php echo $this->Form->input("name_sei_kana",array("class"=>"mini")); ?> 名 <?php echo $this->Form->input("name_mei_kana",array("class"=>"mini")); ?>
			</td>
		</tr>

		<tr>
			<th>アイコン</th>
			<td colspan="3">
					<div class="iconimage mb10">
						<?php
						if(isset($this->request->data["User"]))
						{

							if(file_exists("buffer/Admin/".$admindata["Admin"]["admin_number"]."/".$this->request->data["User"]["icontag"]))
							{
								echo $this->Html->image(Router::url("/",true)."buffer/Admin/".$admindata["Admin"]["admin_number"]."/".$this->request->data["User"]["icontag"],array("onerror"=>'this.src="'.Router::url("/",true).'img/iconpeople.png"',"id"=>"iconimage"));
							}
							else
							{
								echo $this->Html->image($itemurl."smpimg/usericon/".$this->request->data["User"]["icontag"],array("onerror"=>'this.src="'.Router::url("/",true).'img/iconpeople.png"',"id"=>"iconimage"));
							}

						}
						else
						{
							echo $this->Html->image(Router::url("/",true)."img/iconpeople.png",array("onerror"=>'this.src="'.Router::url("/",true).'img/iconpeople.png"',"id"=>"iconimage"));
						}

						?>
					</div>
					<label for="bigp01" class="buttons">アイコンの設定</label>
					<?php echo $this->Form->hidden("icontag",array("id"=>"icontag")); ?>
					<?php echo $this->Form->error("icontag"); ?>
			</td>
		</tr>
		<tr>
					<th>性別</th>
					<td>
						<?php echo $this->Form->select("gender",$gender,array("class"=>"short","empty"=>false)); ?>
					</td>
					<th>個人or法人</th>
					<td>
						<?php echo $this->Form->select("corporate_status",array(0=>"個人",1=>"法人"),array("id"=>"corpo_status","class"=>"mini","empty"=>false)); ?>
					</td>
				</tr>
				<tr class="type_corpo">
					<th>法人会社名</th>
					<td colspan="3">
						<?php echo $this->Form->input("corporate_company"); ?>
					</td>
				</tr>
				<tr class="type_corpo">
					<th>法人事業内容</th>
					<td colspan="3">
						<?php echo $this->Form->textarea("corporate_overview",array("class"=>"high")); ?>
					</td>
				</tr>
				<tr class="type_corpo">
					<th>法人連絡先電話番号</th>
					<td colspan="3">
						<?php echo $this->Form->input("corporate_tel"); ?>
					</td>
				</tr>
				<tr>
					<th>所在地</th>
					<td colspan="3">
						<table cellspacing="0" cellpadding="0">
						<tr>
							<th>郵便番号/都道府県</th>
							<td>〒 <?php echo $this->Form->input("postnumber",array("class"=>"mini","error"=>false)); ?>
							<?php echo $this->Form->select("locationarea_id",$locationarea,array("class"=>"mini","empty"=>false)); ?>
							<?php echo $this->Form->error("postnumber"); ?>
							</td>
						</tr>
						<tr>
							<th>市区町村</th>
							<td colspan="3">
								<?php echo $this->Form->input("address1",array("error"=>false)); ?>
								<?php echo $this->Form->error("address1"); ?>
							</td>
						</tr>
						<tr>
							<th>丁目番地</th>
							<td colspan="3">
								<?php echo $this->Form->input("address2",array("error"=>false)); ?>
								<?php echo $this->Form->error("address2"); ?>
							</td>
						</tr>
						<tr>
							<th>マンション等</th>
							<td colspan="3">
								<?php echo $this->Form->input("address3"); ?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th>電話番号</th>
					<td colspan="3">
						<?php echo $this->Form->input("tel"); ?>
					</td>
				</tr>
				</table>
				<script type="text/javascript">
				$(function(){
					check_corpo();
					$("#corpo_status").on("change",function(){
						check_corpo();
					});

					function check_corpo(){
						var corpo_status=$("#corpo_status").val();
						if(corpo_status==1)
						{
							$(".type_corpo").css("display","");
						}
						else
						{
							$(".type_corpo").css("display","none");
						}
					}

				});
				</script>
				<h2>SNS設定情報</h2>
				<table cellspacing="0" cellpadding="0" class="mb20">
				<tr>
					<th>facebook連携ID</th>
					<td>
						<?php echo $this->Form->input("fb_id",array("type"=>"text","class"=>"short")); ?>
					</td>
				</tr>
				<tr>
					<th>twitter連携ID</th>
					<td>
						<?php echo $this->Form->input("tw_id",array("type"=>"text","class"=>"short")); ?>
					</td>
				</tr>
				</table>

				<h2>公開情報設定</h2>
				<table cellspacing="0" cellpadding="0" class="mb20">
				<tr>
					<th>職種</th>
					<td>
						<?php echo $this->Form->select("job_id",$job,array("class"=>"short")); ?>
						<div id="swradio" class="mt5">
							公開設定<?php echo $this->Form->radio("job_status",$openstatus,array("legend"=>false,"default"=>0)); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th>生年月日</th>
					<td>
						<?php echo $this->Form->select("birthday_y",$datelist["year"],array("class"=>"mini")); ?> 年
						<?php echo $this->Form->select("birthday_m",$datelist["month"],array("class"=>"micro")); ?> 月
						<?php echo $this->Form->select("birthday_d",$datelist["day"],array("class"=>"micro")); ?> 日
						<div id="swradio" class="mt5">
							公開設定<?php echo $this->Form->radio("age_status",$openstatus,array("legend"=>false,"default"=>0)); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th>所在地公開設定</th>
					<td>
						<div id="swradio">
							公開設定<?php echo $this->Form->radio("from_status",$openstatus,array("legend"=>false,"default"=>0)); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th>自己PR</th>
					<td>
						<p>※htmlタグ使用可能</p>
						<?php echo $this->Form->textarea("pr_html",array("class"=>"high")); ?>
						<div id="swradio">
							<p>公開設定</p>
							<?php echo $this->Form->radio("pr_status",$openstatus,array("legend"=>false,"default"=>0)); ?>
						</div><!--//#swradio-->
						<p>紹介説明文用<br>
						※htmlタグ使用不可<br>
						※200文字以内
						</p>
						<?php echo $this->Form->textarea("pr_short",array("class"=>"high_2")); ?>
					</td>
				</tr>
				</table>
				<h2>支払・振込設定</h2>
				<?php echo $this->Form->hidden("Userpayment.id"); ?>
				<table cellspacing="0" cellpadding="0" class="mb20">
				<tr>
					<th>支払設定(クレジット決済)</th>
					<td>
						<table cellspacing="0" cellpadding="0">
						<tr>
							<th>クレジット会社</th>
							<td>
								<?php echo $this->Form->select("Userpayment.payment_credit_company",$credit_company,array("class"=>"short")); ?>
							</td>
						</tr>
						<tr>
							<th>クレジット番号</th>
							<td>
								<?php echo $this->Form->input("Userpayment.payment_credit_number",array("class"=>"long")); ?>
							</td>
						</tr>
						<tr>
							<th>クレジット名義人</th>
							<td>
								<?php echo $this->Form->input("Userpayment.payment_credit_owner",array("class"=>"long")); ?>
							</td>
						</tr>
						<tr>
							<th>クレジット有効期限</th>
							<td>
								<?php echo $this->Form->select("Userpayment.payment_credit_limit_m",$datelist_up["month"],array("class"=>"micro")); ?> 月
								<?php echo $this->Form->select("Userpayment.payment_credit_limit_y",$datelist_up["year"],array("class"=>"mini")); ?> 年
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th>振込設定(銀行振込)</th>
					<td>
						<table cellspacing="0" cellpadding="0">
						<tr>
							<th>銀行名</th>
							<td>
								<?php echo $this->Form->input("Userpayment.pool_bank_name"); ?>
							</td>
						</tr>
						<tr>
							<th>銀行口座番号</th>
							<td>
								<?php echo $this->Form->input("Userpayment.pool_bank_number"); ?>
							</td>
						</tr>
						<tr>
							<th>銀行口座名義人</th>
							<td>
								<?php echo $this->Form->input("Userpayment.pool_bank_user"); ?>
							</td>
						</tr>
						</table>
					</td>
				</tr>

				</table>

				<div class="center mt20 mb20">
					<a class="submit" onclick="history.back()">戻る</a>
					<?php echo $this->Form->submit("会員情報を設定する",array("class"=>"buttons","div"=>false)); ?>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>

<?php
//※アイコン編集セットはコチラ↓
echo $this->element("users/iconedit_block");
?>