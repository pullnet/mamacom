<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link($view["title"]."一覧",array("controller"=>$this->params["controller"],"action"=>"index")); ?>　＞　
<?php echo $view["title"]; ?>編集</div>
<h1><?php echo $view["title"]; ?>編集</h1>
<div class="main_content">
	<div class="gnavi">
		<ul class="float">
			<li class="active"><a class="active"><?php echo $view["title"]; ?>編集</a></li>
		</ul>
	</div>
	<h2><?php echo $view["title"]; ?>基本情報</h2>
	<?php echo $this->Form->create($view["model_parent"],array(
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
	<?php if(isset($post[$view["model_parent"]]["id"]))
	{
	?>
	<tr>
		<th>登録日</th>
		<td colspan="3"><?php echo date("Y-m-d H:i",strtotime($post[$view["model_parent"]]["createdate"])); ?></td>
	</tr>
	<?php } ?>
	<tr>
		<th><?php echo $view["title"]; ?>名</th>
		<td colspan="3">
			<?php echo $this->Form->input("name",array("error"=>false)); ?>
			<?php echo $this->Form->error("name"); ?>
		</td>
	</tr>
	<?php
	if($this->params["controller"]=="contentscategory"){
	?>
	<tr>
		<th>ページURL</th>
		<td>
			<?php echo $this->Form->input("permalink",array("class"=>"short")); ?>
		</td>
	</tr>

	<tr>
		<th>htmlタグ</th>
		<td>
			<?php echo $this->Form->textarea("html",array("style"=>"height:300px")); ?>
		</td>
	</tr>
	<tr>
		<th>スマホ用htmlタグ</th>
		<td>
			<?php echo $this->Form->textarea("smp_html",array("style"=>"height:300px")); ?>
		</td>
	</tr>
	<tr>
		<th>meta description</th>
		<td>
			<?php echo $this->Form->textarea("meta_description"); ?>
		</td>
	</tr>
	<tr>
		<th>meta keywords</th>
		<td>
			<?php echo $this->Form->textarea("meta_keywords"); ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

	<div class="center mb20">
		<?php echo $this->Form->submit("編集を完了する",array("class"=>"buttons","div"=>false)); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
