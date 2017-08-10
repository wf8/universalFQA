<?php
class FQADatabase {

	protected $db_link = null;
	
	public $id;
	public $region_name;
	public $publication_year;
	public $description;
	
	// aggregated details shown in select lists 
	public $selection_display_name;
	
	public $state_province_ids = array();
	public $omernik_ecoregion_ids = array();
	
	/*
	 * constructor
	 */
	public function __construct( $id = null ) {
		if ($id !== null) {
			$this->get_db_link();
			$sql = "SELECT * FROM fqa WHERE id='$id'";
			$fqa_result =  mysqli_query($this->db_link, $sql);
			$fqa = mysqli_fetch_array($fqa_result);
			$this->id = $id;
			$this->region_name = $fqa['region_name'];
			$this->publication_year = $fqa['publication_year'];
			$this->description = $fqa['description'];
			$this->get_states($id, $this->db_link);
			$this->get_ecoregions($id, $this->db_link);
			$this->make_selection_display_name($this->region_name);
			mysqli_close($this->db_link);
		}
	}
	
	/*
	 * function to get link to mysql database
	 */
	protected function get_db_link() {
			require('../config/db_config.php');
			$this->db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
			if (mysqli_connect_errno($this->db_link)) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
	}

	/*
	 * return a mysql resource with all the fqa databases
	 */
	public function get_all() {
		$this->get_db_link();
		$sql = "SELECT * FROM fqa WHERE 1 ORDER BY region_name, publication_year";
		$query_results = mysqli_query($this->db_link, $sql);
		$return_fqa_databases = array();
		if (mysqli_num_rows($query_results) !== 0) {
			while ($fqa_database = mysqli_fetch_assoc($query_results)) {
				$new_fqa_db = new FQADatabase();
				$new_fqa_db->id = $fqa_database['id'];
				$new_fqa_db->region_name = $fqa_database['region_name'];
				$new_fqa_db->publication_year = $fqa_database['publication_year'];
				$new_fqa_db->description = $fqa_database['description'];
				$new_fqa_db->get_states($new_fqa_db->id, $this->db_link);
				$new_fqa_db->get_ecoregions($new_fqa_db->id, $this->db_link);
				$new_fqa_db->make_selection_display_name($new_fqa_db->region_name);
				$return_fqa_databases[$new_fqa_db->id] = $new_fqa_db;
			}
		}
		mysqli_close($this->db_link);
		return $return_fqa_databases;
	}
	
	public function make_selection_display_name($name) {
		// Include state codes in the selection display, as configured with the FQA Database
		$state_codes = array();
		foreach ($this->state_province_ids as $state_province_id) {
			 $state_province = StateProvince::get_state_province_by_id($state_province_id['state_id']);
			 $state_codes[] = $state_province->abbreviation; 
		}
		$state_codes = !empty($state_codes) > 0 ? '(' . implode(', ', $state_codes) . ')': '';
		// Include omernik ecoregio codes in the selection display, as configured with the FQA Database
		$ecoregion_codes = array();
		foreach ($this->omernik_ecoregion_ids as $ecoregion_ids) {
			$omernik_ecoregion = OmernikEcoregion::get_ecoregion_by_id($ecoregion_ids['ecoregion_id']);
			if ($omernik_ecoregion->ecoregion_number !== $omernik_ecoregion->ecoregion_code) {
				$ecoregion_codes[] = $omernik_ecoregion->ecoregion_number . '/' . $omernik_ecoregion->ecoregion_code;
			} else {
				$ecoregion_codes[] = $omernik_ecoregion->ecoregion_number;
			}
		}
		$ecoregion_codes = !empty($ecoregion_codes) > 0 ? '(Omernik III Ecoregions: ' . implode(', ', $ecoregion_codes) . ')': '';
		$this->selection_display_name = $name . ' ' . $state_codes . ' ' . $ecoregion_codes . ', ' . $this->publication_year;
	}
    
    /*
	 * return a mysql resource for the fqa database with id
	 */
	public function get_fqa($id) {
		$this->get_db_link();
		$sql = "SELECT * FROM fqa WHERE id='$id'";
		$query_results = mysqli_query($this->db_link, $sql);
		mysqli_close($this->db_link);
		return $query_results;
	}
	
	/*
	 * return a mysql resource for all the states associated with fqa database id
	 */
	public function get_states($id, $db_link=NULL, $is_custom_fqa=0) {
		$db_link_internal = $db_link;
		if ($db_link == NULL) {
			$this->get_db_link();
			$db_link_internal = $this->db_link;
		}
		$sql = "SELECT * FROM fqa_states WHERE fqa_id='$id' AND is_custom_fqa='$is_custom_fqa' ORDER BY state_id";
		$query_results = mysqli_query($db_link_internal, $sql);
		if (mysqli_num_rows($query_results) !== 0) {
			while ($state_prov_row = mysqli_fetch_assoc($query_results)) {
				$state_prov = array();
				$state_prov['id'] = $state_prov_row['id'];
				$state_prov['fqa_id'] = $state_prov_row['fqa_id'];
				$state_prov['state_id'] = $state_prov_row['state_id'];
				$this->state_province_ids[$state_prov_row['state_id']] = $state_prov;
			}
		}
		if ($db_link == NULL) {
			mysqli_close($db_link_internal);
		}
		return $this->state_province_ids;
	}

	/*
	 * return a mysql resource for all the ecoregions associated with fqa database id
	 */
	public function get_ecoregions($id, $db_link=NULL, $is_custom_fqa=0) {
		$db_link_internal = $db_link;
		if ($db_link == NULL) {
			$this->get_db_link();
			$db_link_internal = $this->db_link;
		}
		$sql = "SELECT * FROM fqa_ecoregions WHERE fqa_id='$id' AND is_custom_fqa='$is_custom_fqa' ORDER BY ecoregion_id";
		$query_results = mysqli_query($db_link_internal, $sql);		
		if (mysqli_num_rows($query_results) !== 0) {
			while ($ecoregion_row = mysqli_fetch_assoc($query_results)) {
				$ecoregion = array();
				$ecoregion['id'] = $ecoregion_row['id'];
				$ecoregion['fqa_id'] = $ecoregion_row['fqa_id'];
				$ecoregion['ecoregion_id'] = $ecoregion_row['ecoregion_id'];
				$this->omernik_ecoregion_ids[$ecoregion_row['ecoregion_id']] = $ecoregion;
			}
		}
		if ($db_link == NULL) {
			mysqli_close($db_link_internal);
		}
		return $this->omernik_ecoregion_ids;
	}

	/*
	 * return a mysql resource for all the taxa associated with fqa database id
	 */
	public function get_taxa($id) {
		$this->get_db_link();
		$sql = "SELECT * FROM taxa WHERE fqa_id='$id' ORDER BY scientific_name";
		$retval = mysqli_query($this->db_link, $sql);		
		mysqli_close($this->db_link);
		return $retval;
  }
    
    /*
	 * return an array with all scientific names in fqa database id
	 */
	public function get_scientific_names($id) {
		$this->get_db_link();
		$sql = "SELECT scientific_name FROM taxa WHERE fqa_id='$id' ORDER BY scientific_name";
		$result = mysqli_query($this->db_link, $sql);
		$array_to_return = array();
		while($row = mysqli_fetch_array($result))	{
			if ($row['scientific_name'] !== '')
    			$array_to_return[] = $row['scientific_name'];
		}
		mysqli_close($this->db_link);
		return $array_to_return;
    }
    
    /*
	 * return an array with all acronyms in fqa database id
	 */
	public function get_acronyms($id) {
		$this->get_db_link();
		$sql = "SELECT acronym FROM taxa WHERE fqa_id='$id' ORDER BY acronym";
		$result = mysqli_query($this->db_link, $sql);
		$array_to_return = array();
		while($row = mysqli_fetch_array($result))	{
			if ($row['acronym'] !== '')
	    		$array_to_return[] = $row['acronym'];
		}
		mysqli_close($this->db_link);
		return $array_to_return;
    }
    
    /*
	 * return an array with all common names in fqa database id
	 */
	public function get_common_names($id) {
		$this->get_db_link();
		$sql = "SELECT common_name FROM taxa WHERE fqa_id='$id' ORDER BY common_name";
		$result = mysqli_query($this->db_link, $sql);
		$array_to_return = array();
		while($row = mysqli_fetch_array($result))	{
			$common_name = $row['common_name'];
    		if ( ($common_name !== '') && !is_null($common_name) )
				$common_name = str_replace("'", "", $common_name);
    			$array_to_return[] = $common_name;
		}
		mysqli_close($this->db_link);
		return $array_to_return;
    }
    
    /*
	 * function to import a new fqa database. takes as input region, year, description, and 
	 * handle to uploaded file
	 */
	public function import_new($region, $year, $description, $states, $ecoregions, $file) {
		$this->get_db_link();
		$result = "";
		if (!is_numeric( $year ) || ($year < 1950) || (3000 < $year)) {
			$result = "Error: Please enter a valid year.";
		} else if ($file["error"] == 4)
			$result = "Error: Please select a file.";
		else if ($file["error"] > 0)
			$result = "Error: " . $file["error"];
		else if	($file["size"] > 10490000) // 1.049e+7 bytes = 10 mb restriction
			$result = "Error: File must be under 10 mb.";
		else {
			if (($handle = fopen($file['tmp_name'], "r")) !== FALSE) {
				$taxa_inserted = 0;
				$new_fqa = true;
				while (($data = fgetcsv($handle, 0, ",", '"')) !== FALSE) {
					if ($new_fqa == true) {
						$new_fqa = false;
						// do not insert if there is already an FQA database with that region and year
						$sql = "SELECT * FROM fqa WHERE region_name='$region' AND publication_year='$year'";
						$existing_fqa = mysqli_query($this->db_link, $sql);
						if (mysqli_num_rows($existing_fqa) == 0) {
							$date = date('Y-m-d');
							$user_id = $_SESSION['user_id'];
							$sql = "INSERT INTO fqa (region_name, description, publication_year, created, user_id) VALUES ('$region', '$description', '$year', '$date', '$user_id')";
							mysqli_query($this->db_link, $sql);	
							$fqa_id = mysqli_insert_id($this->db_link);
						} else {
							$result = "Error: An FQA database for that region and year already exist.";
							break;
						}
						foreach ($states as $state) {
						  $sql = "INSERT INTO fqa_states (fqa_id, state_id) VALUES ('$fqa_id', '$state')";
							mysqli_query($this->db_link, $sql);	
						}
						foreach ($ecoregions as $ecoregion) {
						  $sql = "INSERT INTO fqa_ecoregions (fqa_id, ecoregion_id) VALUES ('$fqa_id', '$ecoregion')";
							mysqli_query($this->db_link, $sql);	
						}
					}
					// skip the header row
					if (trim(strtolower($data[0])) !== "scientific name") {
						//scientific name, family, acronym, nativity, coefficient of conservatism, coefficient of wetness, physiognomy, duration, common name
						$scientific_name = mysqli_real_escape_string($this->db_link, ucfirst(strtolower(trim($data[0]))));
						$family = mysqli_real_escape_string($this->db_link, ucfirst(strtolower(trim($data[1]))));
						$acronym = mysqli_real_escape_string($this->db_link, strtoupper(trim($data[2])));
						$native = mysqli_real_escape_string($this->db_link, strtolower(trim($data[3])));
						$c_o_c = mysqli_real_escape_string($this->db_link, trim($data[4]));
						$c_o_w = mysqli_real_escape_string($this->db_link, trim($data[5]));
						$physiognomy = mysqli_real_escape_string($this->db_link, strtolower(trim($data[6])));
						$duration = mysqli_real_escape_string($this->db_link, strtolower(trim($data[7])));
						$common_name = mysqli_real_escape_string($this->db_link, strtolower(trim($data[8])));
						// remove any quotes (typically in common names e.g. "Witch's Teeth Lotus")
						$scientific_name = str_replace("'", "", $scientific_name);
						$family = str_replace("'", "", $family);
						$common_name = str_replace("'", "", $common_name);
						// check that scientific name has been entered
						if (strlen($scientific_name) < 4) {
							$result = "Error: Please enter a valid scientific name. See line #".$taxa_inserted;
							break;
						}
						// check that c_o_c and c_o_w are integers
						if (!is_numeric( $c_o_c ) || ($c_o_c < 0) || (10 < $c_o_c)) {
							$result = "Error: The coefficient of conservatism must be an integer from 0-10. See line #".$taxa_inserted;
							break;
						}
						if (($c_o_w !== '') && (!is_numeric( $c_o_w ) || ($c_o_w < -5) || (5 < $c_o_w))) {
							$result = "Error: The coefficient of wetness must be an integer between -5 and 5. See line #".$taxa_inserted;
							break;
						}
						// check native/non-native
						if ($native !== 'native' && $native !== 'non-native') {
							$result = "Error: The column native must be either 'native' or 'non-native'. See line #".$taxa_inserted;
							break;
						}
						if ($native == 'native')
							$native = 1;
						if ($native == 'non-native')
							$native = 0;
						// check physiognomy "fern", "forb", "grass", "rush", "sedge", "shrub", "tree", "vine", or "bryophyte"
						if (($physiognomy !== '') && ($physiognomy !== 'fern' && $physiognomy !== 'forb' && $physiognomy !== 'grass' && $physiognomy !== 'rush' && $physiognomy !== 'sedge' && $physiognomy !== 'shrub' && $physiognomy !== 'tree' && $physiognomy !== 'vine' && $physiognomy !== 'bryophyte')) {
							$result = "Error: Please enter a valid term for physiognomy. See line #".$taxa_inserted;
							break;
						}
						// check duration  "annual", "biennial", or "perennial"
						if (($duration !== '') && ($duration !== 'annual' && $duration !== 'biennial' && $duration !== 'perennial')) {
							$result = "Error: Please enter a valid term for duration (either annual, biennial, or perennial). See line #".$taxa_inserted;
							break;
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
						// do not insert if there is already a taxa with this sci name for this fqa db
						$sql = "SELECT * FROM taxa WHERE scientific_name='$scientific_name' AND fqa_id='$fqa_id'";
						$existing_taxa = mysqli_query($this->db_link, $sql);
						if (mysqli_num_rows($existing_taxa) == 0) {
							// avoid mysql int = null = 0 problem
							if ($c_o_w == null)
								$sql = "INSERT INTO taxa (fqa_id, scientific_name, family, common_name, acronym, c_o_c, native, physiognomy, duration) VALUES ('$fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$native', '$physiognomy', '$duration')";
							else
								$sql = "INSERT INTO taxa (fqa_id, scientific_name, family, common_name, acronym, c_o_c, c_o_w, native, physiognomy, duration) VALUES ('$fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$c_o_w', '$native', '$physiognomy', '$duration')";					
							mysqli_query($this->db_link, $sql);
							$taxa_inserted++;
						}	
					}
				}
				if ($result == "") {
					$headers = 'From: fqa@universalfqa.org' . "\r\n";
					$message = "Successfully inserted new " . $region . ", " . $year . " FQA database with " . $taxa_inserted . " taxa.";
					mail('willfreyman@gmail.com', 'FQA: new database', $message, $headers);
					$result = $fqa_id . "";
				} else {
					// delete any partially inserted databases
					$sql = "DELETE FROM fqa WHERE id='$fqa_id'";
					mysqli_query($this->db_link, $sql);
					$sql = "DELETE FROM fqa_states WHERE fqa_id='$fqa_id'";
					mysqli_query($this->db_link, $sql);
					$sql = "DELETE FROM fqa_ecoregions WHERE fqa_id='$fqa_id'";
					mysqli_query($this->db_link, $sql);
					$sql = "DELETE FROM taxa WHERE fqa_id='$fqa_id'";
					mysqli_query($this->db_link, $sql);
				}
			}
		}
		mysqli_close($this->db_link);
		echo '<html><head><script language="javascript" type="text/javascript">';
		echo 'var result = ' . json_encode($result) . ';';
		echo 'window.top.window.stop_database_upload(result);';
		echo '</script></head><body></body></html>';	
	}

}
?>
