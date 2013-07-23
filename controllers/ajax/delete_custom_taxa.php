<?php
$id = mysql_real_escape_string($_POST["id"]);
$custom_taxa = new CustomTaxa;
$custom_taxa->delete($id);
?>