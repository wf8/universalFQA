<?php
class InventoryMetrics extends Metrics {

	public $total_mean_c = 0;
	public $native_mean_c = 0;
	public $native_tree_mean_c = 0;
	public $native_shrub_mean_c = 0;
	public $native_herbaceous_mean_c = 0;
	public $total_fqi = 0;
	public $native_fqi = 0;
	public $adjusted_fqi = 0;
	public $percent_c_0 = 0;
	public $percent_c_1_3 = 0;
	public $percent_c_4_6 = 0;
	public $percent_c_7_10 = 0;
	
	public $total_species = 0;
	public $native_species = 0;
	public $non_native_species = 0;
	public $percent_native_species = 0;
	public $percent_non_native_species = 0;
	public $mean_wetness = 0;
	public $native_mean_wetness = 0;

	public $tree = 0;
	public $shrub = 0;
	public $vine = 0;
	public $forb = 0;
	public $grass = 0;
	public $sedge = 0;
	public $rush = 0;
	public $fern = 0;
	public $bryophyte = 0;
	
	public $percent_tree = 0;
	public $percent_shrub = 0;
	public $percent_vine = 0;
	public $percent_forb = 0;
	public $percent_grass = 0;
	public $percent_sedge = 0;
	public $percent_rush = 0;
	public $percent_fern = 0;
	public $percent_bryophyte = 0;

	public $annual = 0;
	public $perennial = 0;
	public $biennial = 0;
	
	public $native_annual = 0;
	public $native_perennial = 0;
	public $native_biennial = 0;
	
	public $percent_annual = 0;
	public $percent_perennial = 0;
	public $percent_biennial = 0;
	
	public $percent_native_annual = 0;
	public $percent_native_perennial = 0;
	public $percent_native_biennial = 0;

	/*
	 * constructor
	 * takes as input an InventoryAssessment object
	 */
	public function __construct( $inventory ) {
	
		Metrics::__construct( $inventory );
		
		$taxa = $inventory->taxa;
		$total_c = 0;
		$native_c = 0;
		$total_w = 0;
		$native_w = 0;
		
		$native_tree_c = 0;
		$native_shrub_c = 0;
		$native_herbaceous_c = 0;
		
		$c_0 = 0;
		$c_1_3 = 0;
		$c_4_6 = 0;
		$c_7_10 = 0;
		
		$native_tree = 0;
		$native_shrub = 0;
		$native_herbaceous = 0;
		
		// checks to see if these data are in the taxon's fqa_db
		// if no data set metrics to 'n/a'
		$physiognomy = false;
		$duration = false;
		$wetness = false;
		
		foreach( $taxa as $taxon ) {
			$this->total_species++;
			$total_c += $taxon->c_o_c;
			
			if (trim($taxon->c_o_w) !== '') {
				$wetness = true;
				$total_w += $taxon->c_o_w;
			}
			
			if ($taxon->native == 'native') {
				$this->native_species++;
				$native_c += $taxon->c_o_c;
				$native_w += $taxon->c_o_w;
			}
			
			if ($taxon->c_o_c == 0)
				$c_0++;
			else if (0 < $taxon->c_o_c && $taxon->c_o_c < 4)
				$c_1_3++;
			else if (3 < $taxon->c_o_c && $taxon->c_o_c < 7)
				$c_4_6++;
			else if (6 < $taxon->c_o_c && $taxon->c_o_c < 11)
				$c_7_10++;
			
			if ($taxon->duration == 'annual') {
				$duration = true;
				$this->annual++;
				if ($taxon->native == 'native') {
					$this->native_annual++;
				}
			}
			if ($taxon->duration == 'perennial') {
				$duration = true;
				$this->perennial++;
				if ($taxon->native == 'native') {
					$this->native_perennial++;
				}
			}
			if ($taxon->duration == 'biennial') {
				$duration = true;
				$this->biennial++;
				if ($taxon->native == 'native') {
					$this->native_biennial++;
				}
			}
			switch ($taxon->physiognomy) {
				case 'tree':
					$physiognomy = true;
					$this->tree++;
					if ($taxon->native == 'native') {
						$native_tree_c += $taxon->c_o_c;
						$native_tree++;
					}
					break;
				case 'shrub':
					$physiognomy = true;
					$this->shrub++;
					if ($taxon->native == 'native') {
						$native_shrub_c += $taxon->c_o_c;
						$native_shrub++;
					}
					break;
				case 'vine':
					$physiognomy = true;
					$this->vine++;
					if ($taxon->native == 'native') {
						$native_herbaceous_c += $taxon->c_o_c;
						$native_herbaceous++;
					}
					break;
				case 'forb':
					$physiognomy = true;
					$this->forb++;
					if ($taxon->native == 'native') {
						$native_herbaceous_c += $taxon->c_o_c;
						$native_herbaceous++;
					}
					break;
				case 'grass':
					$physiognomy = true;
					$this->grass++;
					if ($taxon->native == 'native') {
						$native_herbaceous_c += $taxon->c_o_c;
						$native_herbaceous++;
					}
					break;
				case 'sedge':
					$physiognomy = true;
					$this->sedge++;
					if ($taxon->native == 'native') {
						$native_herbaceous_c += $taxon->c_o_c;
						$native_herbaceous++;
					}
					break;
				case 'rush':
					$physiognomy = true;
					$this->rush++;
					if ($taxon->native == 'native') {
						$native_herbaceous_c += $taxon->c_o_c;
						$native_herbaceous++;
					}
					break;
				case 'fern':
					$physiognomy = true;
					$this->fern++;
					if ($taxon->native == 'native') {
						$native_herbaceous_c += $taxon->c_o_c;
						$native_herbaceous++;
					}
					break;
				case 'bryophyte':
					$physiognomy = true;
					$this->bryophyte++;
					if ($taxon->native == 'native') {
						$native_herbaceous_c += $taxon->c_o_c;
						$native_herbaceous++;
					}
					break;
			}
			
		}
		
		if (!$physiognomy) {
			$this->tree = 'n/a';
			$this->shrub = 'n/a';
			$this->vine = 'n/a';
			$this->forb = 'n/a';
			$this->grass = 'n/a';
			$this->sedge = 'n/a';
			$this->rush = 'n/a';
			$this->fern = 'n/a';
			$this->bryophyte = 'n/a';
			$this->percent_tree = '';
			$this->percent_shrub = '';
			$this->percent_vine = '';
			$this->percent_forb = '';
			$this->percent_grass = '';
			$this->percent_sedge = '';
			$this->percent_rush = '';
			$this->percent_fern = '';
			$this->percent_bryophyte = '';
		} else {
			if ($native_tree == 0)
				$this->native_tree_mean_c = 'n/a';
			else
				if ($this->native_species > 0) {
					$this->native_tree_mean_c = round(($native_tree_c / $this->native_species),1);
				}
			if ($native_shrub == 0)
				$this->native_shrub_mean_c = 'n/a';
			else
				if ($this->native_species > 0) {
					$this->native_shrub_mean_c = round(($native_shrub_c / $this->native_species),1);
				}
			if ( $native_herbaceous == 0 )
				$this->native_herbaceous_mean_c = 'n/a';
			else
				if ($this->native_species > 0) {
					$this->native_herbaceous_mean_c = round(($native_herbaceous_c / $this->native_species),1);
				}
			if ($this->total_species > 0) {
				$this->percent_tree = round(100*$this->tree / $this->total_species,1);
				$this->percent_shrub = round(100*$this->shrub / $this->total_species,1);
				$this->percent_vine = round(100*$this->vine / $this->total_species,1);
				$this->percent_forb = round(100*$this->forb / $this->total_species,1);
				$this->percent_grass = round(100*$this->grass / $this->total_species,1);
				$this->percent_sedge = round(100*$this->sedge / $this->total_species,1);
				$this->percent_rush = round(100*$this->rush / $this->total_species,1);
				$this->percent_fern = round(100*$this->fern / $this->total_species,1);
				$this->percent_bryophyte = round(100*$this->bryophyte / $this->total_species,1);
			}
		}
		
		if (!$duration) {
			$this->annual = 'n/a';
			$this->perennial = 'n/a';
			$this->biennial = 'n/a';
	
			$this->native_annual = 'n/a';
			$this->native_perennial = 'n/a';
			$this->native_biennial = 'n/a';
			
			$this->percent_annual = '';
			$this->percent_perennial = '';
			$this->percent_biennial = '';
	
			$this->percent_native_annual = '';
			$this->percent_native_perennial = '';
			$this->percent_native_biennial = '';
		} else {
			if ($this->total_species > 0) {
				$this->percent_annual = round(100*$this->annual / $this->total_species,1);
				$this->percent_perennial = round(100*$this->perennial / $this->total_species,1);
				$this->percent_biennial = round(100*$this->biennial / $this->total_species,1);
		
				$this->percent_native_annual = round(100*$this->native_annual / $this->native_species,1);
				$this->percent_native_perennial = round(100*$this->native_perennial / $this->native_species,1);
				$this->percent_native_biennial = round(100*$this->native_biennial / $this->native_species,1);
			}
		}
		
		if ($wetness) {
			if ($this->total_species > 0) 
				$this->mean_wetness = round(($total_w / $this->total_species),1);
			if ($this->native_species > 0) 
				$this->native_mean_wetness = round(($native_w / $this->native_species),1);
		} else {
			$this->mean_wetness = 'n/a';
			$this->native_mean_wetness = 'n/a';
		}
		
		$this->non_native_species = $this->total_species - $this->native_species;
			
		if ($this->native_species > 0) {
		
			$this->native_mean_c = round(($native_c / $this->native_species),1);
			$this->native_fqi = round(($this->native_mean_c * sqrt( $this->native_species ) ), 1);
		}
		
		if ($this->total_species > 0) {
		
			$this->total_mean_c = round(($total_c / $this->total_species),1);
			
			$this->percent_c_0 = round(($c_0 / $this->total_species) * 100,1);
			$this->percent_c_1_3 = round(($c_1_3 / $this->total_species) * 100,1);
			$this->percent_c_4_6 = round(($c_4_6 / $this->total_species) * 100,1);
			$this->percent_c_7_10 = round(($c_7_10 / $this->total_species) * 100,1);
			
			$this->percent_native_species = round(100*($this->native_species/$this->total_species),1);
			$this->percent_non_native_species = round(100*($this->non_native_species/$this->total_species),1);
			
			$this->total_fqi = round(( $this->total_mean_c * sqrt( $this->total_species ) ), 1);
			
			$this->adjusted_fqi = round( ( ( $this->native_mean_c / 10 ) * ( sqrt( $this->native_species ) / sqrt( $this->total_species ) ) * 100 ), 1);
		}	
	}	
}
?>