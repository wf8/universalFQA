<?php
class InventoryAssessment extends Assessment {

	protected $db_table = 'inventory';
	public $taxa = array(); // an array of Taxa or CustomTaxa objects
	
	public function __construct( $id = null ) {
		Assessment::__construct( $id );
		if ($id !== null) {
			// load the inventory taxa
			$this->get_taxa();
			$metrics = new InventoryMetrics($this);
			$this->metrics = $metrics;
		}
	}
	
	public function get_all_for_user($user_id) {
		$assessments = Assessment::get_all_for_user($user_id);
		$this->get_db_link();
		foreach ($assessments as $assessment) {
			$assessment->get_taxa();
			$metrics = new InventoryMetrics($assessment);
			$assessment->metrics = $metrics;
		}
		return $assessments;
	}
	
	public function get_all_public() {
		$assessments = Assessment::get_all_public();
		$this->get_db_link();
		foreach ($assessments as $assessment) {
			$assessment->get_taxa();
			$metrics = new InventoryMetrics($assessment);
			$assessment->metrics = $metrics;
		}
		return $assessments;
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
	
	/*
	 * inserts a new inventory assessment
	 * takes as input the site_id and user_id
	 * return the new inventory's id
	 */
	public function save( $user_id, $site_id ) {

		$this->get_db_link();
		if ($this->custom_fqa)
			$custom = 1;
		else
			$custom = 0;
		$sql = "INSERT INTO inventory (user_id, fqa_id, customized_fqa, site_id, date, private, practitioner, latitude, longitude,
		weather_notes, duration_notes, community_type_notes, other_notes) VALUES ('$user_id', '$this->fqa_id', '$custom', '$site_id', 
		'$this->date', '$this->private', '$this->practitioner', '$this->latitude', '$this->longitude', '$this->weather_notes', '$this->duration_notes', 
		'$this->community_type_notes', '$this->other_notes')";
		mysqli_query($this->db_link, $sql);
		$inventory_id = mysqli_insert_id($this->db_link);
		// insert taxa
		foreach($this->taxa as $taxon) {
 			$taxa_id = $taxon->id;
 			$sql = "INSERT INTO inventory_taxa (inventory_id, site_id, taxa_id) VALUES ('$inventory_id', '$site_id', '$taxa_id')";
 			mysqli_query($this->db_link, $sql);
 		}
		return $inventory_id;
	}
	
	/*
	 * updates existing inventory assessment
	 */
	public function update() {

		$this->get_db_link();
		if ($this->custom_fqa)
			$custom = 1;
		else
			$custom = 0;
		$sql = "UPDATE inventory SET customized_fqa = '$custom', site_id = '$this->site->id', date = '$this->date', private = '$this->private', 
		practitioner = '$this->practitioner', latitude = '$this->latitude', longitude = '$this->longitude',
		weather_notes = '$this->weather_notes', duration_notes = '$this->duration_notes', community_type_notes = '$this->community_type_notes', 
		other_notes = '$this->other_notes' WHERE id = '$this->id'";
		mysqli_query($this->db_link, $sql);
		$inventory_id = mysqli_insert_id($this->db_link);
		// remember the new taxa for this inventory
		$new_taxa = $this->taxa;
		// get the old taxa for this inventory
		$this->get_taxa();
		$old_taxa = $this->taxa;
		// reset the new taxa in this object
		$this->taxa = $new_taxa;
		// check to see if this new taxa was one of the old taxa
		// or if we need to insert a new inventory_taxa
		foreach($new_taxa as $new_taxon) {
			$need_to_insert = true;
			foreach($old_taxa as $old_taxon) {
				if ($old_taxon->id == $new_taxon->id) {
					$need_to_insert = false;
					break;
				}
			}
			if ($need_to_insert) {
				$sql = "INSERT INTO inventory_taxa (inventory_id, site_id, taxa_id) VALUES ('$this->id', '$this->site->id', '$new_taxon->id')";
				mysqli_query($this->db_link, $sql);
			}
 		}
 		// check to see if any of the old taxa
 		// need to be deleted from inventory_taxa
		foreach($old_taxa as $old_taxon) {
			$need_to_delete = true;
			foreach($new_taxa as $new_taxon) {
				if ($old_taxon->id == $new_taxon->id) {
					$need_to_delete = false;
					break;
				}
			}
			if ($need_to_delete) {
				$sql = "DELETE FROM inventory_taxa WHERE inventory_id = '$this->id' AND taxa_id = '$new_taxon->id')";
				mysqli_query($this->db_link, $sql);
			}
		}
	}
	
	/*
	 * delete the inventory and all its taxa
	 */
	public function delete( $id ) {
		$this->get_db_link();
		$sql = "DELETE FROM inventory_taxa WHERE inventory_id='$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM inventory WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
	}
	
	/*
	 * load all the taxa for this inventory
	 */
	public function get_taxa() {
		$this->get_db_link();
		$id = $this->id;
		// load the inventory taxa
		$sql = "SELECT * FROM inventory_taxa WHERE inventory_id='$id'";
		$results = mysqli_query($this->db_link, $sql);
		while ($taxa_to_add = mysqli_fetch_assoc($results)) {
			// got the taxa id
			$id_to_add = $taxa_to_add['taxa_id'];
			// make an object for the taxa
			if ($this->custom_fqa) {
				$taxa = new CustomTaxa();
				$taxa_db = 'customized_taxa';
				$fqa_column = 'customized_fqa_id';
			} else {
				$taxa = new Taxa();
				$taxa_db = 'taxa';
				$fqa_column = 'fqa_id';
			}
			// get the taxa data
			$sql = "SELECT * FROM $taxa_db WHERE id='$id_to_add'";
			$results2 = mysqli_query($this->db_link, $sql);
			$result = mysqli_fetch_assoc($results2);
			// populate taxa object
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
			// add object to array
			$this->taxa[] = $taxa;
		}
	}
	
}
?>