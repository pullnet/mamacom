<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_document"); ?>

	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">document read setting</h1>
			<?php echo $this->Form->create("Document"); ?>

			<table class="mb30">
			<tr>
				<th>Account username</th>
				<td>
					<?php echo $this->Form->input("username",array("class"=>"w300")); ?>
				</td>
			</tr>
			<tr>
				<th>Account password</th>
				<td>
					<?php echo $this->Form->input("password",array("type"=>"password","class"=>"w300")); ?>
				</td>
			</tr>
			</table>

			<div class="center">
				<?php echo $this->Form->submit("Document account save",array("class"=>"buttons big add")); ?>
			</div>

			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>