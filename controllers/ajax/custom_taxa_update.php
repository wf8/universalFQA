<?php
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}

// get parameters
$id = mysqli_real_escape_string($db_link, $_POST["id"]);
$col_name = mysqli_real_escape_string($db_link, $_POST["col_name"]);
$value = mysqli_real_escape_string($db_link, $_POST["value"]);

$custom_taxa = new CustomTaxa;
$custom_taxa->update($id, $col_name, $value);
?>