<?php

define ('UFQA_COVER_RANGE_MIDPOINT_DEFAULT', '% Range (Midpt)');

// Quadrat "Type"
define ('UFQA_QUADRAT_SUBPLOT', 0);
define ('UFQA_FULL_PLOT', 1);
define ('UFQA_OUTSIDE_PLOT', 2);
define ('UFQA_REST_OF_PLOT', 3);

define ('UFQA_DEFAULT_SUBPLOT_NAME', 'QuadratSubplot');
define ('UFQA_FULL_PLOT_NAME', 'FullTrPlot');
define ('UFQA_REST_OF_PLOT_NAME', 'RestOfTrPlot');
define ('UFQA_OUTSIDE_PLOT_NAME', 'OutsideTrPlot');

class Quadrat {

	public $taxa = array(); // an array of Taxa or CustomTaxa objects
	public $fqa_id;
	public $custom_fqa;
	public $metrics; // a QuadratMetrics object
	
	public $name;
	public $active;
	public $latitude;
	public $longitude;
	public $percent_bare_ground;
	public $percent_water;
	public $quadrat_type;
		
	public function __construct( $id = null, $db_link ) {
		if ($id !== null) {
			// load the quadrat taxa
			$this->get_taxa($db_link);
			$this->compute_metrics();
		}
		$this->quadrat_type = UFQA_QUADRAT_SUBPLOT;
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
	 * function to get number of species
	 */
	public function get_species_richness() {
			return count($this->taxa);
	}
		
	/*
	 * add the taxa to this quadrat based on the value of a db column
	 * allows taxa to be added based on sci name, common name, or acronym
	 * return true/false depending on success of adding taxa
	 * will return true if taxa is already in assessment
	 */
	public function add_taxa_by_column_value( $column, $value, $percent_cover, $cover_range_midpoint, $cover_method_name, $db_link ) {
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
		$sql = "SELECT * FROM $taxa_db WHERE $taxa_db.$column LIKE '%$value%' AND $taxa_db.$fqa_column='$this->fqa_id'";
		$results = mysqli_query($db_link, $sql);
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

			// If cover method was selected, set the percent cover to the midpoint
			$taxa->cover_range_midpoint = 'Not Selected';
			if ($cover_range_midpoint !== UFQA_COVER_RANGE_MIDPOINT_DEFAULT) {
			  $taxa->cover_range_midpoint = $cover_range_midpoint;
				$cover_methods = Quadrat::get_cover_methods();
				$cover_method_list = $cover_methods[$cover_method_name];
				foreach ($cover_method_list as $cover_method_item) {
				  if ($cover_range_midpoint == $cover_method_item['display']) {
			      $percent_cover = $cover_method_item['value'];
					}
			  }
			}
			
			$taxa->percent_cover = $percent_cover;
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
	 * inserts a new quadrat
	 * 
	 * 
	 */
	public function save( $transect_id, $db_link ) {
		if ($this->percent_bare_ground !== '' && $this->percent_water !== '')
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude, percent_bare_ground, percent_water, quadrat_type) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude', '$this->percent_bare_ground', '$this->percent_water', '$this->quadrat_type')";
		if ($this->percent_bare_ground == '' && $this->percent_water !== '')
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude, percent_water, quadrat_type) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude', '$this->percent_water', '$this->quadrat_type')";
		
		if ($this->percent_bare_ground !== '' && $this->percent_water == '')
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude, percent_bare_ground, quadrat_type) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude', '$this->percent_bare_ground', '$this->quadrat_type')";
		
		if ($this->percent_bare_ground == '' && $this->percent_water == '')
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude, quadrat_type) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude', '$this->quadrat_type')";
		
		mysqli_query($db_link, $sql);
		$this->id = mysqli_insert_id($db_link);
		// insert each taxon
		foreach($this->taxa as $taxon) {
 			$sql = "INSERT INTO quadrat_taxa (quadrat_id, transect_id, percent_coverage, cover_range_midpoint, taxa_id) VALUES 
 						('$this->id', '$transect_id', '$taxon->percent_cover', '$taxon->cover_range_midpoint', '$taxon->id')";
 			mysqli_query($db_link, $sql);
 		}	
	}
	
	/*
	 * compute metrics for the quadrat
	 */
	public function compute_metrics() {
		$metrics = new QuadratMetrics($this);
		$this->metrics = $metrics;
	}
	
	/*
	 * delete the quadrat and all its taxa
	 */
	public function delete( $id ) {
		$this->get_db_link();
		$sql = "DELETE FROM quadrat_taxa WHERE quadrat_id='$id'";
		mysqli_query($this->db_link, $sql);
		$sql = "DELETE FROM quadrat WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
		mysqli_close($this->db_link);
	}
	
	/*
	 * load all the taxa for this quadrat
	 */
	public function get_taxa($db_link) {
		$id = $this->id;
		// load the inventory taxa
		$sql = "SELECT * FROM quadrat_taxa WHERE quadrat_id='$id'";
		$results = mysqli_query($db_link, $sql);
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
			$results2 = mysqli_query($db_link, $sql);
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
			$taxa->percent_cover = $taxa_to_add['percent_coverage'];
			$taxa->cover_range_midpoint = $taxa_to_add['cover_range_midpoint'];
			// add object to array
			$this->taxa[] = $taxa;
		}
	}
	
	public static function get_cover_methods() {
		$cover_methods = array(    
						'Not Specified' => array(),
						'Braun-Blanquet' => array(array('display' => 'r: single (0.05)', 'value' => 0.05),
						                          array('display' => '+: few (0.5)', 'value' => 0.5),
																			array('display' => '1: <5% (2.5)', 'value' => 2.5),
																			array('display' => '2: 5-25% (15)', 'value' => 15),
																			array('display' => '3: 25-50% (37.5)', 'value' => 37.5),
																		  array('display' => '4: 50-75% (62.5)', 'value' => 62.5),
																			array('display' => '5: 75-100% (87.5)', 'value' => 87.5),
																			),
						'PLOTS2 Braun-Blanquet' => array(array('display' => '1: <1% (0.5)', 'value' => 0.5),
						                                 array('display' => '2: 1-5% (3)', 'value' => 3),
																						 array('display' => '3: 5-25% (15)', 'value' => 15),
																						 array('display' => '4: 25-50% (37.5)', 'value' => 37.5),
																						 array('display' => '5: 50-75% (62.5)', 'value' => 62.5),
																						 array('display' => '6: 75-100% (87.5)', 'value' => 87.5),
																						),
						'Modified Braun-Blanquet 7-pt scale' => array(array('display' => '1: <1% (0.5)', 'value' => 0.5),
						                                              array('display' => '2: 1-5% (3)', 'value' => 3),
																													array('display' => '3a: 5-10% (7.5)', 'value' => 7.5),
																													array('display' => '3b: 10-25% (17.5)', 'value' => 17.5),
																													array('display' => '4: 25-50% (37.5)', 'value' => 37.5),
																													array('display' => '5: 50-75% (62.5)', 'value' => 62.5),
																													array('display' => '6: 75-100% (87.5)', 'value' => 87.5),
																													),
						'Carolina Vegetation Survey' => array(array('display' => '1: trace (0.05)', 'value' => 0.05),
						                                      array('display' => '2: 0.1-1% (0.505)', 'value' => 0.505),
																									array('display' => '3: 1-2% (1.5)', 'value' => 1.5),
																									array('display' => '4: 2-5% (3.5)', 'value' => 3.5),
																									array('display' => '5: 5-10% (7.5)', 'value' => 7.5),
																									array('display' => '6: 10-25% (17.5)', 'value' => 17.5),
																									array('display' => '7: 25-50% (37.5', 'value' => 37.5),
																									array('display' => '8: 50-75% (62.5)', 'value' => 62.5),
																									array('display' => '9: 75-95% (85)', 'value' => 85),
																									array('display' => '10: 95-100% (97.5)', 'value' => 97.5),
																									),
						'Daubenmire 1959' => array(array('display' => '1: 0-5% (2.5)', 'value' => 2.5),
						                           array('display' => '2: 5-25% (15)', 'value' => 15),
																			 array('display' => '3: 25-50% (37.5)', 'value' => 37.5),
																			 array('display' => '4: 50-75% (62.5)', 'value' => 62.5),
																			 array('display' => '5: 75-95% (85)', 'value' => 85),
																			 array('display' => '6: 95-100% (97.5)', 'value' => 97.5),
																			 ),
						'Domin' => array(),
						'U.S. Forest Service ECODATA' => array(array('display' => 'T: <1% (0.5)', 'value' => 0.5),
																									 array('display' => 'P: 1-4% (3)', 'value' => 3),
																									 array('display' => '1: 5-14% (10)', 'value' => 10),
																									 array('display' => '2: 15-24% (20)', 'value' => 20),
																									 array('display' => '3: 25-34% (30)', 'value' => 30),
																									 array('display' => '4: 35-44% (40)', 'value' => 40),
																									 array('display' => '5: 45-54% (50)', 'value' => 50),
																									 array('display' => '6: 55-64% (60)', 'value' => 60),
																									 array('display' => '7: 65-74% (70)', 'value' => 70),
																									 array('display' => '8: 75-84% (80)', 'value' => 80),
																									 array('display' => '9: 85-94% (90)', 'value' => 90),
																									 array('display' => '10: 95-100% (98)', 'value' => 98),
																									),
					);
		return $cover_methods;
	}
	
	public static function get_quadrat_types() {
	  $quadrat_types = array(
					UFQA_FULL_PLOT => 'Full Plot',
				);
	}
	
}
?>
