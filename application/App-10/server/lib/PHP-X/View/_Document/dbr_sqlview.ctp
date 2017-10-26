<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_document"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">database sql code</h1>

			<div class="mb10">
				<?php echo $this->Html->link("sql code download",array("controller"=>"_document","action"=>"dbr_down"),array("class"=>"buttons")); ?>
			</div>

			<h2>SQL code</h2>
			<div style="background:#444;padding:20px;padding-bottom:10px;" class="mb20"><p style="color:#fff" class="h4"><?php echo nl2br($sql_code); ?></p></div>

		</div>
	</div>
</div>