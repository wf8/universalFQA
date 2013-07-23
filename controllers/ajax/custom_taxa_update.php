<?php
// get parameters
$id = mysql_real_escape_string($_POST["id"]);
$col_name = mysql_real_escape_string($_POST["col_name"]);
$value = mysql_real_escape_string($_POST["value"]);

$custom_taxa = new CustomTaxa;
$custom_taxa->update($id, $col_name, $value);
?>