<?php
class FQADatabase {

	//
	// constructor
	//
	function FQADatabase() {
		require('lib/fqa_config.php');
		$connection = mysql_connect($db_server, $db_username, $db_password);
		if (!$connection) 
			die('Not connected : ' . mysql_error());
		$db_selected = mysql_select_db($db_database);
		if (!$db_selected) 
			die ('Database error: ' . mysql_error());
	}

	//
	// return a mysql resource with all the fqa databases
	//
	function get_all() {
		$sql = "SELECT * FROM fqa WHERE 1 ORDER BY region_name, publication_year";
		return mysql_query($sql);			 
    }
    

}
?>