<?php
class TransectAssessment extends Assessment {

	protected $db_table = 'transect';
	public $quadrats = array(); // an array of Quadrat objects
	
	public function __construct( $id = null ) {
		Assessment::__construct( $id );
		if ($id !== null) {
			// load the transect quadrats
			//$this->get_quadrats();
			//$metrics = new TransectMetrics($this);
			//$this->metrics = $metrics;
		}
	}
	
	public function get_all_for_user($user_id) {
		return Assessment::get_all_for_user($user_id);
	}
	
	public function get_all_public() {
		return Assessment::get_all_public();
	}
	
	/*
	 * load all the taxa for this inventory
	 */
	public function get_quadrats() {
		$this->get_db_link();
		
	}
	
	/*
	 * inserts a new transect assessment
	 * takes as input the site_id and user_id
	 * return the new transect's id
	 */
	public function save( $user_id, $site_id ) {

		$this->get_db_link();
		if ($this->custom_fqa)
			$custom = 1;
		else
			$custom = 0;
		$sql = "INSERT INTO transect (user_id, fqa_id, customized_fqa, site_id, date, private, practitioner, latitude, longitude,
		weather_notes, duration_notes, community_type_notes, other_notes) VALUES ('$user_id', '$this->fqa_id', '$custom', '$site_id', 
		'$this->date', '$this->private', '$this->practitioner', '$this->latitude', '$this->longitude', '$this->weather_notes', '$this->duration_notes', 
		'$this->community_type_notes', '$this->other_notes')";
		mysqli_query($this->db_link, $sql);
		$transect_id = mysqli_insert_id($this->db_link);
		// insert quadrats
		foreach($this->quadrats as $quadrat) {
 			$quadrat->save($transect_id);
 		}
		return $transect_id;
	}
		
}
?>