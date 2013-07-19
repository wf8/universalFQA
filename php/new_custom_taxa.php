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
$custom_fqa_id = mysql_real_escape_string($_GET["custom_fqa_id"]);
$original_fqa_id = mysql_real_escape_string($_GET["original_fqa_id"]);
$scientific_name = mysql_real_escape_string(ucfirst(trim($_GET["scientific_name"])));
$family = mysql_real_escape_string(ucfirst(trim($_GET["family"])));
$acronym = mysql_real_escape_string(strtoupper(trim($_GET["acronym"])));
$native = mysql_real_escape_string(strtolower(trim($_GET["native"])));
$c_o_c = mysql_real_escape_string(trim($_GET["c_o_c"]));
$c_o_w = mysql_real_escape_string(trim($_GET["c_o_w"]));
$physiognomy = mysql_real_escape_string(strtolower(trim($_GET["physiognomy"])));
$duration = mysql_real_escape_string(strtolower(trim($_GET["duration"])));
$common_name = mysql_real_escape_string(strtolower(trim($_GET["common_name"])));

// check that c_o_c and c_o_w are integers
if (!is_numeric( $c_o_c ) || ($c_o_c < 0) || (10 < $c_o_c)) {
	echo "Error: The coefficient of conservatism must be an integer from 0-10.";
	exit;
}
if (($c_o_w !== '') && (!is_numeric( $c_o_w ) || ($c_o_w < -5) || (5 < $c_o_w))) {
	echo "Error: The coefficient of wetness must be an integer between -5 and 5.";
	exit;
}
// check native/non-native
if ($native !== 'native' && $native !== 'non-native') {
	echo "Error: The column native must be either 'native' or 'non-native'.";
	exit;
}
if ($native == 'native')
	$native = 1;
if ($native == 'non-native')
	$native = 0;
// check physiognomy "fern", "forb", "grass", "rush", "sedge", "shrub", "tree", "vine", or "other"
if (($physiognomy !== '') && ($physiognomy !== 'fern' && $physiognomy !== 'forb' && $physiognomy !== 'grass' && $physiognomy !== 'rush' && $physiognomy !== 'sedge' && $physiognomy !== 'shrub' && $physiognomy !== 'tree' && $physiognomy !== 'vine' && $physiognomy !== 'other')) {
	echo "Error: Please enter a valid term for physiognomy.";
	exit;
}
// check duration  "annual", "biennial", or "perennial"
if (($duration !== '') && ($duration !== 'annual' && $duration !== 'biennial' && $duration !== 'perennial')) {
	echo "Error: Please enter a valid term for duration (either annual, biennial, or perennial).";
	exit;
}
if ($family == '')
	$family = null;
if ($acronym == '')
	$acronym = null;
if ($common_name == '')
	$common_name = null;
if ($c_o_w == '')
	$c_o_w = null;
if ($physiognomy == '')
	$physiognomy = null;
if ($duration == '')
	$duration = null;
// do not insert if there is already a taxa with this sci name for this fqa db
$sql = "SELECT * FROM customized_taxa WHERE scientific_name='$scientific_name' AND customized_fqa_id='$custom_fqa_id'";
$existing_taxa = mysql_query($sql);
if (mysql_num_rows($existing_taxa) == 0) {
	// avoid mysql int = null = 0 problem
	if ($c_o_w == null)
		$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, native, physiognomy, duration) VALUES ('$custom_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$native', '$physiognomy', '$duration')";
	else
		$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, c_o_w, native, physiognomy, duration) VALUES ('$custom_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$c_o_w', '$native', '$physiognomy', '$duration')";
	mysql_query($sql);
	echo "success";
} else {
	echo "Error: a taxa with that scientific name already exists for this database.";
	exit;
}
?>