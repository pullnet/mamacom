<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("メッセージフィールド一覧",array("controller"=>"talk","action"=>"index")); ?>　＞　
<?php echo $this->Html->link("メッセージフィールド詳細",array("controller"=>"talk","action"=>"view",$result_mf["Messagefield"]["id"])); ?>　＞　メッセージ編集</div>
<h1>メッセージ編集</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Message",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	echo $this->Form->hidden("id");
	echo $this->Form->hidden("messagefield_id",array("value"=>$result_mf["Messagefield"]["id"]));
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>コード番号</th>
		<td>
			<?php
				if(isset($next_talk_number))
				{
					echo $next_talk_number;
					echo $this->Form->hidden("talk_number",array("value"=>$next_talk_number));
				}
				else
				{
					
				}
			?>
		</td>
	</tr>
	<tr>
		<th>投稿日</th>
		<td>
			<?php echo $this->Form->input("send_date",array("type"=>"text","class"=>"short")); ?>
		</td>
	</tr>

	<tr>
		<th>発信ユーザー</th>
		<td>
			<?php echo $this->Form->select("user_id",$userlist,array("empty"=>"---未選択---")); ?>
		</td>
	</tr>
	<tr>
		<th>メッセージ内容</th>
		<td>
			<?php echo $this->Form->textarea("message",array("required"=>false,"class"=>"high")); ?>
		</td>
	</tr>
	<tr>
		<th>公開設定</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("open_status",array(0=>"公開",1=>"非公開"),array("default"=>0,"legend"=>false)); ?>
			</div>
		</td>
	</tr>
	</table>

	<div class="center mb20">
		<?php echo $this->Form->submit("メッセージを設定",array("div"=>false,"class"=>"short")); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>