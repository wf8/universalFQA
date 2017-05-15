<?php

define ('UFQA_COVER_RANGE_MIDPOINT_DEFAULT', '% Range (Midpt)');

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
		
	public function __construct( $id = null, $db_link ) {
		if ($id !== null) {
			// load the quadrat taxa
			$this->get_taxa($db_link);
			$this->compute_metrics();
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
	public function add_taxa_by_column_value( $column, $value, $percent_cover, $cover_range_midpoint, $db_link ) {
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
			$taxa->percent_cover = !empty($percent_cover) ? $percent_cover : 0;
			$taxa->cover_range_midpoint = ($cover_range_midpoint === UFQA_COVER_RANGE_MIDPOINT_DEFAULT) ? '' : $cover_range_midpoint;
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
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude, percent_bare_ground, percent_water) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude', '$this->percent_bare_ground', '$this->percent_water')";
		if ($this->percent_bare_ground == '' && $this->percent_water !== '')
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude, percent_water) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude', '$this->percent_water')";
		
		if ($this->percent_bare_ground !== '' && $this->percent_water == '')
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude, percent_bare_ground) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude', '$this->percent_bare_ground')";
		
		if ($this->percent_bare_ground == '' && $this->percent_water == '')
			$sql = "INSERT INTO quadrat (transect_id, name, active, latitude, longitude) VALUES
					('$transect_id', '$this->name', '$this->active', '$this->latitude', '$this->longitude')";
		
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
	
}
?>
