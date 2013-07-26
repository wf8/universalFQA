<?php
class InventoryAssessment extends Assessment {

	protected $db_table = 'inventory';
	public $taxa = array(); // an array of Taxa or CustomTaxa objects
	
	public function __construct( $id = null ) {
		Assessment::__construct( $id );
		if ($id !== null) {
			// load the inventory taxa
			$this->get_db_link();
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
	
	public function get_all_for_user($user_id) {
		return Assessment::get_all_for_user($user_id);
	}
	
	public function get_all_public() {
		return Assessment::get_all_public();
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
	 * delete the inventory and all its taxa
	 */
	public function delete( $id ) {
		$this->get_db_link();
		$sql = "DELETE FROM inventory_taxa WHERE inventory_id='$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM inventory WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
	}
	
}
?>