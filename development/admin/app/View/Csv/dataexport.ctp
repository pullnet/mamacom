<?php
header('Content-Type: text/html');
header("Content-Disposition: attachment;filename=".$filename);
$html = mb_convert_encoding($html,"Shift-jis");//csvの日本語文字化け対策用

echo $html;
?>