		<?php echo $this->Html->link("document read setting",array("controller"=>"_document","action"=>"accounter")); ?>
		<?php echo $this->Html->link("document basic info",array("controller"=>"_document","action"=>"basic")); ?>
		<div id="menustrip">
			<?php
			$checked="";
			if(
			$this->params["action"]=="std" ||
			$this->params["action"]=="std_pagelist"
			){
				$checked="checked";
			}
			?>
			<input type="checkbox" id="do00" class="mchecks" <?php echo $checked; ?>>
			<label for="do00">screen transition diagram</label>
			<div class="menu">
				<?php
				$active="";
				if($this->params["action"]=="std"){
					$active="active";
				}
				echo $this->Html->link("screen transition diagram",array("controller"=>"_document","action"=>"std"),array("class"=>$active));
				$active="";
				if($this->params["action"]=="std_pagelist"){
					$active="active";
				}
				echo $this->Html->link("page list",array("controller"=>"_document","action"=>"std_pagelist"),array("class"=>$active)); ?>
			</div>
		</div>
		<div id="menustrip">
			<?php
			$checked="";
			if(
				$this->params["action"]=="dbr" ||
				$this->params["action"]=="dbr_edit" || 
				$this->params["action"]=="dbr_detail" || 
				$this->params["action"]=="dbr_sqlview" || 
				$this->params["action"]=="dbr_er"
			){
				$checked="checked";
			}
			?>
			<input type="checkbox" id="do01" class="mchecks" <?php echo $checked; ?>>
			<label for="do01">Database reference</label>
			<div class="menu">
				<?php
				$active="";
				if($this->params["action"]=="dbr"){
					$active="active";
				}
				echo $this->Html->link("database reference",array("controller"=>"_document","action"=>"dbr"),array("class"=>$active));
				$active="";
				if($this->params["action"]=="dbr_er"){
					$active="active";
				}
				echo $this->Html->link("E-R graph",array("controller"=>"_document","action"=>"dbr_er"),array("class"=>$active));
				?>
			</div>
		</div>
		<div id="menustrip">
			<input type="checkbox" id="do02" class="mchecks">
			<label for="do02">API reference</label>
			<div class="menu">
				<?php echo $this->Html->link("API reference",array("controller"=>"_document","action"=>"api")); ?>
				<?php echo $this->Html->link("API list",array("controller"=>"_document","action"=>"api_table")); ?>
				<?php // echo $this->Html->link("create API",array("controller"=>"_document","action"=>"api_create")); ?>
			</div>
		</div>
<?php
/*
		<div id="menustrip">
			<input type="checkbox" id="do03" class="mchecks">
			<label for="do03">Flowchart</label>
			<div class="menu">
				<?php echo $this->Html->link("Flowchart list",array("controller"=>"_document","action"=>"flow")); ?>
				<?php // echo $this->Html->link("create Flowchart",array("controller"=>"_document","action"=>"flow_create")); ?>
			</div>
		</div>
*/
?>