<?php
class CustomTaxa {

	protected $db_link;

	public $id;
	public $fqa_id;
	public $customized_fqa_id;
	public $scientific_name;
	public $family;
	public $common_name;
 	public $acronym;
 	public $c_o_c;
 	public $c_o_w;
 	public $native;
 	public $physiognomy;
 	public $duration;
 	public $percent_cover;
	public $cover_range_midpoint;

	/*
	 * constructor
	 */
	public function __construct( $id = null ) {
		if ($id !== null) {
			$this->id = $id;
			// load all data for this assessment
			$this->get_db_link();
			$sql = "SELECT *, site.* FROM customized_taxa WHERE $this->id='$id'";
			$results = mysqli_query($this->db_link, $sql);
			if (mysqli_num_rows($results) == 0) {
				$this->id = null;
			} else {
				$result = mysqli_fetch_assoc($results);
				$this->id = $result['id'];
				$this->fqa_id = $result['fqa_id'];
				$this->customized_fqa_id = $result['customized_fqa_id'];
				$this->scientific_name = $result['scientific_name'];
				if ($result['native'] == 1)
					$this->native = 'native';
				else
					$this->native = 'non-native';
				$this->family = $result['family'];
				$this->common_name = $result['common_name'];
				$this->acronym = $result['acronym'];
				$this->c_o_c = $result['c_o_c'];
				$this->c_o_w = $result['c_o_w'];
				$this->physiognomy = $result['physiognomy'];
				$this->duration = $result['duration'];	
			}
			mysqli_close($this->db_link);	
		}	
	}
	
	/*
	 * function to get link to mysql database
	 */
	private function get_db_link() {
			require('../config/db_config.php');
			$this->db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
			if (mysqli_connect_errno($this->db_link)) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
	}
	
	/*
	 * function to update custom taxa
	 */
	public function update($id, $col_name, $value) {	
		// check that values are valid for the column
		if ($col_name == 'scientific_name') {
			$value = ucfirst(trim($value));
		} else if ($col_name == 'family') {
			$value = ucfirst(trim($value));
			if ($value == '')
				$value = null;
		} else if ($col_name == 'acronym') {
			$value = strtoupper(trim($value));
			if ($value == '')
				$value = null;
		} else if ($col_name == 'native') {
			$value = strtolower(trim($value));
			if ($value !== 'native' && $value !== 'non-native') {
				echo "Error: The column native must be either 'native' or 'non-native'.";
				exit;
			} 
			if ($value == 'native')
				$value = 1;
			if ($value == 'non-native')
				$value = 0;
		} else if ($col_name == 'c_o_c') {
			$value = trim($value);
			if (!is_numeric( $value ) || ($value < 0) || (10 < $value)) {
				echo "Error: The coefficient of conservatism must be an integer from 0-10.";
				exit;
			}
		} else if ($col_name == 'c_o_w') {
			$value = trim($value);
			if (($value !== '') && !is_numeric( $value ) || ($value < -5) || (5 < $value)) {
				echo "Error: The coefficient of wetness must be an integer betwee -5 and 5.";
				exit;
			}
			if ($value == '')
				$value = null;
		} else if ($col_name == 'physiognomy') {
			$value = strtolower(trim($value));
			// check physiognomy "fern", "forb", "grass", "rush", "sedge", "shrub", "tree", "vine", or "other"
			if (($value !== '') && ($value !== 'fern' && $value !== 'forb' && $value !== 'grass' && $value !== 'rush' && $value !== 'sedge' && $value !== 'shrub' && $value !== 'tree' && $value !== 'vine' && $value !== 'bryophyte')) {
				echo "Error: Please enter a valid term for physiognomy.";
				exit;
			}
			if ($value == '')
				$value = null;
		} else if ($col_name == 'duration') {
			$value = strtolower(trim($value));
			// check duration  "annual", "biennial", or "perennial"
			if (($value !== '') && ($value !== 'annual' && $value !== 'biennial' && $value !== 'perennial')) {
				echo "Error: Please enter a valid term for duration (either annual, biennial, or perennial).";
				exit;
			}
			if ($value == '')
				$value = null;
		} else if ($col_name == 'common_name') {
			$value = strtolower(trim($value));
			if ($value == '')
				$value = null;
		}
		// value is valid so update
		// check for null integer in c_o_w
		if ($col_name == 'c_o_w' && $value == '') 
			$sql = "UPDATE customized_taxa SET $col_name = NULL WHERE id = '$id'";
		else
			$sql = "UPDATE customized_taxa SET $col_name = '$value' WHERE id = '$id'";
		$this->get_db_link();
		mysqli_query($this->db_link, $sql);
		mysqli_close($this->db_link);
		echo "success";	
	}
	
    
    /*
	 * function to insert a new custom taxa
	 */
    public function insert_new($custom_fqa_id, $original_fqa_id, $scientific_name, $family, $common_name, $acronym, $c_o_c, $c_o_w, $native, $physiognomy, $duration) {
		// check that scientific name has been entered
		if (strlen($scientific_name) < 4) {
			echo "Error: Please enter a valid scientific name.";
			exit;
		}
		// check that c_o_c and c_o_w are integers
		if (!is_numeric( $c_o_c ) || ($c_o_c < 0) || (10 < $c_o_c)) {
			echo "Error: The coefficient of conservatism must be an integer from 0-10.";
			exit;
		}
		if (($c_o_w !== '') && (!is_numeric( $c_o_w ) || ($c_o_w < -5) || (5 < $c_o_w))) {
			echo "Error: The coefficient of wetness must be an integer between -5 and 5.";
			exit;
		}
		// check native/non-native
		if ($native !== 'native' && $native !== 'non-native') {
			echo "Error: The column native must be either 'native' or 'non-native'.";
			exit;
		}
		if ($native == 'native')
			$native = 1;
		if ($native == 'non-native')
			$native = 0;
		// check physiognomy "fern", "forb", "grass", "rush", "sedge", "shrub", "tree", "vine", or "other"
		if (($physiognomy !== '') && ($physiognomy !== 'fern' && $physiognomy !== 'forb' && $physiognomy !== 'grass' && $physiognomy !== 'rush' && $physiognomy !== 'sedge' && $physiognomy !== 'shrub' && $physiognomy !== 'tree' && $physiognomy !== 'vine' && $physiognomy !== 'other')) {
			echo "Error: Please enter a valid term for physiognomy.";
			exit;
		}
		// check duration  "annual", "biennial", or "perennial"
		if (($duration !== '') && ($duration !== 'annual' && $duration !== 'biennial' && $duration !== 'perennial')) {
			echo "Error: Please enter a valid term for duration (either annual, biennial, or perennial).";
			exit;
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
		$this->get_db_link();
		// do not insert if there is already a taxa with this sci name for this fqa db
		$sql = "SELECT * FROM customized_taxa WHERE scientific_name='$scientific_name' AND customized_fqa_id='$custom_fqa_id'";
		$existing_taxa = mysqli_query($this->db_link, $sql);
		if (mysqli_num_rows($existing_taxa) == 0) {
			// avoid mysql int = null = 0 problem
			if ($c_o_w == null)
				$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, native, physiognomy, duration) VALUES ('$custom_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$native', '$physiognomy', '$duration')";
			else
				$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, c_o_w, native, physiognomy, duration) VALUES ('$custom_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$c_o_w', '$native', '$physiognomy', '$duration')";
			mysqli_query($this->db_link, $sql);
			mysqli_close($this->db_link);
			echo "success";
		} else {
			mysqli_close($this->db_link);
			echo "Error: a taxa with that scientific name already exists for this database.";
		}
	}
	
	/*
	 * delete the custom taxa
	 */
	public function delete($id) {
		$this->get_db_link();
		$sql = "DELETE FROM customized_taxa WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
		mysqli_close($this->db_link);
	}	
}
?>