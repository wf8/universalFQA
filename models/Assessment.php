<?php
class Assessment {

	protected $db_table;
	
	public $id;
	public $date;
	public $private;
	public $practitioner;
 	public $latitude;
 	public $longitude;
 	public $weather_notes;
 	public $duration_notes;
 	public $community_type_notes;
 	public $other_notes;
	
	public $site;
	
	/*
	 * constructor
	 */
	protected function __construct() {
		
	}
	
	/*
	 * function to get hook to mysql database
	 */
	private function connect_to_db() {
		require('lib/fqa_config.php');
		$connection = mysql_connect($db_server, $db_username, $db_password);
		if (!$connection) 
			die('Not connected : ' . mysql_error());
		$db_selected = mysql_select_db($db_database);
		if (!$db_selected) 
			die ('Database error: ' . mysql_error());
	}
	
	/*
	 * return an array with all the user's assessments
	 */
    protected function get_all_for_user($user_id) {
    	$this->connect_to_db();
	    $sql = "SELECT $this->db_table.*, site.* FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.user_id='$user_id' ORDER BY site.name, $this->db_table.date";
		$results = mysql_query($sql);
		$assessments = array();
		while ($result = mysql_fetch_assoc($results)) {
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
    	$this->connect_to_db();
	    $sql = "SELECT $this->db_table.*, site.* FROM $this->db_table JOIN site ON $this->db_table.site_id = site.id WHERE $this->db_table.private='0' ORDER BY site.name, $this->db_table.date";
		$results = mysql_query($sql);			 
		$assessments = array();
		while ($result = mysql_fetch_assoc($results)) {		
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
	
}
?>