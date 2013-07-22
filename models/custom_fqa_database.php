<?php
class CustomFQADatabase {

	//
	// constructor
	//
	function CustomFQADatabase() {
		require('lib/fqa_config.php');
		$connection = mysql_connect($db_server, $db_username, $db_password);
		if (!$connection) 
			die('Not connected : ' . mysql_error());
		$db_selected = mysql_select_db($db_database);
		if (!$db_selected) 
			die ('Database error: ' . mysql_error());
	}

	//
	// return a mysql resource with all the user's fqa databases
	//
    function get_all_for_user($user_id) {
	    $sql = "SELECT * FROM customized_fqa WHERE user_id='$user_id' ORDER BY customized_name, region_name, publication_year";
		return mysql_query($sql);			 
    }
    

}
?>