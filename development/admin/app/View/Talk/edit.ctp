<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　
<?php echo $this->Html->link("メッセージフィールド一覧",array("controller"=>"talk","action"=>"index")); ?>　＞　
メッセージフィールド編集</div>
<h1>メッセージフィールド編集</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Messagefield",array(
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
		<th>現在のMessagefielduser</th>
		<td>
			<?php
			foreach($this->request->data["Messagefielduser"] as $p_){
				echo @$p_["User"]["nickname"]."<br>";
			}
			?>
		</td>
	</tr>
	<tr>
		<th>通常/グループ</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("field_status",array(0=>"個人",3=>"仲間",1=>"グループ",2=>"コラボ専用"),array("legend"=>false,"default"=>0,"class"=>"field_status")); ?>
			</div>
		</td>
	</tr>
	<tr class="type_friend">
		<th>選択仲間情報</th>
		<td>
			<?php echo $this->Form->select("friend_id",$friend_list,array("empty"=>"---")); ?>
		</td>
	</tr>
	<tr class="type_group">
		<th>選択グループ</th>
		<td>
			<?php echo $this->Form->select("group_id",$group_list,array("empty"=>"---")); ?>
		</td>
	</tr>
	<tr class="type_collabo">
		<th>選択コラボ</th>
		<td>
			<?php echo $this->Form->select("collabo_content_id",$collabo_list,array("empty"=>"---")); ?>
		</td>
	</tr>
	</table>
	<div class="center mb20">
		<?php echo $this->Form->submit("フィールドを設定する",array("div"=>false,"class"=>"buttons")); ?>
	</div>
	<?php echo $this->Form->end(); ?>

	<script type="text/javascript">
	$(function(){
		check_field_status();
		$(".field_status").on("click",function(){
			check_field_status();
		});

		function check_field_status(){
			if($(".field_status:checked").val()==0){
				$(".type_friend").css("display","none");
				$(".type_group").css("display","none");
				$(".type_collabo").css("display","none");
			}
			else if($(".field_status:checked").val()==1){
				$(".type_friend").css("display","none");
				$(".type_group").css("display","");
				$(".type_collabo").css("display","none");
			}
			else if($(".field_status:checked").val()==2){
				$(".type_friend").css("display","none");
				$(".type_group").css("display","none");
				$(".type_collabo").css("display","");
			}
			else if($(".field_status:checked").val()==3){
				$(".type_friend").css("display","");
				$(".type_group").css("display","none");
				$(".type_collabo").css("display","none");
			}

		}
	});
	</script>
</div>