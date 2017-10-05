<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link("メールフォーマット一覧",array("controller"=>"mailformat","action"=>"index")); ?>　＞　メールフォーマットの編集</div>
	<h1>メールフォーマットの編集</h1>
	<div class="main_content">
		<h2>メールフォーマット情報</h2>
		<?php echo $this->Form->create("Mailformat",array(
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
		<?php if(isset($post["Mailfomat"]["createdate"]))
		{
		?>
		<tr>
			<th>登録日</th>
			<td>
				<?php echo date("Y-m-d H:i",strtotime($post["Mailfomat"]["createdate"])); ?>
			</td>
		</tr>
		<?php
		}
		?>
		<tr>
			<th>フォーマット名</th>
			<td colspan="3">
				<?php echo $this->Form->input("name",array("error"=>false)); ?>
				<?php echo $this->Form->error("name"); ?>
			</td>
		</tr>
		<tr>
			<th>フォーマットコード</th>
			<td>
				<?php echo $this->Form->input("code",array("class"=>"long","empty"=>false)); ?>
			</td>
		</tr>
		<tr>
			<th>フォーマットカテゴリー</th>
			<td colspan="3">
				<?php echo $this->Form->select("category",$format_category,array("class"=>"long","empty"=>"----")); ?>
			</td>
		</tr>
		<tr>
			<th>サブカテゴリー</th>
			<td colspan="3">
				<?php echo $this->Form->input("sub_category",array("class"=>"short")); ?>
			</td>
		</tr>

		</tr>
			<th>使用テンプレート</th>
			<td>
				<?php echo $this->Form->select("mailtemplate_id",$mailtemplate,array("empty"=>"--テンプレートなし--")); ?>
			</td>
		</tr>
		<tr>
			<th>メール件名</th>
			<td>
				<?php echo $this->Form->input("subject",array("error"=>false)); ?>
				<?php echo $this->Form->error("subject"); ?>
			</td>
		</tr>
		<tr>
			<th>メール本文内容</th>
			<td>
				<?php echo $this->Form->textarea("message",array("class"=>"bigs","error"=>false,"required"=>false)); ?>
				<?php echo $this->Form->error("message"); ?>
			</td>
		</tr>
		</table>
		<div class="center mb20">
			<?php echo $this->Form->submit("メールフォーマットを設定する",array("class"=>"buttons","div"=>false)); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>
