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

// check that values are valid for that column

if ($col_name == 'scientific_name') {

	$value = ucfirst(trim($value));

} else if ($col_name == 'family') {

	$value = ucfirst(trim($value));

} else if ($col_name == 'acronym') {

	$value = strtoupper(trim($value));

} else if ($col_name == 'native') {

	$value = strtolower(trim($value));

} else if ($col_name == 'c_o_c') {

	$value = trim($value);
	if (!is_numeric( $value ) || ($value < 0) || (10 < $value)) {
		echo "Error: The coefficient of conservatism must be an integer from 0-10.";
		exit;
	}

} else if ($col_name == 'c_o_w') {

	$value = trim($value);
	if (!is_numeric( $value ) || ($value < -5) || (5 < $value)) {
		echo "Error: The coefficient of wetness must be an integer betwee -5 and 5.";
		exit;
	}

} else if ($col_name == 'physiognomy') {

	$value = strtolower(trim($value));

} else if ($col_name == 'duration') {

	$value = strtolower(trim($value));

} else if ($col_name == 'common_name') {

	$value = strtolower(trim($value));

}



				// check native/non-native
				if ($native !== 'native' && $native !== 'non-native') {
					$result = "Error: The column native must be either 'native' or 'non-native'.";
					break;
				}
				if ($native == 'native')
					$native = 1;
				if ($native == 'non-native')
					$native = 0;
				// check physiognomy "fern", "forb", "grass", "rush", "sedge", "shrub", "tree", "vine", or "other"
				if (($physiognomy !== '') && ($physiognomy !== 'fern' && $physiognomy !== 'forb' && $physiognomy !== 'grass' && $physiognomy !== 'rush' && $physiognomy !== 'sedge' && $physiognomy !== 'shrub' && $physiognomy !== 'tree' && $physiognomy !== 'vine' && $physiognomy !== 'other')) {
					$result = "Error: Please enter a valid term for physiognomy.";
					break;
				}
				// check duration  "annual", "biennial", or "perennial"
				if (($duration !== '') && ($duration !== 'annual' && $duration !== 'biennial' && $duration !== 'perennial')) {
					$result = "Error: Please enter a valid term for duration (either annual, biennial, or perennial).";
					break;
				}
				// only c_o_w goes in database, not wetness--so make sure they are correct
				if ( $c_o_w == '' && $wet !== '') {
					if ($wet == 'OBL')
						$c_o_w = -5;
					else if ($wet == 'FACW+')
						$c_o_w = -4;
					else if ($wet == 'FACW')
						$c_o_w = -3;
					else if ($wet == 'FACW-')
						$c_o_w = -2;
					else if ($wet == 'FAC+')
						$c_o_w = -1;
					else if ($wet == 'FAC')
						$c_o_w = 0;
					else if ($wet == 'FAC-')
						$c_o_w = 1;
					else if ($wet == 'FACU+')
						$c_o_w = 2;
					else if ($wet == 'FACU')
						$c_o_w = 3;
					else if ($wet == 'FACU-')
						$c_o_w = 4;
					else if ($wet == 'UPL')
						$c_o_w = 5;
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
*/


// value is valid
$sql = "UPDATE customized_taxa SET $col_name = '$value' WHERE id = '$id'";
mysql_query($sql);
echo "success";
?> 