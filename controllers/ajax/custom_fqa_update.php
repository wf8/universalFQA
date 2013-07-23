<?php
// get parameters
$id = mysql_real_escape_string($_POST["id"]);
$name = mysql_real_escape_string($_POST["name"]);
$description = mysql_real_escape_string($_POST["description"]);
$fqa = new CustomFQADatabase;
$fqa->update($id, $name, $description);
?>