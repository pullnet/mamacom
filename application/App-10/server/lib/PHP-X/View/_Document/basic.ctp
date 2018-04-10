<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_document"); ?>

	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">document basic info</h1>
			<?php echo $this->Form->create("Document"); ?>

			<table class="mb30">
			<tr>
				<th>Project Title</th>
				<td>
					<?php echo $this->Form->input("title",array("class"=>"w500")); ?>
				</td>
			</tr>
			<tr>
				<th>Corporate name</th>
				<td>
					<?php echo $this->Form->input("corporate_name",array("class"=>"w500")); ?>
				</td>
			</tr>
			<tr>
				<th>project Responsible</th>
				<td>
					<?php echo $this->Form->input("project_responsible",array("class"=>"w200")); ?>
				</td>
			</tr>
			<tr>
				<th>project caption</th>
				<td>
					<?php echo $this->Form->textarea("caption",array("type"=>"password","class"=>"h300")); ?>
				</td>
			</tr>
			</table>

			<div class="center">
				<?php echo $this->Form->submit("Document basic save",array("class"=>"buttons big add")); ?>
			</div>

			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>