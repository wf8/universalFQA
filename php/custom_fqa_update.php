<?php 
session_start(); 
require('fqa_config.php');
if( !$_SESSION['valid'] ) {
	header( "Location: login.php" );
	exit;
} 
$connection = mysql_connect($db_server, $db_username, $db_password);
if (!$connection) 
	die('Not connected : ' . mysql_error());
$db_selected = mysql_select_db($db_database, $connection);
if (!$db_selected) 
	die ('Database error: ' . mysql_error());

// get parameters
$id = mysql_real_escape_string($_GET["id"]);
$name = mysql_real_escape_string($_GET["name"]);
$description = mysql_real_escape_string($_GET["description"]);

$sql = "UPDATE customized_fqa SET customized_name = '$name', customized_description = '$description' WHERE id = '$id'";
mysql_query($sql);
?> 