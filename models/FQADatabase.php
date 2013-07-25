<?php
class FQADatabase {

	protected $db_link = null;
	
	/*
	 * constructor
	 */
	public function __construct() {
	}
	
	/*
	 * function to get link to mysql database
	 */
	private function get_db_link() {
		if (is_null($this->db_link) {
			require('../config/db_config.php');
			$this->db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
			if (mysqli_connect_errno($this->db_link)) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		}
	}

	/*
	 * return a mysql resource with all the fqa databases
	 */
	public function get_all() {
		$this->get_db_link();
		$sql = "SELECT * FROM fqa WHERE 1 ORDER BY region_name, publication_year";
		return mysqli_query($this->db_link, $sql);			 
    }
    
    /*
	 * return a mysql resource for the fqa database with id
	 */
	public function get_fqa($id) {
		$this->get_db_link();
    	$sql = "SELECT * FROM fqa WHERE id='$id'";
		return mysqli_query($this->db_link, $sql);
	}
	
	/*
	 * return a mysql resource for all the taxa associated with fqa database id
	 */
	public function get_taxa($id) {
		$this->get_db_link();
		$sql = "SELECT * FROM taxa WHERE fqa_id='$id' ORDER BY scientific_name";
		return mysqli_query($this->db_link, $sql);
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
    		if ($row['common_name'] !== '')
    			$common_name = $row['common_name'];
				$common_name = str_replace("'", "", $common_name);
    			$array_to_return[] = $common_name;
		}
		return $array_to_return;
    }
    
    /*
	 * function to import a new fqa database. takes as input region, year, description, and 
	 * handle to uploaded file
	 */
	public function import_new($region, $year, $description, $file) {
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
							$fqa_id = mysqli_insert_id();
						} else {
							$result = "Error: An FQA database for that region and year already exist.";
							break;
						}
					}
					// skip the header row
					if (trim(strtolower($data[0])) !== "scientific name") {
						//scientific name, family, acronym, nativity, coefficient of conservatism, coefficient of wetness, physiognomy, duration, common name
						$scientific_name = mysql_real_escape_string(ucfirst(strtolower(trim($data[0]))));
						$family = mysql_real_escape_string(ucfirst(strtolower(trim($data[1]))));
						$acronym = mysql_real_escape_string(strtoupper(trim($data[2])));
						$native = mysql_real_escape_string(strtolower(trim($data[3])));
						$c_o_c = mysql_real_escape_string(trim($data[4]));
						$c_o_w = mysql_real_escape_string(trim($data[5]));
						$physiognomy = mysql_real_escape_string(strtolower(trim($data[6])));
						$duration = mysql_real_escape_string(strtolower(trim($data[7])));
						$common_name = mysql_real_escape_string(strtolower(trim($data[8])));
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
					$message = "Successfully inserted new " . $region . ", " . $year . " FQA database with " . $taxa_inserted . " taxa.";
					mail('willfreyman@gmail.com', 'FQA: new database', $message);
					$result = $fqa_id . "";
				} else {
					// delete any partially inserted databases
					$sql = "DELETE FROM fqa WHERE id='$fqa_id'";
					mysqli_query($this->db_link, $sql);
					$sql = "DELETE FROM taxa WHERE fqa_id='$fqa_id'";
					mysqli_query($this->db_link, $sql);
				}
			}
		}
		echo '<html><head><script language="javascript" type="text/javascript">';
		echo 'var result = ' . json_encode($result) . ';';
		echo 'window.top.window.stop_database_upload(result);';
		echo '</script></head><body></body></html>';	
	}

}
?>