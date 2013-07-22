<?php
session_start(); 
require('../fqa_config.php');
if( !$_SESSION['valid'] ) {
	header( "Location: ../login.php" );
	exit;
} 
$connection = mysql_connect($db_server, $db_username, $db_password);
if (!$connection) 
	die('Not connected : ' . mysql_error());
$db_selected = mysql_select_db($db_database);
if (!$db_selected) 
	die ('Database error: ' . mysql_error());
	
// get original fqa details
$original_fqa_id = mysql_real_escape_string($_GET["id"]);
$sql = "SELECT * FROM fqa WHERE id='$original_fqa_id'";
$fqa_databases = mysql_query($sql);
// if fqa not found redirect user
if (mysql_num_rows($fqa_databases) == 0) {
	header( "Location: view_databases.php" );
	exit;
} 
$original_fqa = mysql_fetch_assoc($fqa_databases);
$region = $original_fqa['region_name'];
$year = $original_fqa['publication_year'];
$description = $original_fqa['description'];

// insert new customized fqa db
$date = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO customized_fqa (fqa_id, region_name, description, publication_year, created, user_id) VALUES ('$original_fqa_id', '$region', '$description', '$year', '$date', '$user_id')";
mysql_query($sql);	
$customized_fqa_id = mysql_insert_id();

// get taxa from original fqa db
$sql = "SELECT * FROM taxa WHERE fqa_id='$original_fqa_id'";
$fqa_taxa = mysql_query($sql);
while ($fqa_taxon = mysql_fetch_assoc($fqa_taxa)) {

	$scientific_name = $fqa_taxon['scientific_name'];
	$family = $fqa_taxon['family'];
	$common_name = $fqa_taxon['common_name'];
	$acronym = $fqa_taxon['acronym'];
	$c_o_c = $fqa_taxon['c_o_c'];
	$c_o_w = $fqa_taxon['c_o_w'];
	$native = $fqa_taxon['native'];
	$physiognomy = $fqa_taxon['physiognomy'];
	$duration = $fqa_taxon['duration'];
 
	// insert taxa into customized_taxa
	// avoid mysql int = null = 0 problem
	if ($c_o_w == null)
		$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, native, physiognomy, duration) VALUES ('$customized_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$native', '$physiognomy', '$duration')";
	else
		$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, c_o_w, native, physiognomy, duration) VALUES ('$customized_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$c_o_w', '$native', '$physiognomy', '$duration')";
	mysql_query($sql);
}
// redirect
header( "Location: ../edit_custom_database.php?id=" . $customized_fqa_id );
?>