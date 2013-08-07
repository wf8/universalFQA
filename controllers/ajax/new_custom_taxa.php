<?php
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}
// get parameters
$custom_fqa_id = mysqli_real_escape_string($db_link, $_POST["custom_fqa_id"]);
$original_fqa_id = mysqli_real_escape_string($db_link, $_POST["original_fqa_id"]);
$scientific_name = mysqli_real_escape_string($db_link, ucfirst(trim($_POST["scientific_name"])));
$family = mysqli_real_escape_string($db_link, ucfirst(trim($_POST["family"])));
$acronym = mysqli_real_escape_string($db_link, strtoupper(trim($_POST["acronym"])));
$native = mysqli_real_escape_string($db_link, strtolower(trim($_POST["native"])));
$c_o_c = mysqli_real_escape_string($db_link, trim($_POST["c_o_c"]));
$c_o_w = mysqli_real_escape_string($db_link, trim($_POST["c_o_w"]));
$physiognomy = mysqli_real_escape_string($db_link, strtolower(trim($_POST["physiognomy"])));
$duration = mysqli_real_escape_string($db_link, strtolower(trim($_POST["duration"])));
$common_name = mysqli_real_escape_string($db_link, strtolower(trim($_POST["common_name"])));
	
$custom_taxa = new CustomTaxa;
$custom_taxa->insert_new($custom_fqa_id, $original_fqa_id, $scientific_name, $family, $common_name, $acronym, $c_o_c, $c_o_w, $native, $physiognomy, $duration);	
?>