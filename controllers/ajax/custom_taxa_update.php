<?php
// get parameters
$id = mysqli_real_escape_string($db_link, $_POST["id"]);
$col_name = mysqli_real_escape_string($db_link, $_POST["col_name"]);
$value = mysqli_real_escape_string($db_link, $_POST["value"]);

$custom_taxa = new CustomTaxa;
$custom_taxa->update($id, $col_name, $value);
?>