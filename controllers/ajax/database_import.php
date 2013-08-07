<?php
// get parameters
$region = mysqli_real_escape_string($db_link, $_POST["region"]);
$year = mysqli_real_escape_string($db_link, $_POST["year"]);
$description = mysqli_real_escape_string($db_link, $_POST["description"]);
$file = $_FILES["upload_file"];
$fqa = new FQADatabase;
$fqa->import_new($region, $year, $description, $file);
?>