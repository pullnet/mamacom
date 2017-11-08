<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_oven"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">Config - database.php - edit</h1>
			
			<?php echo $this->Form->create("Config_databas"); ?>
			
			<table class="mb20">
			<tr>
				<th>database area name</th>
				<td>
					<?php
					echo $this->Form->input("area_name",array("class"=>"w300","placeholder"=>"example : default"));
					echo $this->Html->active(@$errors["Config"]["area_name"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>database name</th>
				<td>
					<?php
					echo $this->Form->input("db_name",array("class"=>"w500","placeholder"=>"example : database_01"));
					echo $this->Html->active(@$errors["Config"]["db_name"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>host</th>
				<td>
					<?php
					echo $this->Form->input("host",array("class"=>"w500","placeholder"=>"example : localhost"));
					echo $this->Html->active(@$errors["Config"]["host"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>port</th>
				<td>
					<?php
					echo $this->Form->input("port",array("type"=>"number","class"=>"w100"));
					echo $this->Html->active(@$errors["Config"]["port"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>access username</th>
				<td>
					<?php
					echo $this->Form->input("username",array("class"=>"w300","placeholder"=>"example : username"));
					echo $this->Html->active(@$errors["Config"]["username"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>access password</th>
				<td>
					<?php
					echo $this->Form->input("password",array("class"=>"w300"));
					echo $this->Html->active(@$errors["Config"]["password"],array("class"=>"error-message"));
					?>
				</td>
			</tr>
			<tr>
				<th>text encoding</th>
				<td>
					<?php
					$encoding=array(
						"utf8"=>"utf8",
						"utf8mb4"=>"utf8mb4",
					);
					echo $this->Form->select("encoding",$encoding,array("class"=>"w150")); ?>
				</td>
			</tr>
			</table>
			
			<div class="center">
				<?php echo $this->Form->submit("database save",array("class"=>"buttons big add")); ?>
			</div>
			
			<?php echo $this->Form->end(); ?>
			
		</div>
	</div>
</div>
			