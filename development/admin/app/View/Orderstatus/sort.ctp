<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　注文ステータス並び替え</div>
<h1>注文ステータス並び替え</h1>
<div class="main_content">
	<?php
	echo $this->Form->create("Osort",array(
		"inputDefaults"=>array(
			"Div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	?>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th class="micro">No</th>
		<th>ステータス名</th>
		<th class="minishort"></th>
	</tr>
	<?php
	$count=0;
	foreach($result as $r_){
		$count++;
	?>
	<tr class="sec" index="<?php echo $count; ?>">
		<td class="center"><?php echo $count; ?></td>
		<td class="view_name"><?php echo h($r_["Orderstatuslist"]["name"]); ?></td>
		<td>
			<?php echo $this->Form->hidden("Osort.".$count,array("value"=>$r_["Orderstatuslist"]["id"],"class"=>"hidden_id")); ?>
			<?php
			if($count>=2){
			?>
				<a class="buttons move_up" index="<?php echo $count; ?>">▲</a>
			<?php
			}
			else
			{
			?>
				<a class="buttons move_down" style="visibility:hidden">▲</a>
			<?php
			}
			if($count<count($result)){
			?>
			<a class="buttons move_down" index="<?php echo $count; ?>">▼</a>
			<?php
			}
			?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

	<div class="center mb20">
		<?php echo $this->Form->submit("ステータスを設定する",array("div"=>false,"class"=>"buttons add")); ?>
	</div>
	<?php echo $this->Form->end(); ?>

	<script type="text/javascript">
	$(function(){

		$(".move_up").on("click",function(){
			var index=$(this).attr("index");
			var index_next=parseInt(index)-1;

			function_move(index,index_next);
		});
		$(".move_down").on("click",function(){
			var index=$(this).attr("index");
			var index_next=parseInt(index)+1;

			function_move(index,index_next);
		});

		function function_move(index,index_next){
			var view_name=$(".sec[index="+index+"] .view_name").text();
			var hidden_id=$(".sec[index="+index+"] .hidden_id").val();

			var view_name_next=$(".sec[index="+index_next+"] .view_name").text();
			var hidden_id_next=$(".sec[index="+index_next+"] .hidden_id").val();

			$(".sec[index="+index+"] .view_name").text(view_name_next);
			$(".sec[index="+index+"] .hidden_id").val(hidden_id_next);

			$(".sec[index="+index_next+"] .view_name").text(view_name);
			$(".sec[index="+index_next+"] .hidden_id").val(hidden_id);

		}

	});
	</script>
</div>