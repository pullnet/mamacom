<?php
if(!@$nofoot){
?>
<div class="footer_dmy"></div>
<div class="footer">
	<ul class="float">
		<a href="index.php" class="icon01 <?php if(@$active_index){ echo "active"; } ?>"></a>
		<a href="category_01.php" class="icon02 <?php if(@$active_category_01){ echo "active"; } ?>"></a>
		<a href="message_list.php" class="icon03 <?php if(@$active_message_list){ echo "active"; } ?>"></a>
		<a href="contact.php" class="icon04 <?php if(@$active_contact){ echo "active"; } ?>"></a>
	</ul>
</div>
<?php
}
?>
</body>
</html>