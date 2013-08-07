<?php
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}
// get parameters
$region = mysqli_real_escape_string($db_link, $_POST["region"]);
$year = mysqli_real_escape_string($db_link, $_POST["year"]);
$description = mysqli_real_escape_string($db_link, $_POST["description"]);
$file = $_FILES["upload_file"];
$fqa = new FQADatabase;
$fqa->import_new($region, $year, $description, $file);
?>