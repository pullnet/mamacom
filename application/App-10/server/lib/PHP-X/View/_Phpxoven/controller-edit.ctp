<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_oven"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">Controller edit</h1>
			
			<?php echo $this->Form->create("Controller"); ?>
			
			<table class="mb30">
			<tr>
				<th>Controller name</th>
				<td>
					<p class="h4"><?php echo $this->Form->input("name",array("class"=>"w150")); ?> Controller</p>
					<?php echo $this->Html->active(@$errors["Controller"]["name"],array("class"=>"error-message")); ?>
				</td>
			</tr>
			<tr>
				<th>Inheritance Controller</th>
				<td>
					<p>When there is an inheritance source</p>
					<p class="h4"><?php echo $this->Form->input("inheritance_controller",array("class"=>"w150")); ?> Controller</p>
					<?php echo $this->Html->active(@$errors["Controller"]["inheritance_controller"],array("class"=>"error-message")); ?>
				</td>
			</tr>
			<tr>
				<th>uses list</th>
				<td>
					<p>Please fill in the Model(Database Table) to use if there is one</p>
					<p>Separate model names with ","<?p>
					<?php echo $this->Form->textarea("uses",array("class"=>"h100","placeholder"=>"example : User,Shop,Userinfo,")); ?>
					<?php echo $this->Html->active(@$errors["Controller"]["uses"],array("class"=>"error-message")); ?>
				</td>
			</tr>
			<tr>
				<th>component list</th>
				<td>
					<p>Please fill in the Component to use if there is one</p>
					<p>Separate Component names with ","<?p>
					<?php echo $this->Form->textarea("components",array("class"=>"h100","placeholder"=>"example : Session,Cookie,Auth,...")); ?>
					<?php echo $this->Html->active(@$errors["Controller"]["components"],array("class"=>"error-message")); ?>
				</td>
			</tr>
			<tr>
				<th colspan="2">default action list</th>
			</tr>
			<tr>
				<td colspan="2">
					<div class="action_area"></div>
					
					<label class="buttons new add_action">ceate action(method)</label>
					
				</td>
			</tr>
			<tr>
				<th>Comment</th>
				<td>
					<?php echo $this->Form->textarea("comment",array("class"=>"h200")); ?>
				</td>
			</tr>
			</table>
			
			<div class="center">
				<?php echo $this->Form->submit("Controller save",array("class"=>"buttons big add")); ?>
			</div>
			
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<div id="url_get_controlleraction"><?php echo $this->Html->url(array("controller"=>"_phpxoven","action"=>"ajax_getactionform")); ?></div>
<script type="text/javascript">
$(function(){

	$(".add_action").on("click",function(){
		var next_index=$(".action_area .sec:last-child").attr("index");
		if(!next_index){
			next_index=0;
		}
		next_index++;

		$.ajax({
			url:$("#url_get_controlleraction").text()+"/"+next_index,
			success:function(htmldata){
				$(".action_area").append(htmldata);
			}
		});
	});

	$("body").on("click",".delete_action",function(){
		var index=$(this).attr("index");
		
		$(".action_area .sec[index="+index+"]").remove();
		
	});

});
</script>