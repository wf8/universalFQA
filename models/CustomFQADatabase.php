<?php
class CustomFQADatabase extends FQADatabase {
	
	public $fqa_id;
	public $customized_name;
	public $customized_description;
	
	/*
	 * constructor
	 */
	public function __construct( $id = null ) {
		if ($id !== null) {
			$this->get_db_link();
			$sql = "SELECT * FROM customized_fqa WHERE id='$id'";
			$fqa_result = mysqli_query($this->db_link, $sql);
			$fqa = mysqli_fetch_array($fqa_result);
			$this->id = $id;
			$this->fqa_id = $fqa['fqa_id'];
			$this->region_name = $fqa['region_name'];
			$this->publication_year = $fqa['publication_year'];
			$this->description = $fqa['description'];
			$this->customized_name = $fqa['customized_name'];
			$this->customized_description = $fqa['customized_description'];
			$this->get_states($id, $this->db_link, 1);
			$this->get_ecoregions($id, $this->db_link, 1);
			$this->make_selection_display_name($this->customized_name);
		}
	}

    /*
	 * return a mysql resource for the custom fqa database with id
	 */
	public function get_fqa($id) {
		$this->get_db_link();
		$sql = "SELECT * FROM customized_fqa WHERE id='$id'";
		$fqa_result = mysqli_query($this->db_link, $sql);
		$custom_fqa = NULL;
		if (mysqli_num_rows($fqa_result) !== 0) {
			$fqa_row = mysqli_fetch_array($fqa_result);
			$custom_fqa = new CustomFQADatabase();
			$custom_fqa->id = $id;
			$custom_fqa->fqa_id = $fqa_row['fqa_id'];
			$custom_fqa->region_name = $fqa_row['region_name'];
			$custom_fqa->publication_year = $fqa_row['publication_year'];
			$custom_fqa->description = $fqa_row['description'];
			$custom_fqa->customized_name = $fqa_row['customized_name'];
			$custom_fqa->customized_description = $fqa_row['customized_description'];
			$custom_fqa->get_states($id, $this->db_link, 1);
			$custom_fqa->get_ecoregions($id, $this->db_link, 1);
			$custom_fqa->make_selection_display_name($this->customized_name);
		}
		return $custom_fqa;
	}
	
	/*
	 * function to update fqa database details
	 */
	public function update($id, $name, $description, $states, $ecoregions) {
		$this->get_db_link();
		$sql = "UPDATE customized_fqa SET customized_name = '$name', customized_description = '$description' WHERE id = '$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM fqa_states WHERE fqa_id = '$id' AND is_custom_fqa = '1'";
		mysqli_query($this->db_link, $sql);	
		foreach ($states as $state) {
		  $sql = "INSERT INTO fqa_states (fqa_id, state_id, is_custom_fqa) VALUES ('$id', '$state', '1')";
			mysqli_query($this->db_link, $sql);	
		}
		$sql = "DELETE FROM fqa_ecoregions WHERE fqa_id = '$id' AND is_custom_fqa = '1'";
		mysqli_query($this->db_link, $sql);	
		foreach ($ecoregions as $ecoregion) {
		  $sql = "INSERT INTO fqa_ecoregions (fqa_id, ecoregion_id, is_custom_fqa) VALUES ('$id', '$ecoregion', '1')";
			mysqli_query($this->db_link, $sql);	
		}
	}
	
	/*
	 * return a mysql resource for all the taxa associated with fqa database id
	 */
	public function get_taxa($id) {
		$this->get_db_link();
		$sql = "SELECT * FROM customized_taxa WHERE customized_fqa_id='$id' ORDER BY scientific_name";
		return mysqli_query($this->db_link, $sql);
    }
    
    /*
	 * return an array with all scientific names in fqa database id
	 */
	public function get_scientific_names($id) {
		$this->get_db_link();
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
		$this->get_db_link();
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
		$this->get_db_link();
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
    	$this->get_db_link();
	    $sql = "SELECT * FROM customized_fqa WHERE user_id='$user_id' ORDER BY customized_name, region_name, publication_year";
			$query_return = mysqli_query($this->db_link, $sql);
			$return_fqa_databases = array();
			if (mysqli_num_rows($query_return) !== 0) {
				while ($fqa_database = mysqli_fetch_assoc($query_return)) {
					$new_fqa_db = new CustomFQADatabase();
					$new_fqa_db->id = $fqa_database['id'];
					$new_fqa_db->fqa_id = $fqa_database['fqa_id'];
					$new_fqa_db->region_name = $fqa_database['region_name'];
					$new_fqa_db->publication_year = $fqa_database['publication_year'];
					$new_fqa_db->description = $fqa_database['description'];
					$new_fqa_db->customized_name = $fqa_database['customized_name'];
					$new_fqa_db->customized_description = $fqa_database['customized_description'];
					$new_fqa_db->get_states($new_fqa_db->id, $this->db_link, 1);
					$new_fqa_db->get_ecoregions($new_fqa_db->id, $this->db_link, 1);
					$new_fqa_db->make_selection_display_name($new_fqa_db->customized_name);
					$return_fqa_databases[$new_fqa_db->id] = $new_fqa_db;
				}
			}
			mysqli_close($this->db_link);
			return $return_fqa_databases;
    }
    
    /*
	 * function to insert a new custom database
	 * should return the id of the inserted db
	 */
    public function insert_new($original_fqa_id, $region, $description, $year) {
    	$this->get_db_link();
		$date = date('Y-m-d');
		$user_id = $_SESSION['user_id'];
		$sql = "INSERT INTO customized_fqa (fqa_id, region_name, description, publication_year, created, user_id) VALUES ('$original_fqa_id', '$region', '$description', '$year', '$date', '$user_id')";
		mysqli_query($this->db_link, $sql);	
		$new_id = mysqli_insert_id($this->db_link);
		$custom_fqa_database = $this->get_fqa($new_id);
		return $custom_fqa_database;
	}
	
	/*
	 * delete the database and all its taxa
	 */
	public function delete($id) {
		$this->get_db_link();
		$sql = "DELETE FROM customized_fqa WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM customized_taxa WHERE customized_fqa_id='$id'";
		mysqli_query($this->db_link, $sql);
		
		// get any assessments using the customized fqa and delete them
		$sql = "SELECT id FROM inventory WHERE fqa_id='$id' AND customized_fqa='1'";
		$results = mysqli_query($this->db_link, $sql);
		while ($assessment = mysqli_fetch_assoc($results)) {
			$inventory = new InventoryAssessment();
			$inventory->delete($assessment['id']);
		}
		$sql = "SELECT id FROM transect WHERE fqa_id='$id' AND customized_fqa='1'";
		$results = mysqli_query($this->db_link, $sql);
		while ($assessment = mysqli_fetch_assoc($results)) {
			$transect = new TransectAssessment();
			$transect->delete($assessment['id']);
		}
		
	}
	
	/*
	 * function to insert taxa for a new custom db. takes the custom db id and a hook to
	 * the mysql resource of all the taxa in the original db.
	 */
	public function insert_taxa($customized_fqa_id, $original_fqa_id, $fqa_taxa) {
		$this->get_db_link();
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