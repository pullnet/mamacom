<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_document"); ?>

	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">page list</h1>

				<?php
				$autoRender=array(
					true=>"○",
					false=>"-",
				);
				if(@$ac_list){
				?>
				<table class="mb20 list">
				<tr>
					<th class="w50">No</th>
					<th class="w300">title</th>
					<th class="w100">autoRender</th>
					<th class="w500">URL</th>
					<th>memo..</th>
				</tr>
				<?php
				foreach($ac_list as $c_key=>$a_){
				?>
				<tr>
					<td colspan="5" style="font-weight:bold;padding:10px;"><?php echo $c_key; ?></td>
				</tr>
				<?php
					$count=0;
					foreach($a_ as $aa_){
						$count++;
				?>
				<tr>
					<td class="center"><?php echo $count; ?></td>
					<td><?php echo $aa_["title"]; ?></td>
					<td class="center"><?php echo $autoRender[$aa_["autoRender"]]; ?></td>
					<td><?php echo $this->Html->link($this->params["root"].str_replace("Controller","",$c_key)."/".$aa_["action"],$this->params["root"].str_replace("Controller","",$c_key)."/".$aa_["action"],array("class"=>"underline","target"=>"_blank")); ?></td>
					<td></td>
				</tr>
				<?php
					}
				}
			}
			?>
			</table>
		</div>
	</div>
</div>