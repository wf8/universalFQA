<?php
class TransectAssessment extends Assessment {

	protected $db_table = 'transect';
	public $transect_type;
	public $plot_size;
	public $subplot_size;
	public $transect_length;
	public $transect_description;
	public $cover_method_name;
	public $community_type_id;
	public $environment_description;

	public $quadrats = array(); // an array of Quadrat objects
	
	public function __construct( $id = null ) {
		Assessment::__construct( $id );
		if ($id !== null) {
			$result = $this->result;
			$this->transect_type = $result['transect_type'];
			$this->plot_size = $result['plot_size'];
			$this->subplot_size = $result['subplot_size'];
			$this->transect_length = $result['transect_length'];
			$this->transect_description = $result['transect_description'];
			$this->cover_method_name = $result['cover_method_name'];
			$this->community_type_id = $result['community_type_id'];
			$this->environment_description = $result['environment_description'];
			
			// load the transect quadrats
			$this->get_quadrats();
			$metrics = new TransectMetrics($this);
			$this->metrics = $metrics;
		}
	}
	
	public function get_all_for_user($user_id) {
		$assessments = Assessment::get_all_for_user($user_id);
		//$this->get_db_link();
		//foreach ($assessments as $assessment) {
		//	$assessment->get_quadrats();
		//	$metrics = new TransectMetrics($assessment);
		//	$assessment->metrics = $metrics;
		//}
		//mysqli_close($this->db_link);
		return $assessments;
	}
	
	public function get_all_public() {
		$assessments = Assessment::get_all_public();
		//$this->get_db_link();
		//foreach ($assessments as $assessment) {
		//	$assessment->get_quadrats();
		//	$metrics = new TransectMetrics($assessment);
		//	$assessment->metrics = $metrics;
		//}
		//mysqli_close($this->db_link);
		return $assessments;
	}
	
    public function get_all_public_for_fqa($fqa_id) {
		$assessments = Assessment::get_all_public_for_fqa($fqa_id);
		$this->get_db_link();
		foreach ($assessments as $assessment) {
			$assessment->get_quadrats();
			$metrics = new TransectMetrics($assessment);
			$assessment->metrics = $metrics;
		}
		mysqli_close($this->db_link);
		return $assessments;
	}
	
	/*
	 * load all the taxa for this inventory
	 */
	public function get_quadrats() {
		$this->get_db_link();
		$sql = "SELECT * FROM quadrat WHERE transect_id='$this->id'";
		$results = mysqli_query($this->db_link, $sql);
		while ($quad = mysqli_fetch_assoc($results)) {
			$quadrat = new Quadrat(null, null);
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
			$quadrat->get_taxa($this->db_link);
			$quadrat->compute_metrics();
			// add object to array
			$this->quadrats[] = $quadrat;
		}
		mysqli_close($this->db_link);
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
		$sql = "INSERT INTO transect (user_id, fqa_id, customized_fqa, site_id, date, private, name, practitioner, latitude, longitude,
    weather_notes, duration_notes, community_type_notes, other_notes, transect_type, plot_size, subplot_size, transect_length, transect_description, cover_method_name,
		community_type_id, environment_description) 
    VALUES ('$user_id', '$this->fqa_id', '$custom', '$site_id', '$this->date', '$this->private', '$this->name', '$this->practitioner', 
    '$this->latitude', '$this->longitude', '$this->weather_notes', '$this->duration_notes', '$this->community_type_notes', '$this->other_notes', 
    '$this->transect_type', '$this->plot_size', '$this->subplot_size', '$this->transect_length', '$this->transect_description', '$this->cover_method_name',
		'$this->community_type_id', '$this->environment_description')";
    mysqli_query($this->db_link, $sql);
    $transect_id = mysqli_insert_id($this->db_link);
    // insert quadrats
    foreach($this->quadrats as $quadrat) {
      $quadrat->save($transect_id, $this->db_link);
    }
    mysqli_close($this->db_link);
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
		practitioner = '$this->practitioner', name = '$this->name', latitude = '$this->latitude', longitude = '$this->longitude',
		weather_notes = '$this->weather_notes', duration_notes = '$this->duration_notes', community_type_notes = '$this->community_type_notes', 
		other_notes = '$this->other_notes', transect_type = '$this->transect_type', plot_size = '$this->plot_size', subplot_size = '$this->subplot_size',
		transect_length = '$this->transect_length', transect_description = '$this->transect_description', cover_method_name = '$this->cover_method_name',
		community_type_id = '$this->community_type_id', environment_description = '$this->environment_description' WHERE id = '$this->id'";
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
 			$quadrat->save($this->id, $this->db_link);
 		}
 		mysqli_close($this->db_link);
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
		mysqli_close($this->db_link);
	}
  	
	/*
	 *  return a csv report as a string
	 */
	public function download() {
	    
        $data = $this->get_data_array();
		return $this->return_CSV($data);
       
    }

    /*
     * return an array containing this assessment's data
     */
    public function get_data_array() {

		// build csv array
		$csv = array();
		$csv[] = array($this->name);
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
		$csv[] = array('Practitioner:', $this->practitioner);
		$csv[] = array('Latitude:', $this->latitude);
		$csv[] = array('Longitude:', $this->longitude);
		$csv[] = array('Community Type ID:', $this->community_type_id);
		$csv[] = array('Community Type Notes:', $this->community_type_notes);
		$csv[] = array('Weather Notes:', $this->weather_notes);
		$csv[] = array('Duration Notes:', $this->duration_notes);
		$csv[] = array('Other Notes:', $this->other_notes);
		$csv[] = array('Environment Description:', $this->environment_description);
		$csv[] = array('Type:', empty($this->transect_type) ? 'Transect' : $this->transect_type);
		$csv[] = array('Plot Size:', $this->plot_size);
		$csv[] = array('Subplot Size:', $this->subplot_size);
		$csv[] = array('Transect Length:', $this->transect_length);
		$csv[] = array('Transect Description:', $this->transect_description);
		$csv[] = array('Cover Method:', $this->cover_method_name);

		if ($this->private == 'private') 
			$csv[] = array('Private/Public:', 'Private');
		else
			$csv[] = array('Private/Public:', 'Public');
		$csv[] = array();
		
		$csv[] = array('Conservatism-Based Metrics:');
		$csv[] = array('Total Mean C:', $this->metrics->total_mean_c);
        $csv[] = array('Cover-weighted Mean C:', $this->metrics->cover_weighted_total_mean_c);
		$csv[] = array('Native Mean C:', $this->metrics->native_mean_c);
		$csv[] = array('Total FQI:', $this->metrics->total_fqi);
		$csv[] = array('Native FQI:', $this->metrics->native_fqi);
		$csv[] = array('Cover-weighted FQI:', $this->metrics->cover_weighted_total_fqi);
		$csv[] = array('Cover-weighted Native FQI:', $this->metrics->cover_weighted_native_fqi);
		$csv[] = array('Adjusted FQI:', $this->metrics->adjusted_fqi);
		$csv[] = array('% C value 0:', $this->metrics->percent_c_0);
		$csv[] = array('% C value 1-3:', $this->metrics->percent_c_1_3);
		$csv[] = array('% C value 4-6:', $this->metrics->percent_c_4_6);
		$csv[] = array('% C value 7-10:', $this->metrics->percent_c_7_10);
		$csv[] = array();	
		
		
		$csv[] = array('Species Richness:');
		$csv[] = array('Total Species:', $this->metrics->total_species);
		$csv[] = array('Native Species:', $this->metrics->native_species, $this->prettify_percent($this->metrics->percent_native_species));
		$csv[] = array('Non-native Species:', $this->metrics->non_native_species, $this->prettify_percent($this->metrics->percent_non_native_species));
		$csv[] = array();

		$csv[] = array('Species Wetness:');
		$csv[] = array('Mean Wetness:', $this->metrics->mean_wetness);
		$csv[] = array('Native Mean Wetness:', $this->metrics->native_mean_wetness);
		$csv[] = array();
		/*
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
		*/

		$csv[] = array('Duration Metrics:');
		$csv[] = array('Annual:', $this->metrics->annual, $this->prettify_percent($this->metrics->percent_annual));
		$csv[] = array('Perennial:', $this->metrics->perennial, $this->prettify_percent($this->metrics->percent_perennial));
		$csv[] = array('Biennial:', $this->metrics->biennial, $this->prettify_percent($this->metrics->percent_biennial));
		$csv[] = array('Native Annual:', $this->metrics->native_annual, $this->prettify_percent($this->metrics->percent_native_annual));
		$csv[] = array('Native Perennial:', $this->metrics->native_perennial, $this->prettify_percent($this->metrics->percent_native_perennial));
		$csv[] = array('Native Biennial:', $this->metrics->native_biennial, $this->prettify_percent($this->metrics->percent_native_biennial));
		$csv[] = array();
		
		$csv[] = array('Physiognomic Relative Importance Values:');
		$csv[] = array('Physiognomy','Frequency','Coverage','Relative Frequency (%)','Relative Coverage (%)','Relative Importance Value');
							
		$riv = $this->reverse_sort_array_of_arrays($this->metrics->riv, 'riv');
						
		foreach ($riv as $phys) { 
			if (trim($phys['riv']) !== '0') {
				$csv[] = array(
					$phys['physiognomy'], 
					$phys['frequency'], 
					$phys['coverage'],
					$phys['relative frequency'],
					$phys['relative coverage'],
					$phys['riv']
				);
			}
		}

		$csv[] = array();
		
		$csv[] = array('Species Relative Importance Values:');
		$csv[] = array('Species','Family','Acronym','Nativity','C','W','Physiognomy','Duration','Frequency','Coverage','Relative Frequency (%)','Relative Coverage (%)','Relative Importance Value');
		$taxa = $this->reverse_sort_array_of_objects($this->metrics->taxa, 'relative_importance_value');
		foreach ($taxa as $taxon) { 
			$csv[] = array(
							$taxon->taxa->scientific_name,
							$this->prettify_value($taxon->taxa->family),
							$this->prettify_value($taxon->taxa->acronym),
							$this->prettify_value($taxon->taxa->native),
							$this->prettify_value($taxon->taxa->c_o_c),
							$this->prettify_value($taxon->taxa->c_o_w),
							$this->prettify_value($taxon->taxa->physiognomy),
							$this->prettify_value($taxon->taxa->duration),
							$taxon->frequency,
							$taxon->coverage,
							$taxon->relative_frequency,
							$taxon->relative_cover,
							$taxon->relative_importance_value
						);
		}
		$csv[] = array();
		
		$csv[] = array('Quadrat Level Metrics:');
		$csv[] = array('Quadrat','Species Richness','Native Species Richness','Total Mean C','Native Mean C','Total FQI',
						'Native FQI','Cover-weighted FQI','Cover-weighted Native FQI','Adjusted FQI','Mean Wetness',
						'Mean Native Wetness','Latitude','Longitude');
		$quadrats = $this->sort_array_of_objects($this->quadrats, 'name');
		foreach ($quadrats as $quadrat) { 
			if ($quadrat->active) { 
				$csv[] = array(
								$quadrat->name,
								$quadrat->metrics->total_species,
								$quadrat->metrics->native_species,
								$quadrat->metrics->total_mean_c,
								$quadrat->metrics->native_mean_c,
								$quadrat->metrics->total_fqi,
								$quadrat->metrics->native_fqi,
								$quadrat->metrics->cover_weighted_total_fqi,
								$quadrat->metrics->cover_weighted_native_fqi,
								$quadrat->metrics->adjusted_fqi,
								$quadrat->metrics->mean_wetness,
								$quadrat->metrics->native_mean_wetness,
								$this->prettify_value($quadrat->latitude),
								$this->prettify_value($quadrat->longitude)
						);
			}
		}
		$csv[] = array(
						'Average',
						$this->metrics->avg_total_species,
						$this->metrics->avg_native_species,
						$this->metrics->avg_total_mean_c,
						$this->metrics->avg_native_mean_c,
						$this->metrics->avg_total_fqi,
						$this->metrics->avg_native_fqi,
						$this->metrics->avg_cover_weighted_total_fqi,
						$this->metrics->avg_cover_weighted_native_fqi,
						$this->metrics->avg_adjusted_fqi,
						$this->metrics->avg_mean_wetness,
						$this->metrics->avg_native_mean_wetness,
						'n/a',
						'n/a'
				);
		$csv[] = array(
						'Standard Deviation',
						$this->metrics->sd_total_species,
						$this->metrics->sd_native_species,
						$this->metrics->sd_total_mean_c,
						$this->metrics->sd_native_mean_c,
						$this->metrics->sd_total_fqi,
						$this->metrics->sd_native_fqi,
						$this->metrics->sd_cover_weighted_total_fqi,
						$this->metrics->sd_cover_weighted_native_fqi,
						$this->metrics->sd_adjusted_fqi,
						$this->metrics->sd_mean_wetness,
						$this->metrics->sd_native_mean_wetness,
						'n/a',
						'n/a'
				);
		$csv[] = array();
						
		foreach ($quadrats as $quadrat) { 
			if ($quadrat->active) { 
				$csv[] = array('Quadrat ' . $quadrat->name . ' Species:');	
				$csv[] = array('Scientific Name', 'Family', 'Acronym', '% Cover', 'Native?', 'C', 'W', 'Physiognomy', 'Duration', 'Common Name');
				if (count($quadrat->taxa) == 0) {
					$csv[] = array('There are no species in this quadrat.');
				} else {
					$sorted_taxa = $this->sort_array_of_objects($quadrat->taxa, 'scientific_name');
					foreach ($sorted_taxa as $taxon) {
						$csv[] = array(
									$taxon->scientific_name,
									$this->prettify_value($taxon->family),
									$this->prettify_value($taxon->acronym),
									$taxon->percent_cover,
									$taxon->native,
									$taxon->c_o_c,
									$this->prettify_value($taxon->c_o_w),
									$this->prettify_value($taxon->physiognomy),
									$this->prettify_value($taxon->duration),
									$this->prettify_value($taxon->common_name)
								);
					}
				}
				$csv[] = array();
			}
		}			
		return $csv;
	}	
	
	private function reverse_sort_array_of_arrays($arr, $var) { 
		   $tarr = array(); 
		   $rarr = array(); 
		   for($i = 0; $i < count($arr); $i++) { 
			  $element = $arr[$i]; 
			  $tarr[] = strtolower($element[$var]); 
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
