<?php
class TransectMetrics extends QuadratMetrics {

	/*
	 * constructor
	 * takes as input a Transect object
	 */
	public function __construct( $transect ) {
	
		Metrics::__construct( $transect );
		
		$quadrats = $transect->quadrats;
		
		foreach( $quadrats as $quadrat ) {
		
			$this->total_species += $quadrat->metrics->total_species;
			$this->total_c += $quadrat->metrics->total_c;
			$this->total_coverage += $quadrat->metrics->total_coverage;
			$this->sum_total_c_times_coverage += $quadrat->metrics->sum_total_c_times_coverage;

			$this->native_species += $quadrat->metrics->native_species;
			$this->native_c += $quadrat->metrics->native_c;
			$this->native_w += $quadrat->metrics->native_w;
			$this->native_coverage += $quadrat->metrics->native_coverage;
			$this->sum_native_c_times_coverage += $quadrat->metrics->sum_native_c_times_coverage;
			
			$this->c_0 += $quadrat->metrics->c_0;
			$this->c_1_3 += $quadrat->metrics->c_1_3;
			$this->c_4_6 += $quadrat->metrics->c_4_6;
			$this->c_7_10 += $quadrat->metrics->c_7_10;			
			
			if ($quadrat->metrics->wetness) {
				$this->wetness = true;
				$this->total_w += $quadrat->metrics->total_w;
			}
			
			if ($quadrat->metrics->duration) {
				$this->duration = true;
				$this->annual += $quadrat->metrics->annual;
				$this->native_annual += $quadrat->metrics->native_annual;
				$this->perennial += $quadrat->metrics->perennial;
				$this->native_perennial += $quadrat->metrics->native_perennial;
				$this->biennial += $quadrat->metrics->biennial;
				$this->native_biennial += $quadrat->metrics->native_biennial;
			}
			
			if ($quadrat->metrics->physiognomy) {
			
				$this->physiognomy = true;
				
				$this->tree += $quadrat->metrics->tree;
				$this->shrub += $quadrat->metrics->shrub;
				$this->vine += $quadrat->metrics->vine;
				$this->forb += $quadrat->metrics->forb;
				$this->grass += $quadrat->metrics->grass;
				$this->sedge += $quadrat->metrics->sedge;
				$this->rush += $quadrat->metrics->rush;
				$this->fern += $quadrat->metrics->fern;
				$this->bryophyte += $quadrat->metrics->bryophyte;
				
				$this->native_tree += $quadrat->metrics->native_tree;
				$this->native_tree_c += $quadrat->metrics->native_tree_c;
				$this->native_shrub += $quadrat->metrics->native_shrub;
				$this->native_shrub_c += $quadrat->metrics->native_shrub_c;
				$this->native_herbaceous += $quadrat->metrics->native_herbaceous;
				$this->native_herbaceous_c += $quadrat->metrics->native_herbaceous_c;
			}
			
			/* get data for relative importance */
			
			
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