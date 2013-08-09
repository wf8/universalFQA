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
			mysqli_close($this->db_link);
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
					mysqli_close($this->db_link);
					return true;
				}
			}
			mysqli_close($this->db_link);
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
 		mysqli_close($this->db_link);
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
		$site_id = $this->site->id;
		$sql = "UPDATE inventory SET fqa_id = '$this->fqa_id', customized_fqa = '$custom', site_id = '$site_id', date = '$this->date', private = '$this->private', 
		practitioner = '$this->practitioner', latitude = '$this->latitude', longitude = '$this->longitude',
		weather_notes = '$this->weather_notes', duration_notes = '$this->duration_notes', community_type_notes = '$this->community_type_notes', 
		other_notes = '$this->other_notes' WHERE id = '$this->id'";
		mysqli_query($this->db_link, $sql);
		$inventory_id = mysqli_insert_id($this->db_link);
		
		// delete the old taxa
		$sql = "DELETE FROM inventory_taxa WHERE inventory_id='$this->id'";
		mysqli_query($this->db_link, $sql);
		// insert the new taxa
		foreach($this->taxa as $taxon) {
 			$taxa_id = $taxon->id;
 			$sql = "INSERT INTO inventory_taxa (inventory_id, site_id, taxa_id) VALUES ('$this->id', '$site_id', '$taxa_id')";
 			mysqli_query($this->db_link, $sql);
 		}
 		mysqli_close($this->db_link);
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
		mysqli_close($this->db_link);
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
		mysqli_close($this->db_link);
	}
	
	/*
	 *  return a csv report as a string
	 */
	public function download() {
		
		// build csv array
		$csv = array();
		$csv[] = array($this->date);
		$csv[] = array($this->site->name);
		$csv[] = array($this->site->city);
		$csv[] = array($this->site->county);
		$csv[] = array($this->site->state);
		$csv[] = array($this->site->country);
		
		if ($this->custom_fqa) { 
			$csv[] = array('Custom FQA DB Name:', $this->fqa->customized_name);
			$csv[] = array('Custom FQA DB Description:', $this->fqa->customized_description);
			$csv[] = array('Original FQA DB Region:', $this->fqa->region_name);
			$csv[] = array('Original FQA DB Publication Year:', $this->fqa->publication_year);
			$csv[] = array('Original FQA DB Description:', $this->fqa->description);
		} else {
			$csv[] = array('FQA DB Region:', $this->fqa->region_name);
			$csv[] = array('FQA DB Publication Year:', $this->fqa->publication_year);
			$csv[] = array('FQA DB Description:', $this->fqa->description);
		}
		$csv[] = array();
		$csv[] = array('Pracitioner:', $this->practitioner);
		$csv[] = array('Latitude:', $this->latitude);
		$csv[] = array('Longitude:', $this->longitude);
		$csv[] = array('Weather Notes:', $this->weather_notes);
		$csv[] = array('Duration Notes:', $this->duration_notes);
		$csv[] = array('Community Type Notes:', $this->community_type_notes);
		$csv[] = array('Other Notes:', $this->other_notes);
		if ($this->private == 'private') 
			$csv[] = array('Private/Public:', 'Private');
		else
			$csv[] = array('Private/Public:', 'Public');
		$csv[] = array();
		
		$csv[] = array('Conservatism-Based Metrics:');
		$csv[] = array('Total Mean C:', $this->metrics->total_mean_c);
		$csv[] = array('Native Mean C:', $this->metrics->native_mean_c);
		$csv[] = array('Native Tree Mean C:', $this->metrics->native_tree_mean_c);
		$csv[] = array('Native Shrub Mean C:', $this->metrics->native_shrub_mean_c);
		$csv[] = array('Native Herbaceous Mean C:', $this->metrics->native_herbaceous_mean_c);
		$csv[] = array('Total FQI:', $this->metrics->total_fqi);
		$csv[] = array('Native FQI:', $this->metrics->native_fqi);
		$csv[] = array('Adjusted FQI:', $this->metrics->adjusted_fqi);
		$csv[] = array('% C value 0:', $this->metrics->percent_c_0);
		$csv[] = array('% C value 1-3:', $this->metrics->percent_c_1_3);
		$csv[] = array('% C value 4-6:', $this->metrics->percent_c_4_6);
		$csv[] = array('% C value 7-10:', $this->metrics->percent_c_7_10);
		$csv[] = array();
		
		$csv[] = array('Species Richness and Wetness:');
		$csv[] = array('Total Species:', $this->metrics->total_species);
		$csv[] = array('Native Species:', $this->metrics->native_species, $this->prettify_percent($this->metrics->percent_native_species));
		$csv[] = array('Non-native Species:', $this->metrics->non_native_species, $this->prettify_percent($this->metrics->percent_non_native_species));
		$csv[] = array('Mean Wetness:', $this->metrics->mean_wetness);
		$csv[] = array('Native Mean Wetness:', $this->metrics->native_mean_wetness);
		$csv[] = array();

		$csv[] = array('Physiognomy Metrics:');
		$csv[] = array('Tree:', $this->metrics->tree, $this->prettify_percent($this->metrics->percent_tree));
		$csv[] = array('Shrub:', $this->metrics->shrub, $this->prettify_percent($this->metrics->percent_shrub));
		$csv[] = array('Vine:', $this->metrics->vine, $this->prettify_percent($this->metrics->percent_vine));
		$csv[] = array('Forb:', $this->metrics->forb, $this->prettify_percent($this->metrics->percent_forb));
		$csv[] = array('Grass:', $this->metrics->grass, $this->prettify_percent($this->metrics->percent_grass));
		$csv[] = array('Sedge:', $this->metrics->sedge, $this->prettify_percent($this->metrics->percent_sedge));
		$csv[] = array('Rush:', $this->metrics->rush, $this->prettify_percent($this->metrics->percent_rush));
		$csv[] = array('Fern:', $this->metrics->fern, $this->prettify_percent($this->metrics->percent_fern));
		$csv[] = array('Bryophyte:', $this->metrics->bryophyte, $this->prettify_percent($this->metrics->percent_bryophyte));
		$csv[] = array();
	

		$csv[] = array('Duration Metrics:');
		$csv[] = array('Annual:', $this->metrics->annual, $this->prettify_percent($this->metrics->percent_annual));
		$csv[] = array('Perennial:', $this->metrics->perennial, $this->prettify_percent($this->metrics->percent_perennial));
		$csv[] = array('Biennial:', $this->metrics->biennial, $this->prettify_percent($this->metrics->percent_biennial));
		$csv[] = array('Native Annual:', $this->metrics->native_annual, $this->prettify_percent($this->metrics->percent_native_annual));
		$csv[] = array('Native Perennial:', $this->metrics->native_perennial, $this->prettify_percent($this->metrics->percent_native_perennial));
		$csv[] = array('Native Biennial:', $this->metrics->native_biennial, $this->prettify_percent($this->metrics->percent_native_biennial));
		$csv[] = array();
		
		$csv[] = array('Species:');
		$csv[] = array('Scientific Name', 'Family', 'Acronym', 'Native?', 'C', 'W', 'Physiognomy', 'Duration', 'Common Name');
		if (count($this->taxa) == 0) {
			$csv[] = array('There are no species in this inventory.');
		} else {
			$sorted_taxa = $this->sort_array_of_objects($this->taxa, 'scientific_name');
			foreach ($sorted_taxa as $taxon) {
				$csv[] = array(
							$taxon->scientific_name,
							$this->prettify_value($taxon->family),
							$this->prettify_value($taxon->acronym),
							$taxon->native,
							$taxon->c_o_c,
							$this->prettify_value($taxon->c_o_w),
							$this->prettify_value($taxon->physiognomy),
							$this->prettify_value($taxon->duration),
							$this->prettify_value($taxon->common_name)
						);
			}
		}
		return $this->return_CSV($csv);
	}
}
?>