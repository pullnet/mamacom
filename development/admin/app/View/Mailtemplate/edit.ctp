<div class="bread"><a href="index.html">管理TOP</a>　＞　<a href="mailtamplate_list.html">メールテンプレート一覧</a>　＞　メールテンプレートの編集</div>
	<h1>メールテンプレートの編集</h1>
	<div class="main_content">

		<?php echo $this->Form->create("Mailtemplate",array(
			"inputDefaults"=>array(
				"div"=>false,
				"label"=>false,
				"legend"=>false,
				"required"=>false,
			),
		));

		echo $this->Form->hidden("id");
		?>
		<table cellspacing="0" cellpadding="0" class="mb20">
		<tr>
			<th>テンプレート名</th>
			<td>
				<?php echo $this->Form->input("name",array("error"=>false)); ?>
				<?php echo $this->Form->error("name"); ?>
			</td>
		</tr>
		<tr>
			<th>メール本文ヘッダー</th>
			<td>
				<?php echo $this->Form->textarea("header",array("class"=>"high","div"=>false,"error"=>false,"required"=>false)); ?>
				<?php echo $this->Form->error("header"); ?>
			</td>
		</tr>
		<tr>
			<th>メール本文ヘッダー</th>
			<td>
				<?php echo $this->Form->textarea("footer",array("class"=>"high","div"=>false,"error"=>false,"required"=>false)); ?>
				<?php echo $this->Form->error("footer"); ?>
			</td>
		</tr>
		</table>
		<div class="center mb20">
			<?php echo $this->Form->submit("メールテンプレートを設定する",array("class"=>"buttons","div"=>false)); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>