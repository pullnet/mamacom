<div class="bread">
	<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
	<?php echo $this->Html->link("インフォメーション一覧",array("controller"=>"information","action"=>"index")); ?>　＞　
	インフォメーション編集・登録
</div>
<h1>インフォメーション編集・登録</h1>
<div class="main_content">

	<?php echo $this->Form->create("Information",array(
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
		<th>ページタイトル</th>
		<td>
			<?php echo $this->Form->input("title",array("error"=>false)); ?>
			<?php echo $this->Form->error("title"); ?>
		</td>
	</tr>
<!--
	<tr>
		<th>カテゴリー</th>
		<td>
			<?php
			$information_category=array(
				"maintenance"=>"メンテナンス",
				"function_add"=>"機能追加・変更",
				"other"=>"その他",
			);
			echo $this->Form->select("information_category",$information_category,array("class"=>"short","empty"=>"------","error"=>false)); ?>
		</td>
	</tr>
-->
	<tr>
		<th colspan="2" class="center middle">内容</th>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo $this->Form->textarea("caption",array("class"=>"maxhigh","error"=>false,"required"=>false)); ?>
			<?php echo $this->Form->error("caption"); ?>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Form->submit("インフォメーションを設定",array("class"=>"buttons","div"=>false)); ?>
	</div>
</div>