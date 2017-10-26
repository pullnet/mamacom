<?php
function error($main,$caption){
	echo '<div style="font-size:20px">'.$main."</div>";
	echo "<div style='font-size:13px'><span>".$caption."</span></div>";
	$dbt=debug_backtrace();
	?>
	<ul style="margin:10px 0px">
	<?php

	foreach($dbt as $d_){
	?>
		<li>・<?php echo $d_["file"]; ?> Line:<?php echo $d_["line"]; ?></li>
	<?php
	}
	?>
	</ul>
	<?php
}
?>