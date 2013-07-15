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
$region = mysql_real_escape_string($_POST["region"]);
$year = mysql_real_escape_string($_POST["year"]);
$description = mysql_real_escape_string($_POST["description"]);

if ($_FILES["upload_file"]["error"] == 4)
	$result = "Error: Please select a file.";
else if ($_FILES["upload_file"]["error"] > 0)
	$result = "Error: " . $_FILES["upload_file"]["error"];
else if	($_FILES["upload_file"]["size"] > 10490000) // 1.049e+7 bytes = 10 mb restriction
		$result = "Error: File must be under 10 mb.";
else {
	if (($handle = fopen($_FILES['upload_file']['tmp_name'], "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 0, ",", '"')) !== FALSE) {
			// do not insert if there is already an FQA database with that region and year
			// WORK HERE!!
			// $sql = "SELECT * FROM observations WHERE location_id='$data[0]' AND year='$data[17]'";
			// $existing_observation = mysql_query($sql);
			if (mysql_num_rows($existing_observation) == 0) {
				// skip the header row
				if (trim($data[0]) !== "scientific name") {
					// $sql="INSERT INTO observations (location_id, percent_grass, percent_forbs, grass_to_forb_ration, percent_rosa, percent_woody_knee, percent_woody_knee_waist, percent_woody_1_meter, percent_woody_waist_head, percent_woody_head, percent_woody_total, bl_ss_habitat_suitability, m_habitat_suitability, gs_habitat_suitability, 4_spp_habitat_suitability, comments, date_recorded, year) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]', '$data[13]', '$data[14]', '$data[15]', '$data[16]', '$data[17]')";
					// WORK HERE!!
					//
					mysql_query($sql);	
				}
			} else {
				$result = "Error: An FQA database for that region and year already exist.";
				break;
			}
		}
		fclose($handle);
		$result = "";
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