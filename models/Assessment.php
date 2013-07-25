<?php
class Assessment {

	protected $db_link;
	protected $db_table;
	
	public $id;
	public $fqa_id;
	public $custom_fqa;
	public $date;
	public $private;
	public $practitioner;
 	public $latitude;
 	public $longitude;
 	public $weather_notes;
 	public $duration_notes;
 	public $community_type_notes;
 	public $other_notes;
	
	public $site; // Site object
	public $taxa = array(); // an array of Taxa or CustomTaxa objects
	
	/*
	 * constructor
	 */
	protected function __construct( $id = null ) {
		if ($id !== null) {
			$this->id = $id;
			// load all data for this assessment
			$this->get_db_link();
			$sql = "SELECT $this->db_table.*, site.* FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.id='$id'";
			$results = mysqli_query($this->db_link, $sql);
			if (mysqli_num_rows($results) == 0) {
				$this->id = null;
			} else {
				$result = mysqli_fetch_assoc($results);
				$this->id = $result['id'];
				$this->fqa_id = $result['fqa_id'];
				$this->custom_fqa = $result['custom_fqa'];
				$this->date = $result['date'];
				if ($result['private'] == 1)
					$this->private = 'private';
				else
					$this->private = 'public';
				$this->practitioner = $result['practitioner'];
				$this->latitude = $result['latitude'];
				$this->longitude = $result['longitude'];
				$this->weather_notes = $result['weather_notes'];
				$this->duration_notes = $result['duration_notes'];
				$this->community_type_notes = $result['community_type_notes'];
				$this->other_notes = $result['other_notes'];	
				$site = new Site();
				$site->id = $result['site_id'];
				$site->name = $result['name'];
				$site->location = $result['location'];
				$site->city = $result['city'];
				$site->county = $result['county'];
				$site->state = $result['state'];
				$site->country = $result['country'];
				$site->notes = $result['notes'];
				$this->site = $site;
			}	
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
	 * return an array with all the user's assessments
	 */
    protected function get_all_for_user($user_id) {
    	$this->get_db_link();
	    $sql = "SELECT $this->db_table.*, site.* FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.user_id='$user_id' ORDER BY site.name, $this->db_table.date";
		$results = mysqli_query($this->db_link, $sql);
		$assessments = array();
		while ($result = mysqli_fetch_assoc($results)) {
			$assessment = new Assessment();
			$assessment->id = $result['id'];
			$assessment->date = $result['date'];
			if ($result['private'] == 1)
				$assessment->private = 'private';
			else
				$assessment->private = 'public';
	 		$assessment->practitioner = $result['practitioner'];
 	 		$assessment->latitude = $result['latitude'];
 	 		$assessment->longitude = $result['longitude'];
 	 		$assessment->weather_notes = $result['weather_notes'];
 			$assessment->duration_notes = $result['duration_notes'];
 			$assessment->community_type_notes = $result['community_type_notes'];
 			$assessment->other_notes = $result['other_notes'];	
 			$site = new Site();
 			$site->id = $result['site_id'];
 			$site->name = $result['name'];
 			$site->location = $result['location'];
 			$site->city = $result['city'];
 			$site->county = $result['county'];
 			$site->state = $result['state'];
 			$site->country = $result['country'];
 			$site->notes = $result['notes'];
 			$assessment->site = $site;	
			$assessments[] = $assessment; 
		}
		return $assessments;
    }
    
    /*
	 * return an array with all the public assessments
	 */
    protected function get_all_public() {
    	$this->get_db_link();
	    $sql = "SELECT $this->db_table.*, site.* FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.private='0' ORDER BY site.name, $this->db_table.date";
		$results = mysqli_query($this->db_link, $sql);			 
		$assessments = array();
		while ($result = mysqli_fetch_assoc($results)) {		
			$assessment = new Assessment();			
			$assessment->id = $result['id'];
			$assessment->date = $result['date'];
			if ($result['private'] == 1)
				$assessment->private = 'private';
			else
				$assessment->private = 'public';
	 		$assessment->practitioner = $result['practitioner'];
 	 		$assessment->latitude = $result['latitude'];
 	 		$assessment->longitude = $result['longitude'];
 	 		$assessment->weather_notes = $result['weather_notes'];
 			$assessment->duration_notes = $result['duration_notes'];
 			$assessment->community_type_notes = $result['community_type_notes'];
 			$assessment->other_notes = $result['other_notes'];		
 			$site = new Site();
 			$site->id = $result['site_id'];
 			$site->name = $result['name'];
 			$site->location = $result['location'];
 			$site->city = $result['city'];
 			$site->county = $result['county'];
 			$site->state = $result['state'];
 			$site->country = $result['country'];
 			$site->notes = $result['notes'];
 			$assessment->site = $site;		
			$assessments[] = $assessment; 
		}
		return $assessments;
    }
	
	public function calculate_native_fqi() {
		return '50.0';
	}
	
	/*
	 * add the taxa to this assessment based on the value of a db column
	 * allows taxa to be added based on sci name, common name, or acronym
	 * return true/false depending on success of adding taxa
	 * will return true if taxa is already in assessment
	 */
	public function add_taxa_by_column_value( $column, $value ) {
		if (trim($value) == '')
			return false;
		if ($this->custom_fqa) {
			$taxa = new CustomTaxa();
			$taxa_db = 'customized_taxa';
			$fqa_column = 'customized_fqa_id';
		} else {
			$taxa = new Taxa();
			$taxa_db = 'taxa';
			$fqa_column = 'fqa_id';
		}
		$this->get_db_link();
		$sql = "SELECT * FROM $taxa_db WHERE $taxa_db.$column='$value' AND $taxa_db.$fqa_column='$this->fqa_id'";
		$results = mysqli_query($this->db_link, $sql);
		if (mysqli_num_rows($results) == 0) {
			return false;
		} else {
			$result = mysqli_fetch_assoc($results);
			$taxa->id = $result['id'];
			
			$taxa->fqa_id = $result['fqa_id'];
			$taxa->scientific_name = $result['scientific_name'];
			if ($result['native'] == 1)
				$taxa->native = 'native';
			else
				$taxa->native = 'non-native';
			$taxa->family = $result['family'];
			$taxa->common_name = $result['common_name'];
			$taxa->acronym = $result['acronym'];
			$taxa->c_o_c = $result['c_o_c'];
			$taxa->c_o_w = $result['c_o_w'];
			$taxa->physiognomy = $result['physiognomy'];
			$taxa->duration = $result['duration'];
			
			// check to make sure taxa is not already in assessment
			foreach($this->taxa as $taxon) {
				if ($taxon->id == $taxa->id) {
					return true;
				}
			}
			$this->taxa[] = $taxa;
			return true;
		}	
	}
	
	/*
	 * removes taxon from taxa array
	 * takes as input the id of the taxon to be removed
	 */
	public function remove_taxon( $id ) {
		foreach($this->taxa as $key => $taxon) {
			if ($taxon->id == $id) {
				unset($this->taxa[$key]);
				$this->taxa = array_values($this->taxa);
				break;
			}
		}
	}
}
?>