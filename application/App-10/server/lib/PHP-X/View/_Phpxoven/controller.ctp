<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_oven"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">Controller list</h1>
			
			<div class="mb20">
				<?php echo $this->Html->link("new create Controller",array("controller"=>"_phpxoven","action"=>"controller","edit"),array("class"=>"buttons new")); ?>
			</div>
			
		</div>
	</div>
</div>
			