<?php
class TransectAssessment extends Assessment {

	protected $db_table = 'transect';
	public $quadrats = array(); // an array of Quadrat objects
	
	public function __construct( $id = null ) {
		Assessment::__construct( $id );
		if ($id !== null) {
			// load the transect quadrats
			$this->get_quadrats();
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
		$sql = "SELECT * FROM quadrat WHERE transect_id='$this->id'";
		$results = mysqli_query($this->db_link, $sql);
		while ($quad = mysqli_fetch_assoc($results)) {
			$quadrat = new Quadrat();
			$quadrat->id = $quad['id'];
			$quadrat->transect_id = $this->id;
			$quadrat->name = $quad['name'];
			$quadrat->active = $quad['active'];
			$quadrat->latitude = $quad['latitude'];
			$quadrat->longitude = $quad['longitude'];
			$quadrat->percent_bare_ground = $quad['percent_bare_ground'];
			$quadrat->percent_water = $quad['percent_water'];
			$quadrat->fqa_id = $this->fqa_id;
			$quadrat->custom_fqa = $this->custom_fqa;
			$quadrat->get_taxa();
			// add object to array
			$this->quadrats[] = $quadrat;
		}
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
	
	/*
	 * updates existing transect assessment
	 */
	public function update() {

		$this->get_db_link();
		if ($this->custom_fqa)
			$custom = 1;
		else
			$custom = 0;
		$site_id = $this->site->id;
		$sql = "UPDATE transect SET fqa_id = '$this->fqa_id', customized_fqa = '$custom', site_id = '$site_id', date = '$this->date', private = '$this->private', 
		practitioner = '$this->practitioner', latitude = '$this->latitude', longitude = '$this->longitude',
		weather_notes = '$this->weather_notes', duration_notes = '$this->duration_notes', community_type_notes = '$this->community_type_notes', 
		other_notes = '$this->other_notes' WHERE id = '$this->id'";
		mysqli_query($this->db_link, $sql);
		$inventory_id = mysqli_insert_id($this->db_link);
		
		// delete the old quadrats
		$sql = "DELETE FROM quadrat WHERE transect_id='$this->id'";
		mysqli_query($this->db_link, $sql);
		// delete the old quadrat_taxa
		$sql = "DELETE FROM quadrat_taxa WHERE transect_id='$this->id'";
		mysqli_query($this->db_link, $sql);
		// save the new quadrats
		foreach($this->quadrats as $quadrat) {
 			$quadrat->save($this->id);
 		}
	}
	
	/*
	 * delete the transect and all its quadrats and their taxa
	 */
	public function delete( $id ) {
		$this->get_db_link();
		$sql = "DELETE FROM transect WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM quadrat WHERE transect_id='$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM quadrat_taxa WHERE transect_id='$id'";
		mysqli_query($this->db_link, $sql);
	}
		
}
?>