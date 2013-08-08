<?php
header('Content-Description: File Download');
header("Cache-Control: no-store, no-cache");
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=FQA_report.csv");
header("Pragma: no-cache");
header("Expires: 0");
header('Content-Length: ' . strlen(stripslashes($_POST['download_csv'])));
echo stripslashes($_POST['download_csv']);
exit;
?>