		<?php
		$checked="";
		if($this->params["action"]=="config"){
			$checked="checked";
		}
		?>
		<div id="menustrip">
				<input type="checkbox" id="oo01" class="mchecks" <?php echo $checked; ?>>
				<label for="oo01">Config</label>
				<div class="menu">
					<?php
					$active="";
					if(@$this->params["names"][0]=="config.php"){
						$active="active";
					}
					echo $this->Html->link("config.php",array("controller"=>"_phpxoven","action"=>"config","config.php"),array("class"=>$active));
					$active="";
					if(@$this->params["names"][0]=="router.php"){
						$active="active";
					}
					echo $this->Html->link("router.php",array("controller"=>"_phpxoven","action"=>"config","router.php"),array("class"=>$active));
					$active="";
					if(@$this->params["names"][0]=="database.php"){
						$active="active";
					}
					echo $this->Html->link("database.php",array("controller"=>"_phpxoven","action"=>"config","database.php"),array("class"=>$active)); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->
		<div id="menustrip">
				<?php
				$checked="";
				if($this->params["action"]=="controller"){
					$checked="checked";
				}
				?>
				<input type="checkbox" id="oo02" class="mchecks" <?php echo $checked; ?>>
				<label for="oo02">Controller</label>
				<div class="menu">
					<?php echo $this->Html->link("Controller List",array("controller"=>"_phpxoven","action"=>"controller")); ?>
					<?php echo $this->Html->link("new create Controller",array("controller"=>"_phpxoven","action"=>"controller","edit")); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->
		<div id="menustrip">
				<input type="checkbox" id="oo03" class="mchecks">
				<label for="oo03">Component</label>
				<div class="menu">
					<?php echo $this->Html->link("Component List",array("controller"=>"_phpxoven","action"=>"component")); ?>
					<?php echo $this->Html->link("new create Component",array("controller"=>"_phpxoven","action"=>"component","edit")); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->
		<div id="menustrip">
				<input type="checkbox" id="oo04" class="mchecks">
				<label for="oo04">Model</label>
				<div class="menu">
					<?php echo $this->Html->link("Model List",array("controller"=>"_phpxoven","action"=>"model")); ?>
					<?php echo $this->Html->link("new create Model",array("controller"=>"_phpxoven","action"=>"model","edit")); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->
		<div id="menustrip">
				<input type="checkbox" id="oo05" class="mchecks">
				<label for="oo05">Helper</label>
				<div class="menu">
					<?php echo $this->Html->link("Helper List",array("controller"=>"_phpxoven","action"=>"helper")); ?>
					<?php echo $this->Html->link("new create Helper",array("controller"=>"_phpxoven","action"=>"helper","edit")); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->
		<div id="menustrip">
				<input type="checkbox" id="oo06" class="mchecks">
				<label for="oo06">Layout</label>
				<div class="menu">
					<?php echo $this->Html->link("Layout List",array("controller"=>"_phpxoven","action"=>"layout")); ?>
					<?php echo $this->Html->link("new create Layout",array("controller"=>"_phpxoven","action"=>"layout","edit")); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->
		<div id="menustrip">
				<input type="checkbox" id="oo07" class="mchecks">
				<label for="oo07">View</label>
				<div class="menu">
					<?php echo $this->Html->link("View List",array("controller"=>"_phpxoven","action"=>"view")); ?>
					<?php echo $this->Html->link("new create View",array("controller"=>"_phpxoven","action"=>"view","edit")); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->
		<div id="menustrip">
				<input type="checkbox" id="oo08" class="mchecks">
				<label for="oo08">Part</label>
				<div class="menu">
					<?php echo $this->Html->link("Part List",array("controller"=>"_phpxoven","action"=>"part")); ?>
					<?php echo $this->Html->link("new create Part",array("controller"=>"_phpxoven","action"=>"part","edit")); ?>
				</div><!--//.menu-->
		</div><!--//#menustrip-->