<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　公開情報設定</div>
	<h1>公開情報設定</h1>
	<?php
		if(isset($alert))
		{
	?>
	<div class="alert-message"><?php echo $alert; ?></div>
	<?php
		}
	?>
	<div class="main_content">
		<?php echo $this->Element("common/hpset_gnavi"); ?>
		<?php echo $this->Form->create("Defaultopeninfo",array(
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
			<th>運営会社名</th>
			<td>
				<?php echo $this->Form->input("company_name",array("error"=>false)); ?>
				<?php echo $this->Form->error("company_name"); ?>
			</td>
		</tr>
		<tr>
			<th>店舗運営責任者情報</th>
			<td>
				<?php echo $this->Form->input("company_owner",array("error"=>false)); ?>
				<?php echo $this->Form->error("company_owner"); ?>
			</td>
		</tr>
		<tr>
			<th>店舗セキュリティ責任者</th>
			<td>
				<?php echo $this->Form->input("security_owner",array("error"=>false)); ?>
				<?php echo $this->Form->error("security_owner"); ?>
			</td>
		</tr>
		<tr>
			<th>資本金</th>
			<td>
				<?php echo $this->Form->input("capital",array("class"=>"short","error"=>false)); ?> 円
				<?php echo $this->Form->error("capital"); ?>
			</td>
		</tr>
		<tr>
			<th>会社所在地</th>
			<td>
				<p class="mb10">〒 
				<?php echo $this->Form->input("postnumber",array("class"=>"mini","error"=>false)); ?>
				<?php echo $this->Form->select("locationarea_id",$locationarea,array("class"=>"short","empty"=>false)); ?>
				</p>
				<p class="mb10">市区町村　
				<?php echo $this->Form->input("address1",array("class"=>"long","error"=>false)); ?>
				</p>
				<p class="mb10">丁目番地　
				<?php echo $this->Form->input("address2",array("class"=>"long","error"=>false)); ?>
				</p>
				<p>その他　　
				<?php echo $this->Form->input("address3",array("class"=>"long")); ?>
				</p>

				<p>
				<?php echo $this->Form->error("postnumber"); ?>
				<?php echo $this->Form->error("address1"); ?>
				<?php echo $this->Form->error("address2"); ?>
				</p>

			</td>
		</tr>
		<tr>
			<th>お問い合わせTEL</th>
			<td>
				<?php echo $this->Form->input("tel",array("error"=>false)); ?>
				<?php echo $this->Form->error("tel"); ?>
			</td>
		</tr>
		<tr>
			<th>お問い合わせFAX</th>
			<td>
				<?php echo $this->Form->input("fax",array("error"=>false)); ?>
				<?php echo $this->Form->error("fax"); ?>
			</td>
		</tr>
		<tr>
			<th>連絡先メールアドレス</th>
			<td>
				<?php echo $this->Form->input("shopemail",array("error"=>false)); ?>
				<?php echo $this->Form->error("shopemail"); ?>
			</td>
		</tr>
		<tr>
			<th>運営会社HP</th>
			<td>
				<?php echo $this->Form->input("url",array("error"=>false)); ?>
				<?php echo $this->Form->error("url"); ?>
			</td>
		</tr>
		<tr>
			<th>基本ページタイトル</th>
			<td>
				<?php echo $this->Form->input("pagetitle",array("error"=>false)); ?>
				<?php echo $this->Form->error("pagetitle"); ?>
			</td>
		</tr>
		<tr>
			<th>meta description</th>
			<td>
				<?php echo $this->Form->textarea("meta_description",array("error"=>false)); ?>
				<?php echo $this->Form->error("meta_description"); ?>
			</td>
		</tr>		
		<tr>
			<th>meta keywords</th>
			<td>
				<?php echo $this->Form->textarea("meta_keywords",array("error"=>false)); ?>
				<?php echo $this->Form->error("meta_keywords"); ?>
			</td>
		</tr>		
		<tr>
			<th>利用規約</th>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<?php echo $this->Form->textarea("rule",array("div"=>false,"class"=>"maxhigh","error"=>false)); ?>
					<?php echo $this->Form->error("rule"); ?>
				</tr>
				</table>

			</td>
		</tr>

		</table>
		<div class="center mt20 mb20">
			<!--<a href="#" class="submit">プレビュー</a>-->
			<?php echo $this->Form->submit("公開情報を更新する",array("div"=>false,"class"=>"buttons")); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>