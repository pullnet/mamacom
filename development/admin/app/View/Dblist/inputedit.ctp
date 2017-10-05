<div class="bread">
<?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link($view["title"]."一覧",array()); ?>　＞　
<?php echo $this->Html->link($view["title"]."詳細",array()); ?>　＞　
<?php echo $view["subtitle2"]; ?>編集</div>
<h1><?php echo $view["subtitle2"]; ?>編集</h1>

<div class="main_content">
	<h2><?php echo $view["title"]; ?>基本情報</h2>

	<div class="right mb5">

		<?php
		if(@$this->request->data[$view["models"]]["id"]){
			echo $this->Html->link("親カテゴリーの変更",array("controller"=>$this->params["controller"],"action"=>"parentchange",$this->request->data[$view["models"]]["id"]));
		}
		?>
	</div>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th><?php echo $tab[0]; ?></th>
		<td colspan="3"><?php echo $result_c[$view["model_parent"]]["name"]; ?></td>
	</tr>
	<tr>
		<th>登録日</th>
		<td colspan="3"><?php echo date("Y-m-d H:i",strtotime($result_c[$view["model_parent"]]["createdate"])); ?></td>
	</tr>
	<tr>
		<th><?php echo $tab[1]; ?></th>
		<td colspan="3"><?php echo count($result_c[$view["models"]]); ?></td>
	</tr>
	</table>

	<h2><?php echo $view["subtitle2"]; ?>登録・編集フォーム</h2>
	<?php echo $this->Form->create($view["models"],array(
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
	<?php if(isset($post[$view["models"]]["id"]))
	{
	?>
	<tr>
		<th>登録日</th>
		<td colspan="3"><?php echo date("Y-m-d H:i",strtotime($post[$view["models"]]["createdate"])); ?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<th><?php echo $tab[2]; ?></th>
		<td colspan="3">
			<?php echo $this->Form->input("name",array("error"=>false)); ?>
			<?php echo $this->Form->error("Dblist.name"); ?>
		</td>
	</tr>
	<?php
	//共通コンテンツカテゴリーの場合
	if($this->params["controller"]=="contentscategory")
	{
	?>
	<tr>
		<th colspan="2"><p class="center">カテゴリーページ設定</p></th>
	</tr>
	<tr>
		<th>公開設定</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("delete_flag",array(0=>"公開",1=>"非公開"),array("default"=>0,"legend"=>false)); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>ショートURL</th>
		<td>
			<?php echo $this->Form->input("shorturl",array("class"=>"short")); ?>
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
	else if($this->params["controller"]=="exampletext")
	{
	?>
	<tr>
		<th colspan="2"><p class="center">例文設定</p></th>
	</tr>
	<tr>
		<th>低文テキスト</th>
		<td>
			<?php echo $this->Form->textarea("text",array("class"=>"high")); ?>
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
