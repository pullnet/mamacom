<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_document"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">database reference</h1>
			<div class="mb10 no_printed">
				<?php echo $this->Html->link("sql code download",array("controller"=>"_document","action"=>"dbr_down"),array("class"=>"buttons")); ?>
				<?php echo $this->Html->link("sql code view",array("controller"=>"_document","action"=>"dbr_sqlview"),array("class"=>"buttons")); ?>
			</div>
			<?php
			if(@$params_default){
				foreach($params_default as $db_name=>$p_){
			?>
			<table class="mb20">
			<tr>
				<td>
					<p class="inline-block h4"><?php echo $db_name; ?></p>
					<p class="inline-block"><?php echo nl2br(h($p_["title"])); ?></p>
					<?php echo $p_["encoding"]; ?>
				</td>
			</tr>
			<tr>
				<th>table list</th>
			</tr>
			<tr>
				<td>
					<?php
					if(@$p_["Table"]){
					?>
					<table class="list">
					<tr>
						<th class="w50">No</th>
						<th class="w200">name</th>
						<th class="w150">table name</th>
						<th>memo</th>
					</tr>
					<?php
					$count=0;
					foreach($p_["Table"] as $pp_){
						$count++;
					?>
					<tr>
						<td class="center"><?php echo $count; ?></td>
						<td><?php echo $this->Html->link($pp_["title"],array("controller"=>"_document","action"=>"dbr_detail",$db_name,$pp_["name"]),array("class"=>"underline")); ?></td>
						<td><?php echo $pp_["name"]; ?></td>
						<td><p style="overflow:hidden;height:1.5em;line-height:1.5em;"><?php echo $pp_["caption"]; ?></p></td>
					</tr>
					<?php
					}
					?>
					</table>
					<?php
					}
					?>
				</td>
			</tr>
			</table>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>