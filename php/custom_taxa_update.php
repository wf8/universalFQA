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
$col_name = mysql_real_escape_string($_GET["col_name"]);
$value = mysql_real_escape_string($_GET["value"]);

// check that values are valid for the column
if ($col_name == 'scientific_name') {
	$value = ucfirst(trim($value));
} else if ($col_name == 'family') {
	$value = ucfirst(trim($value));
	if ($value == '')
		$value = null;
} else if ($col_name == 'acronym') {
	$value = strtoupper(trim($value));
	if ($value == '')
		$value = null;
} else if ($col_name == 'native') {
	$value = strtolower(trim($value));
	if ($value !== 'native' && $value !== 'non-native') {
		echo "Error: The column native must be either 'native' or 'non-native'.";
		exit;
	} 
	if ($value == 'native')
		$value = 1;
	if ($value == 'non-native')
		$value = 0;
} else if ($col_name == 'c_o_c') {
	$value = trim($value);
	if (!is_numeric( $value ) || ($value < 0) || (10 < $value)) {
		echo "Error: The coefficient of conservatism must be an integer from 0-10.";
		exit;
	}
} else if ($col_name == 'c_o_w') {
	$value = trim($value);
	if (($value !== '') && !is_numeric( $value ) || ($value < -5) || (5 < $value)) {
		echo "Error: The coefficient of wetness must be an integer betwee -5 and 5.";
		exit;
	}
	if ($value == '')
		$value = null;
} else if ($col_name == 'physiognomy') {
	$value = strtolower(trim($value));
	// check physiognomy "fern", "forb", "grass", "rush", "sedge", "shrub", "tree", "vine", or "other"
	if (($value !== '') && ($value !== 'fern' && $value !== 'forb' && $value !== 'grass' && $value !== 'rush' && $value !== 'sedge' && $value !== 'shrub' && $value !== 'tree' && $value !== 'vine' && $value !== 'other')) {
		echo "Error: Please enter a valid term for physiognomy.";
		exit;
	}
	if ($value == '')
		$value = null;
} else if ($col_name == 'duration') {
	$value = strtolower(trim($value));
	// check duration  "annual", "biennial", or "perennial"
	if (($value !== '') && ($value !== 'annual' && $value !== 'biennial' && $value !== 'perennial')) {
		echo "Error: Please enter a valid term for duration (either annual, biennial, or perennial).";
		exit;
	}
	if ($value == '')
		$value = null;
} else if ($col_name == 'common_name') {
	$value = strtolower(trim($value));
	if ($value == '')
		$value = null;
}
// value is valid so update
// check for null integer in c_o_w
if ($col_name == 'c_o_w' && $value == '') 
	$sql = "UPDATE customized_taxa SET $col_name = NULL WHERE id = '$id'";
else
	$sql = "UPDATE customized_taxa SET $col_name = '$value' WHERE id = '$id'";
mysql_query($sql);
echo "success";
?> 