<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_oven"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">Config - router.php - edit</h1>
	
			<?php echo $this->Form->create("Config"); ?>
			
			<table class="mb20">
			<tr>
				<th>routing URL</th>
				<td>
					<?php
					echo $this->Form->input("routing_url",array("class"=>"w500","plcaholder"=>"example : /aaaa/bbbb"));
					echo $this->Html->active(@$errors["Config"]["routing_url"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>controller</th>
				<td>
					<?php
					echo $this->Form->input("controller",array("class"=>"w200","plcaholder"=>"example : /aaaa/bbbb"));
					echo $this->Html->active(@$errors["Config"]["controller"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>action</th>
				<td>
					<?php
					echo $this->Form->input("action",array("class"=>"w200","plcaholder"=>"example : /aaaa/bbbb"));
					echo $this->Html->active(@$errors["Config"]["controller"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			</table>
			
			<div class="center">
				<?php echo $this->Form->submit("routing save",array("class"=>"buttons big add")); ?>
			</div>
			
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
			