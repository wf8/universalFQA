<?php
class Assessment {

	protected $db_link;
	protected $db_table;
	protected $result;
	
	public $id;
	public $fqa_id;
	public $custom_fqa;
	public $date;
	public $private;
	public $name;
	public $practitioner;
 	public $latitude;
 	public $longitude;
 	public $weather_notes;
 	public $duration_notes;
 	public $community_type_notes;
 	public $other_notes;
	
	public $site; // Site object
	public $fqa; // FQADatabase or CustomFQADatabase object
	public $metrics; // InventoryMetrics or TransectMetrics object
	
	/*
	 * constructor
	 */
	protected function __construct( $id = null ) {
		if ($id !== null) {
			$this->id = $id;
			// load all data for this assessment
			$this->get_db_link();
			$sql = "SELECT $this->db_table.*, site.name AS sitename, site.location, site.city, site.county, site.state, site.country, site.notes FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.id='$id'";
			$results = mysqli_query($this->db_link, $sql);
			if (mysqli_num_rows($results) == 0) {
				$this->id = null;
			} else {
				$result = mysqli_fetch_assoc($results);
				$this->result = $result;
				$this->id = $result['id'];
				$this->fqa_id = $result['fqa_id'];
				$this->custom_fqa = $result['customized_fqa'];
				$this->date = $result['date'];
				if ($result['private'] == 1)
					$this->private = 'private';
				else
					$this->private = 'public';
				$this->name = $result['name'];
				$this->practitioner = $result['practitioner'];
				$this->latitude = $result['latitude'];
				$this->longitude = $result['longitude'];
				$this->weather_notes = $result['weather_notes'];
				$this->duration_notes = $result['duration_notes'];
				$this->community_type_notes = $result['community_type_notes'];
				$this->other_notes = $result['other_notes'];	
				$site = new Site();
				$site->id = $result['site_id'];
				$site->name = $result['sitename'];
				$site->location = $result['location'];
				$site->city = $result['city'];
				$site->county = $result['county'];
				$site->state = $result['state'];
				$site->country = $result['country'];
				$site->notes = $result['notes'];
				$site->ecoregions = $site->get_site_ecoregions($result['site_id'], $this->db_link);
				$this->site = $site;
				$this->get_fqa_object();
			}	
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
	 * function to this Assessment's FQADatabase or CustomFQADatabase object
	 */
	protected function get_fqa_object() {
		if ( $this->id !== null ) {
			if ($this->custom_fqa) 
				$this->fqa = new CustomFQADatabase( $this->fqa_id );
			else
				$this->fqa = new FQADatabase( $this->fqa_id );
		}
	}
	
	/*
	 * return an array with all the user's assessments
	 */
    protected function get_all_for_user($user_id) {
    	$this->get_db_link();
	    $sql = "SELECT $this->db_table.*, site.name AS sitename, site.location, site.city, site.county, site.state, site.country, site.notes FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.user_id='$user_id' ORDER BY $this->db_table.date DESC, site.name ASC";
		$results = mysqli_query($this->db_link, $sql);
		$assessments = array();
		while ($result = mysqli_fetch_assoc($results)) {
			// no type casting so use hack
			if ($this->db_table == 'inventory')
				$assessment = new InventoryAssessment();
			else {
				$assessment = new TransectAssessment();
				$assessment->load_transect_details($result);
			}
			$assessment->id = $result['id'];
			$assessment->fqa_id = $result['fqa_id'];
			$assessment->custom_fqa = $result['customized_fqa'];
			$assessment->date = $result['date'];
			if ($result['private'] == 1)
				$assessment->private = 'private';
			else
				$assessment->private = 'public';
			$assessment->name = $result['name'];
	 		$assessment->practitioner = $result['practitioner'];
 	 		$assessment->latitude = $result['latitude'];
 	 		$assessment->longitude = $result['longitude'];
 	 		$assessment->weather_notes = $result['weather_notes'];
 			$assessment->duration_notes = $result['duration_notes'];
 			$assessment->community_type_notes = $result['community_type_notes'];
 			$assessment->other_notes = $result['other_notes'];	
 			$site = new Site();
 			$site->id = $result['site_id'];
 			$site->name = $result['sitename'];
 			$site->location = $result['location'];
 			$site->city = $result['city'];
 			$site->county = $result['county'];
 			$site->state = $result['state'];
 			$site->country = $result['country'];
 			$site->notes = $result['notes'];
			$site->ecoregions = $site->get_site_ecoregions($result['site_id'], $this->db_link);
 			$assessment->site = $site;	
 			$assessment->get_fqa_object();
			$assessments[] = $assessment; 
		}
		mysqli_close($this->db_link);
		return $assessments;
    }
    
    /*
	 * return an array with all the public assessments
	 */
    protected function get_all_public() {
    	$this->get_db_link();
	    $sql = "SELECT $this->db_table.*, site.name AS sitename, site.location, site.city, site.county, site.state, site.country, site.notes FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.private='0' ORDER BY $this->db_table.date DESC, site.name ASC";
		$results = mysqli_query($this->db_link, $sql);			 
		$assessments = array();
		while ($result = mysqli_fetch_assoc($results)) {		
			// no type casting so use hack
			if ($this->db_table == 'inventory')
				$assessment = new InventoryAssessment();
			else {
				$assessment = new TransectAssessment();
				$assessment->load_transect_details($result);				
			}
			$assessment->id = $result['id'];
			$assessment->date = $result['date'];
			$assessment->fqa_id = $result['fqa_id'];
			$assessment->custom_fqa = $result['customized_fqa'];
			if ($result['private'] == 1)
				$assessment->private = 'private';
			else
				$assessment->private = 'public';
			$assessment->name = $result['name'];
	 		$assessment->practitioner = $result['practitioner'];
 	 		$assessment->latitude = $result['latitude'];
 	 		$assessment->longitude = $result['longitude'];
 	 		$assessment->weather_notes = $result['weather_notes'];
 			$assessment->duration_notes = $result['duration_notes'];
 			$assessment->community_type_notes = $result['community_type_notes'];
 			$assessment->other_notes = $result['other_notes'];		
 			$site = new Site();
 			$site->id = $result['site_id'];
 			$site->name = $result['sitename'];
 			$site->location = $result['location'];
 			$site->city = $result['city'];
 			$site->county = $result['county'];
 			$site->state = $result['state'];
 			$site->country = $result['country'];
 			$site->notes = $result['notes'];
			$site->ecoregions = $site->get_site_ecoregions($result['site_id'], $this->db_link);
 			$assessment->site = $site;	
 			$assessment->get_fqa_object();	
			$assessments[] = $assessment; 
		}
		mysqli_close($this->db_link);
		return $assessments;
    }
	
    /*
	 * return an array with all the public assessments for a given fqa database
	 */
    protected function get_all_public_for_fqa($fqa_id) {
    	$this->get_db_link();
	    $sql = "SELECT $this->db_table.*, site.name AS sitename, site.location, site.city, site.county, site.state, site.country, site.notes FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.private='0' AND $this->db_table.fqa_id='$fqa_id' ORDER BY $this->db_table.date DESC, site.name ASC";
		$results = mysqli_query($this->db_link, $sql);			 
		$assessments = array();
		while ($result = mysqli_fetch_assoc($results)) {		
			// no type casting so use hack
			if ($this->db_table == 'inventory')
				$assessment = new InventoryAssessment();
			else {
				$assessment = new TransectAssessment();
				$assessment->load_transect_details($result);				
			}
			$assessment->id = $result['id'];
			$assessment->date = $result['date'];
			$assessment->fqa_id = $result['fqa_id'];
			$assessment->custom_fqa = $result['customized_fqa'];
			if ($result['private'] == 1)
				$assessment->private = 'private';
			else
				$assessment->private = 'public';
			$assessment->name = $result['name'];
	 		$assessment->practitioner = $result['practitioner'];
 	 		$assessment->latitude = $result['latitude'];
 	 		$assessment->longitude = $result['longitude'];
 	 		$assessment->weather_notes = $result['weather_notes'];
 			$assessment->duration_notes = $result['duration_notes'];
 			$assessment->community_type_notes = $result['community_type_notes'];
 			$assessment->other_notes = $result['other_notes'];		
 			$site = new Site();
 			$site->id = $result['site_id'];
 			$site->name = $result['sitename'];
 			$site->location = $result['location'];
 			$site->city = $result['city'];
 			$site->county = $result['county'];
 			$site->state = $result['state'];
 			$site->country = $result['country'];
 			$site->notes = $result['notes'];
			$site->ecoregions = $site->get_site_ecoregions($result['site_id'], $this->db_link);
 			$assessment->site = $site;	
 			$assessment->get_fqa_object();	
			$assessments[] = $assessment; 
		}
		mysqli_close($this->db_link);
		return $assessments;
    }

	/*
	 *  helper functions for downloading reports
	 */
	protected function return_CSV( $data ) {
		$csv = fopen('temp.csv', 'w');		
		foreach ($data as $fields) {
			fputcsv($csv, $fields);
		}
		fclose($csv);	
		return file_get_contents('temp.csv');
	}
	
	protected function prettify_percent( $value ) {
		if (trim($value) == '') 
			return '';
		else
			return $value . '%';
	}
	
	protected function prettify_value( $value ) {
		if (trim($value) == '') 
			return 'n/a';
		else
			return $value;
	}
	
	protected function sort_array_of_objects($arr, $var) { 
	   $tarr = array(); 
	   $rarr = array(); 
	   for($i = 0; $i < count($arr); $i++) { 
		  $element = $arr[$i]; 
		  $tarr[] = strtolower($element->{$var}); 
	   } 
	   reset($tarr); 
	   asort($tarr); 
	   $karr = array_keys($tarr); 
	   for($i = 0; $i < count($tarr); $i++) { 
		  $rarr[] = $arr[intval($karr[$i])]; 
	   } 
	   return $rarr; 
	} 
	
	protected function reverse_sort_array_of_objects($arr, $var) { 
	   $tarr = array(); 
	   $rarr = array(); 
	   for($i = 0; $i < count($arr); $i++) {
		  $element = $arr[$i]; 
		  $tarr[] = strtolower($element->{$var}); 
	   } 
	   reset($tarr); 
	   asort($tarr); 
	   $karr = array_keys($tarr); 
	   for($i = count($tarr)-1; $i > -1; $i--) { 
		  $rarr[] = $arr[intval($karr[$i])]; 
	   } 
	   return $rarr; 
	} 
	
}
?>
