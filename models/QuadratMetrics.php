<?php
class QuadratMetrics extends Metrics {

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

	public $cover_weighted_total_mean_c = 0;
	public $cover_weighted_native_mean_c = 0;
	public $cover_weighted_total_fqi = 0;
	public $cover_weighted_native_fqi = 0;

	public $tree = 0;
	public $shrub = 0;
	public $vine = 0;
	public $forb = 0;
	public $grass = 0;
	public $sedge = 0;
	public $rush = 0;
	public $fern = 0;
	public $bryophyte = 0;
	
	public $tree_coverage = 0;
	public $shrub_coverage = 0;
	public $vine_coverage = 0;
	public $forb_coverage = 0;
	public $grass_coverage = 0;
	public $sedge_coverage = 0;
	public $rush_coverage = 0;
	public $fern_coverage = 0;
	public $bryophyte_coverage = 0;
	
	public $percent_tree = 0;
	public $percent_shrub = 0;
	public $percent_vine = 0;
	public $percent_forb = 0;
	public $percent_grass = 0;
	public $percent_sedge = 0;
	public $percent_rush = 0;
	public $percent_fern = 0;
	public $percent_bryophyte = 0;
	
	public $percent_tree_coverage = 0;
	public $percent_shrub_coverage = 0;
	public $percent_vine_coverage = 0;
	public $percent_forb_coverage = 0;
	public $percent_grass_coverage = 0;
	public $percent_sedge_coverage = 0;
	public $percent_rush_coverage = 0;
	public $percent_fern_coverage = 0;
	public $percent_bryophyte_coverage = 0;
	
	public $tree_riv = 0;
	public $shrub_riv = 0;
	public $vine_riv = 0;
	public $forb_riv = 0;
	public $grass_riv = 0;
	public $sedge_riv = 0;
	public $rush_riv = 0;
	public $fern_riv = 0;
	public $bryophyte_riv = 0;

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

	protected $total_c = 0;
	protected $native_c = 0;
	protected $total_w = 0;
	protected $native_w = 0;
		
	protected $native_tree_c = 0;
	protected $native_shrub_c = 0;
	protected $native_vine_c = 0;
	protected $native_forb_c = 0;
	protected $native_grass_c = 0;
	protected $native_sedge_c = 0;
	protected $native_rush_c = 0;
	protected $native_bryophyte_c = 0;
	protected $native_herbaceous_c = 0;
		
	protected $c_0 = 0;
	protected $c_1_3 = 0;
	protected $c_4_6 = 0;
	protected $c_7_10 = 0;
		
	protected $native_tree = 0;
	protected $native_shrub = 0;
	protected $native_herbaceous = 0;
		
	protected $total_coverage = 0;
	protected $total_percent_cover = 0;
	protected $native_coverage = 0;
	protected $native_percent_cover = 0;
	protected $sum_total_c_times_coverage = 0;	
	protected $sum_native_c_times_coverage = 0;
		
	// checks to see if these data are in the taxon's fqa_db
	// if no data set metrics to 'n/a'
	protected $physiognomy = false;
	protected $duration = false;
	protected $wetness = false;

	/*
	 * constructor
	 * takes as input an Quadrat object
	 */
	public function __construct( $quadrat ) {
	
		Metrics::__construct( $quadrat );
		
		$taxa = $quadrat->taxa;
		
		foreach( $taxa as $taxon ) {
			$this->total_species++;
			$this->total_c += $taxon->c_o_c;
			$this->total_coverage += $taxon->percent_cover;
			$this->sum_total_c_times_coverage += ($taxon->percent_cover * $taxon->c_o_c);
			
			if (trim($taxon->c_o_w) !== '') {
				$this->wetness = true;
				$this->total_w += $taxon->c_o_w;
			}
			
			if ($taxon->native == 'native') {
				$this->native_species++;
				$this->native_c += $taxon->c_o_c;
				$this->native_w += $taxon->c_o_w;
				$this->native_coverage += $taxon->percent_cover;
				$this->sum_native_c_times_coverage += ($taxon->percent_cover * $taxon->c_o_c);
			}
			
			if ($taxon->c_o_c == 0)
				$this->c_0++;
			else if (0 < $taxon->c_o_c && $taxon->c_o_c < 4)
				$this->c_1_3++;
			else if (3 < $taxon->c_o_c && $taxon->c_o_c < 7)
				$this->c_4_6++;
			else if (6 < $taxon->c_o_c && $taxon->c_o_c < 11)
				$this->c_7_10++;
			
			if ($taxon->duration == 'annual') {
				$this->duration = true;
				$this->annual++;
				if ($taxon->native == 'native') {
					$this->native_annual++;
				}
			}
			if ($taxon->duration == 'perennial') {
				$this->duration = true;
				$this->perennial++;
				if ($taxon->native == 'native') {
					$this->native_perennial++;
				}
			}
			if ($taxon->duration == 'biennial') {
				$this->duration = true;
				$this->biennial++;
				if ($taxon->native == 'native') {
					$this->native_biennial++;
				}
			}
			switch ($taxon->physiognomy) {
				case 'tree':
					$this->physiognomy = true;
					$this->tree++;
					$this->tree_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_tree_c += $taxon->c_o_c;
						$this->native_tree++;
					}
					break;
				case 'shrub':
					$this->physiognomy = true;
					$this->shrub++;
					$this->shrub_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_shrub_c += $taxon->c_o_c;
						$this->native_shrub++;
					}
					break;
				case 'vine':
					$this->physiognomy = true;
					$this->vine++;
					$this->vine_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_herbaceous_c += $taxon->c_o_c;
						$this->native_herbaceous++;
					}
					break;
				case 'forb':
					$this->physiognomy = true;
					$this->forb++;
					$this->forb_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_herbaceous_c += $taxon->c_o_c;
						$this->native_herbaceous++;
					}
					break;
				case 'grass':
					$this->physiognomy = true;
					$this->grass++;
					$this->grass_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_herbaceous_c += $taxon->c_o_c;
						$this->native_herbaceous++;
					}
					break;
				case 'sedge':
					$this->physiognomy = true;
					$this->sedge++;
					$this->sedge_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_herbaceous_c += $taxon->c_o_c;
						$this->native_herbaceous++;
					}
					break;
				case 'rush':
					$this->physiognomy = true;
					$this->rush++;
					$this->rush_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_herbaceous_c += $taxon->c_o_c;
						$this->native_herbaceous++;
					}
					break;
				case 'fern':
					$this->physiognomy = true;
					$this->fern++;
					$this->fern_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_herbaceous_c += $taxon->c_o_c;
						$this->native_herbaceous++;
					}
					break;
				case 'bryophyte':
					$this->physiognomy = true;
					$this->bryophyte++;
					$this->bryophyte_coverage += $taxon->percent_cover;
					if ($taxon->native == 'native') {
						$this->native_herbaceous_c += $taxon->c_o_c;
						$this->native_herbaceous++;
					}
					break;
			}
			
		}
		
		if (!$this->physiognomy) {
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
			$this->tree_coverage = 'n/a';
			$this->shrub_coverage = 'n/a';
			$this->vine_coverage = 'n/a';
			$this->forb_coverage = 'n/a';
			$this->grass_coverage = 'n/a';
			$this->sedge_coverage = 'n/a';
			$this->rush_coverage = 'n/a';
			$this->fern_coverage = 'n/a';
			$this->bryophyte_coverage = 'n/a';
			$this->percent_tree_coverage = '';
			$this->percent_shrub_coverage = '';
			$this->percent_vine_coverage = '';
			$this->percent_forb_coverage = '';
			$this->percent_grass_coverage = '';
			$this->percent_sedge_coverage = '';
			$this->percent_rush_coverage = '';
			$this->percent_fern_coverage = '';
			$this->percent_bryophyte_coverage = '';
			$this->tree_riv = 'n/a';
			$this->shrub_riv = 'n/a';
			$this->vine_riv = 'n/a';
			$this->forb_riv = 'n/a';
			$this->grass_riv = 'n/a';
			$this->sedge_riv = 'n/a';
			$this->rush_riv = 'n/a';
			$this->fern_riv = 'n/a';
			$this->bryophyte_riv = 'n/a';
		} else {
			if ($this->native_tree == 0)
				$this->native_tree_mean_c = 'n/a';
			else
				if ($this->native_species > 0) {
					$this->native_tree_mean_c = round(($this->native_tree_c / $this->native_species), 1);
				}
			if ($this->native_shrub == 0)
				$this->native_shrub_mean_c = 'n/a';
			else
				if ($this->native_species > 0) {
					$this->native_shrub_mean_c = round(($this->native_shrub_c / $this->native_species), 1);
				}
			if ( $this->native_herbaceous == 0 )
				$this->native_herbaceous_mean_c = 'n/a';
			else
				if ($this->native_species > 0) {
					$this->native_herbaceous_mean_c = round(($this->native_herbaceous_c / $this->native_species), 1);
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
				
				$this->total_coverage = ($this->total_coverage == 0) ? 1 : $this->total_coverage;
				$this->percent_tree_coverage = round(100*$this->tree_coverage / $this->total_coverage,1);
				$this->percent_shrub_coverage = round(100*$this->shrub_coverage / $this->total_coverage,1);
				$this->percent_vine_coverage = round(100*$this->vine_coverage / $this->total_coverage,1);
				$this->percent_forb_coverage = round(100*$this->forb_coverage / $this->total_coverage,1);
				$this->percent_grass_coverage = round(100*$this->grass_coverage / $this->total_coverage,1);
				$this->percent_sedge_coverage = round(100*$this->sedge_coverage / $this->total_coverage,1);
				$this->percent_rush_coverage = round(100*$this->rush_coverage / $this->total_coverage,1);
				$this->percent_fern_coverage = round(100*$this->fern_coverage / $this->total_coverage,1);
				$this->percent_bryophyte_coverage = round(100*$this->bryophyte_coverage / $this->total_coverage,1);
				
				$this->tree_riv = round(($this->percent_tree + $this->percent_tree_coverage)/2, 1);
				$this->shrub_riv = round(($this->percent_shrub + $this->percent_shrub_coverage)/2, 1);
				$this->vine_riv = round(($this->percent_vine + $this->percent_vine_coverage)/2, 1);
				$this->forb_riv = round(($this->percent_forb + $this->percent_forb_coverage)/2, 1);
				$this->grass_riv = round(($this->percent_grass + $this->percent_grass_coverage)/2, 1);
				$this->sedge_riv = round(($this->percent_sedge + $this->percent_sedge_coverage)/2, 1);
				$this->rush_riv = round(($this->percent_rush + $this->percent_rush_coverage)/2, 1);
				$this->fern_riv = round(($this->percent_fern + $this->percent_fern_coverage)/2, 1);
				$this->bryophyte_riv = round(($this->percent_bryophyte + $this->percent_bryophyte_coverage)/2, 1);
			}
		}
		
		if (!$this->duration) {
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
			}	
			if ($this->native_species > 0) {
				$this->percent_native_annual = round(100*$this->native_annual / $this->native_species,1);
				$this->percent_native_perennial = round(100*$this->native_perennial / $this->native_species,1);
				$this->percent_native_biennial = round(100*$this->native_biennial / $this->native_species,1);
			}
		}
		
		if ($this->wetness) {
			if ($this->total_species > 0)
				$this->mean_wetness = round(($this->total_w / $this->total_species),1);
			if ($this->native_species > 0)
				$this->native_mean_wetness = round(($this->native_w / $this->native_species),1);
		} else {
			$this->mean_wetness = 'n/a';
			$this->native_mean_wetness = 'n/a';
		}
		
		$this->non_native_species = $this->total_species - $this->native_species;
			
		if ($this->native_species > 0) {
			$this->native_mean_c = round(($this->native_c / $this->native_species),1);
			$this->native_fqi = round(($this->native_mean_c * sqrt( $this->native_species ) ), 1);
			if ($this->native_coverage > 0) {
				$this->cover_weighted_native_mean_c = round( $this->sum_native_c_times_coverage / $this->native_coverage , 1 );
				$this->cover_weighted_native_fqi = round( ($this->cover_weighted_native_mean_c * sqrt( $this->native_species )), 1);
			}
		}
		
		if ($this->total_species > 0) {
		
			$this->total_mean_c = round(($this->total_c / $this->total_species),1);
			$this->percent_c_0 = round(($this->c_0 / $this->total_species) * 100,1);
			$this->percent_c_1_3 = round(($this->c_1_3 / $this->total_species) * 100,1);
			$this->percent_c_4_6 = round(($this->c_4_6 / $this->total_species) * 100,1);
			$this->percent_c_7_10 = round(($this->c_7_10 / $this->total_species) * 100,1);
			
			$this->percent_native_species = round(100*($this->native_species/$this->total_species),1);
			$this->percent_non_native_species = round(100*($this->non_native_species/$this->total_species),1);
			
			$this->total_fqi = round(( $this->total_mean_c * sqrt( $this->total_species ) ), 1);
			$this->adjusted_fqi = round( ( ( $this->native_mean_c / 10 ) * ( sqrt( $this->native_species ) / sqrt( $this->total_species ) ) * 100 ), 1);
			
			if ($this->total_coverage > 0) {
				$this->cover_weighted_total_mean_c = round( $this->sum_total_c_times_coverage / $this->total_coverage , 1 );
				$this->cover_weighted_total_fqi = round( ($this->cover_weighted_total_mean_c * sqrt( $this->total_species )), 1);
			}
		}	
	}	
}
?>