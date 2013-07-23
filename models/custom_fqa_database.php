<?php
class CustomFQADatabase {

	/*
	 * constructor
	 */
	function CustomFQADatabase() {
		require('lib/fqa_config.php');
		$connection = mysql_connect($db_server, $db_username, $db_password);
		if (!$connection) 
			die('Not connected : ' . mysql_error());
		$db_selected = mysql_select_db($db_database);
		if (!$db_selected) 
			die ('Database error: ' . mysql_error());
	}

    /*
	 * return a mysql resource for the custom fqa database with id
	 */
	function get_fqa($id) {
    	$sql = "SELECT * FROM customized_fqa WHERE id='$id'";
		return mysql_query($sql);
	}
	
	/*
	 * function to update fqa database details
	 */
	function update($id, $name, $description) {
		$sql = "UPDATE customized_fqa SET customized_name = '$name', customized_description = '$description' WHERE id = '$id'";
		mysql_query($sql);
	}
	
	/*
	 * return a mysql resource for all the taxa associated with fqa database id
	 */
	function get_taxa($id) {
		$sql = "SELECT * FROM customized_taxa WHERE customized_fqa_id='$id' ORDER BY scientific_name";
		return mysql_query($sql);
    }

	/*
	 * return a mysql resource with all the user's fqa databases
	 */
    function get_all_for_user($user_id) {
	    $sql = "SELECT * FROM customized_fqa WHERE user_id='$user_id' ORDER BY customized_name, region_name, publication_year";
		return mysql_query($sql);			 
    }
    
    /*
	 * function to insert a new custom database
	 * should return the id of the inserted db
	 */
    function insert_new($original_fqa_id, $region, $description, $year) {
		$date = date('Y-m-d');
		$user_id = $_SESSION['user_id'];
		$sql = "INSERT INTO customized_fqa (fqa_id, region_name, description, publication_year, created, user_id) VALUES ('$original_fqa_id', '$region', '$description', '$year', '$date', '$user_id')";
		mysql_query($sql);	
		return mysql_insert_id();
	}
	
	/*
	 * delete the database and all its taxa
	 */
	function delete($id) {
		$sql = "DELETE FROM customized_fqa WHERE id='$id'";
		mysql_query($sql);
		$sql = "DELETE FROM customized_taxa WHERE customized_fqa_id='$id'";
		mysql_query($sql);
	}
	
	/*
	 * function to insert taxa for a new custom db. takes the custom db id and a hook to
	 * the mysql resource of all the taxa in the original db.
	 */
	function insert_taxa($customized_fqa_id, $original_fqa_id, $fqa_taxa) {
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
	}
	
	
}
?>