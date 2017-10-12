<?php
header('Content-Type: text/csv');
header("Content-Disposition: attachment;filename=".$filename);
$html = mb_convert_encoding($html,'SJIS-win','utf8');

echo $html;
?>