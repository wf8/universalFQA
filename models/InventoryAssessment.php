<?php
class InventoryAssessment {

	/*
	 * constructor
	 */
	public function __construct() {
		require('lib/fqa_config.php');
		$connection = mysql_connect($db_server, $db_username, $db_password);
		if (!$connection) 
			die('Not connected : ' . mysql_error());
		$db_selected = mysql_select_db($db_database);
		if (!$db_selected) 
			die ('Database error: ' . mysql_error());
	}
	
	/*
	 * return a mysql resource with all the user's assessments
	 */
    public function get_all_for_user($user_id) {
	    $sql = "SELECT * FROM inventory WHERE user_id='$user_id' ORDER BY date";
		return mysql_query($sql);			 
    }
	
	/*
	 * function to update the assessment
	 */
	public function update($id, $name, $description) {
		$sql = "UPDATE customized_fqa SET customized_name = '$name', customized_description = '$description' WHERE id = '$id'";
		mysql_query($sql);
	}
    
    /*
	 * function to insert a new assessment
	 * should return the id of the inserted assessment
	 */
    public function insert_new($original_fqa_id, $region, $description, $year) {
		$date = date('Y-m-d');
		$user_id = $_SESSION['user_id'];
		$sql = "INSERT INTO customized_fqa (fqa_id, region_name, description, publication_year, created, user_id) VALUES ('$original_fqa_id', '$region', '$description', '$year', '$date', '$user_id')";
		mysql_query($sql);	
		return mysql_insert_id();
	}
	
	/*
	 * delete the assessment
	 */
	public function delete($id) {
		$sql = "DELETE FROM customized_fqa WHERE id='$id'";
		mysql_query($sql);
		$sql = "DELETE FROM customized_taxa WHERE customized_fqa_id='$id'";
		mysql_query($sql);
	}
	
	
}
?>