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
$db_selected = mysql_select_db($db_database, $connection);
if (!$db_selected) 
	die ('Database error: ' . mysql_error());

// get parameters
$region = mysql_real_escape_string($_POST["region"]);
$year = mysql_real_escape_string($_POST["year"]);
$description = mysql_real_escape_string($_POST["description"]);

$result = "";
if (!is_numeric( $year ) || ($year < 1950) || (3000 < $year)) {
	$result = "Error: Please enter a valid year.";
} else if ($_FILES["upload_file"]["error"] == 4)
	$result = "Error: Please select a file.";
else if ($_FILES["upload_file"]["error"] > 0)
	$result = "Error: " . $_FILES["upload_file"]["error"];
else if	($_FILES["upload_file"]["size"] > 10490000) // 1.049e+7 bytes = 10 mb restriction
	$result = "Error: File must be under 10 mb.";
else {
	if (($handle = fopen($_FILES['upload_file']['tmp_name'], "r")) !== FALSE) {
		$taxa_inserted = 0;
		$new_fqa = true;
		while (($data = fgetcsv($handle, 0, ",", '"')) !== FALSE) {
			if ($new_fqa == true) {
				$new_fqa = false;
				// do not insert if there is already an FQA database with that region and year
				$sql = "SELECT * FROM fqa WHERE region_name='$region' AND publication_year='$year'";
				$existing_fqa = mysql_query($sql);
				if (mysql_num_rows($existing_fqa) == 0) {
					$date = date('Y-m-d');
					$user_id = $_SESSION['user_id'];
					$sql = "INSERT INTO fqa (region_name, description, publication_year, created, user_id) VALUES ('$region', '$description', '$year', '$date', '$user_id')";
					mysql_query($sql);	
					$fqa_id = mysql_insert_id();
				} else {
					$result = "Error: An FQA database for that region and year already exist.";
					break;
				}
			}
			// skip the header row
			if (trim(strtolower($data[0])) !== "scientific name") {
				//scientific name, family, acronym, nativity, coefficient of conservatism, coefficient of wetness, physiognomy, duration, common name
				$scientific_name = mysql_real_escape_string(ucfirst(trim($data[0])));
				$family = mysql_real_escape_string(ucfirst(trim($data[1])));
				$acronym = mysql_real_escape_string(strtoupper(trim($data[2])));
				$native = mysql_real_escape_string(strtolower(trim($data[3])));
				$c_o_c = mysql_real_escape_string(trim($data[4]));
				$c_o_w = mysql_real_escape_string(trim($data[5]));
				$physiognomy = mysql_real_escape_string(strtolower(trim($data[7])));
				$duration = mysql_real_escape_string(strtolower(trim($data[8])));
				$common_name = mysql_real_escape_string(strtolower(trim($data[9])));
				// check that scientific name has been entered
				if (strlen($scientific_name) < 4) {
					$result = "Error: Please enter a valid scientific name.";
					break;
				}
				// check that c_o_c and c_o_w are integers
				if (!is_numeric( $c_o_c ) || ($c_o_c < 0) || (10 < $c_o_c)) {
					$result = "Error: The coefficient of conservatism must be an integer from 0-10.";
					break;
				}
				if (($c_o_w !== '') && (!is_numeric( $c_o_w ) || ($c_o_w < -5) || (5 < $c_o_w))) {
					$result = "Error: The coefficient of wetness must be an integer between -5 and 5.";
					break;
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
				/*******
				removed wetness column from imported spreadsheets
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
				*/
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
				$sql = "SELECT * FROM taxa WHERE scientific_name='$scientific_name' AND fqa_id='$fqa_id'";
				$existing_taxa = mysql_query($sql);
				if (mysql_num_rows($existing_taxa) == 0) {
					// avoid mysql int = null = 0 problem
					if ($c_o_w == null)
						$sql = "INSERT INTO taxa (fqa_id, scientific_name, family, common_name, acronym, c_o_c, native, physiognomy, duration) VALUES ('$fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$native', '$physiognomy', '$duration')";
					else
						$sql = "INSERT INTO taxa (fqa_id, scientific_name, family, common_name, acronym, c_o_c, c_o_w, native, physiognomy, duration) VALUES ('$fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$c_o_w', '$native', '$physiognomy', '$duration')";
					mysql_query($sql);
					$taxa_inserted++;
				}	
			}
		}
		if ($result == "") {
			$message = "Successfully inserted new " . $region . ", " . $year . " FQA database with " . $taxa_inserted . " taxa.";
			mail('willfreyman@gmail.com', 'FQA: new database', $message);
			$result = $fqa_id . "";
		} else {
			// delete any partially inserted databases
			$sql = "DELETE FROM fqa WHERE id='$fqa_id'";
			mysql_query($sql);
			$sql = "DELETE FROM taxa WHERE fqa_id='$fqa_id'";
			mysql_query($sql);
		}
	}
}
?> 
<html>
<head>
<script language="javascript" type="text/javascript">
	var result = <?= json_encode($result); ?>;
	window.top.window.stop_database_upload(result);
</script>
</head>
<body></body>
</html>