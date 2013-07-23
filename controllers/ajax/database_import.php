<?php
// get parameters
$region = mysql_real_escape_string($_POST["region"]);
$year = mysql_real_escape_string($_POST["year"]);
$description = mysql_real_escape_string($_POST["description"]);
$file = $_FILES["upload_file"];
$fqa = new FQADatabase;
$fqa->import_new($region, $year, $description, $file);
?>