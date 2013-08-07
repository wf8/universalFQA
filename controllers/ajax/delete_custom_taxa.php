<?php
$id = mysqli_real_escape_string($db_link, $_POST["id"]);
$custom_taxa = new CustomTaxa;
$custom_taxa->delete($id);
?>