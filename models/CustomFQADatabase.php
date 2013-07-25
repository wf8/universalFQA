<?php
class CustomFQADatabase {

	protected $db_link;
	
	/*
	 * constructor
	 */
	public function __construct() {
		require('../config/db_config.php');
		$this->db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno($this->db_link)) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

    /*
	 * return a mysql resource for the custom fqa database with id
	 */
	public function get_fqa($id) {
    	$sql = "SELECT * FROM customized_fqa WHERE id='$id'";
		return mysqli_query($this->db_link, $sql);
	}
	
	/*
	 * function to update fqa database details
	 */
	public function update($id, $name, $description) {
		$sql = "UPDATE customized_fqa SET customized_name = '$name', customized_description = '$description' WHERE id = '$id'";
		mysqli_query($this->db_link, $sql);
	}
	
	/*
	 * return a mysql resource for all the taxa associated with fqa database id
	 */
	public function get_taxa($id) {
		$sql = "SELECT * FROM customized_taxa WHERE customized_fqa_id='$id' ORDER BY scientific_name";
		return mysqli_query($this->db_link, $sql);
    }
    
    /*
	 * return an array with all scientific names in fqa database id
	 */
	public function get_scientific_names($id) {
		$sql = "SELECT scientific_name FROM customized_taxa WHERE customized_fqa_id='$id' ORDER BY scientific_name";
		$result = mysqli_query($this->db_link, $sql);
		$array_to_return = array();
		while($row = mysqli_fetch_array($result))	{
    		if ($row['scientific_name'] !== '')
    			$array_to_return[] = $row['scientific_name'];
		}
		return $array_to_return;
    }
    
    /*
	 * return an array with all acronyms in fqa database id
	 */
	public function get_acronyms($id) {
		$sql = "SELECT acronym FROM customized_taxa WHERE customized_fqa_id='$id' ORDER BY acronym";
		$result = mysqli_query($this->db_link, $sql);
		$array_to_return = array();
		while($row = mysqli_fetch_array($result))	{
			if ($row['acronym'] !== '')
    			$array_to_return[] = $row['acronym'];
		}
		return $array_to_return;
    }
    
    /*
	 * return an array with all common names in fqa database id
	 */
	public function get_common_names($id) {
		$sql = "SELECT common_name FROM customized_taxa WHERE customized_fqa_id='$id' ORDER BY common_name";
		$result = mysqli_query($this->db_link, $sql);
		$array_to_return = array();
		while($row = mysqli_fetch_array($result))	{
			if ($row['common_name'] !== '') { 
				$common_name = $row['common_name'];
				$common_name = str_replace("'", "", $common_name);
    			$array_to_return[] = $common_name;
    		}
		}
		return $array_to_return;
    }

	/*
	 * return a mysql resource with all the user's fqa databases
	 */
    public function get_all_for_user($user_id) {
	    $sql = "SELECT * FROM customized_fqa WHERE user_id='$user_id' ORDER BY customized_name, region_name, publication_year";
		return mysqli_query($this->db_link, $sql);			 
    }
    
    /*
	 * function to insert a new custom database
	 * should return the id of the inserted db
	 */
    public function insert_new($original_fqa_id, $region, $description, $year) {
		$date = date('Y-m-d');
		$user_id = $_SESSION['user_id'];
		$sql = "INSERT INTO customized_fqa (fqa_id, region_name, description, publication_year, created, user_id) VALUES ('$original_fqa_id', '$region', '$description', '$year', '$date', '$user_id')";
		mysqli_query($this->db_link, $sql);	
		return mysqli_insert_id();
	}
	
	/*
	 * delete the database and all its taxa
	 */
	public function delete($id) {
		$sql = "DELETE FROM customized_fqa WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM customized_taxa WHERE customized_fqa_id='$id'";
		mysqli_query($this->db_link, $sql);
	}
	
	/*
	 * function to insert taxa for a new custom db. takes the custom db id and a hook to
	 * the mysql resource of all the taxa in the original db.
	 */
	public function insert_taxa($customized_fqa_id, $original_fqa_id, $fqa_taxa) {
		while ($fqa_taxon = mysqli_fetch_assoc($fqa_taxa)) {
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
			mysqli_query($this->db_link, $sql);
		}
	}
	
	
}
?>