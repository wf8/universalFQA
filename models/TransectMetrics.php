<?php
class TransectMetrics extends QuadratMetrics {

	public $taxa = array(); // array of TransectMetricsTaxa objects
	public $total_frequency = 0;
	
	/*
	 * constructor
	 * takes as input a Transect object
	 */
	public function __construct( $transect ) {
	
		Metrics::__construct( $transect );
		
		$quadrats = $transect->quadrats;

		foreach( $quadrats as $quadrat ) {
		
			if ($quadrat->active) {
			
				if ($quadrat->metrics->wetness)
					$this->wetness = true;
				if ($quadrat->metrics->physiognomy)
					$this->physiognomy = true;
				if ($quadrat->metrics->duration)
					$this->duration = true;
				
				// see if need to insert 'percent bare ground' into metric taxa
				// so that it is included in species RIV
				$found = false;
				if ($quadrat->percent_bare_ground !== null) {
					foreach ($this->taxa as $metric_taxon) {
						if ($metric_taxon->taxa->id == 'percent_bare_ground') {
							// update frequency and coverage
							$metric_taxon->frequency++;
							$metric_taxon->coverage += $quadrat->percent_bare_ground;
							$found = true;
							break;
						}
					}
					if (!$found) {
						// make new TransectMetricsTaxa
						$metric_taxon = new TransectMetricsTaxa();
						$metric_taxon->frequency = 1;
						$metric_taxon->coverage = $quadrat->percent_bare_ground;
						// make empty Taxa object
						$metric_taxon->taxa = new Taxa();
						$metric_taxon->taxa->id = 'percent_bare_ground';
						$metric_taxon->taxa->scientific_name = 'Bare ground';
						$this->taxa[] = $metric_taxon;
					}
				}
			
				// insert 'percent water' if need be
				$found = false;	
				if ($quadrat->percent_water !== null) {
					foreach ($this->taxa as $metric_taxon) {
						if ($metric_taxon->taxa->id == 'percent_water') {
							// update frequency and coverage
							$metric_taxon->frequency++;
							$metric_taxon->coverage += $quadrat->percent_water;
							$found = true;
							break;
						}
					}
					if (!$found) {
						// make new TransectMetricsTaxa
						$metric_taxon = new TransectMetricsTaxa();
						$metric_taxon->frequency = 1;
						$metric_taxon->coverage = $quadrat->percent_water;
						// make empty Taxa object
						$metric_taxon->taxa = new Taxa();
						$metric_taxon->taxa->id = 'percent_water';
						$metric_taxon->taxa->scientific_name = 'Water';
						$this->taxa[] = $metric_taxon;
					}
				}

				foreach ($quadrat->taxa as $taxon) {
					$this->total_frequency++;
					// check to see if this taxa is already in the transect metrics
					$found = false;
					foreach ($this->taxa as $metric_taxon) {
						if ($taxon->id == $metric_taxon->taxa->id) {
							// update frequence and coverage
							$metric_taxon->frequency++;
							$metric_taxon->coverage += $taxon->percent_cover;
							$found = true;
							break;
						}
					}
					if (!$found) {
						// make new TransectMetricsTaxa
						$metric_taxon = new TransectMetricsTaxa();
						$metric_taxon->frequency = 1;
						$metric_taxon->coverage = $taxon->percent_cover;
						$metric_taxon->taxa = $taxon;
						$this->taxa[] = $metric_taxon;
						
						$this->total_species++;
						$this->total_c += $taxon->c_o_c;
						if ($quadrat->metrics->wetness)
							$this->total_w += $taxon->c_o_w;
						if ($taxon->native == 'native') {
							$this->native_species++;
							$this->native_c += $taxon->c_o_c;
							if ($quadrat->metrics->wetness)
								$this->native_w += $taxon->c_o_w;
						}
						if ($taxon->c_o_c == 0)
							$this->c_0++;
						else if (0 < $taxon->c_o_c && $taxon->c_o_c < 4)
							$this->c_1_3++;
						else if (3 < $taxon->c_o_c && $taxon->c_o_c < 7)
							$this->c_4_6++;
						else if (6 < $taxon->c_o_c && $taxon->c_o_c < 11)
							$this->c_7_10++;
							
						if ($quadrat->metrics->duration) {
							if ($taxon->duration == 'annual') {
								$this->annual++;
								if ($taxon->native == 'native') {
									$this->native_annual++;
								}
							}
							if ($taxon->duration == 'perennial') {
								$this->perennial++;
								if ($taxon->native == 'native') {
									$this->native_perennial++;
								}
							}
							if ($taxon->duration == 'biennial') {
								$this->biennial++;
								if ($taxon->native == 'native') {
									$this->native_biennial++;
								}
							}
						}
						
						if ($quadrat->metrics->physiognomy) {
						
							switch ($taxon->physiognomy) {
								case 'tree':
									$this->physiognomy = true;
									$this->tree++;
									if ($taxon->native == 'native') {
										$this->native_tree_c += $taxon->c_o_c;
										$this->native_tree++;
									}
									break;
								case 'shrub':
									$this->physiognomy = true;
									$this->shrub++;
									if ($taxon->native == 'native') {
										$this->native_shrub_c += $taxon->c_o_c;
										$this->native_shrub++;
									}
									break;
								case 'vine':
									$this->physiognomy = true;
									$this->vine++;
									if ($taxon->native == 'native') {
										$this->native_herbaceous_c += $taxon->c_o_c;
										$this->native_herbaceous++;
									}
									break;
								case 'forb':
									$this->physiognomy = true;
									$this->forb++;
									if ($taxon->native == 'native') {
										$this->native_herbaceous_c += $taxon->c_o_c;
										$this->native_herbaceous++;
									}
									break;
								case 'grass':
									$this->physiognomy = true;
									$this->grass++;
									if ($taxon->native == 'native') {
										$this->native_herbaceous_c += $taxon->c_o_c;
										$this->native_herbaceous++;
									}
									break;
								case 'sedge':
									$this->physiognomy = true;
									$this->sedge++;
									if ($taxon->native == 'native') {
										$this->native_herbaceous_c += $taxon->c_o_c;
										$this->native_herbaceous++;
									}
									break;
								case 'rush':
									$this->physiognomy = true;
									$this->rush++;
									if ($taxon->native == 'native') {
										$this->native_herbaceous_c += $taxon->c_o_c;
										$this->native_herbaceous++;
									}
									break;
								case 'fern':
									$this->physiognomy = true;
									$this->fern++;
									if ($taxon->native == 'native') {
										$this->native_herbaceous_c += $taxon->c_o_c;
										$this->native_herbaceous++;
									}
									break;
								case 'bryophyte':
									$this->physiognomy = true;
									$this->bryophyte++;
									if ($taxon->native == 'native') {
										$this->native_herbaceous_c += $taxon->c_o_c;
										$this->native_herbaceous++;
									}
									break;
							}
						}			
					}
				}
			}
		}
		// done looping through quadrats
		
		// now generate average coverage for each taxa
		// and calculate total coverage
		foreach ($this->taxa as $metric_taxon) {
			$metric_taxon->percent_cover = round($metric_taxon->coverage / $metric_taxon->frequency, 1);
			$this->total_coverage += $metric_taxon->coverage;
			$this->total_percent_cover += $metric_taxon->percent_cover;
			$this->sum_total_c_times_coverage += ($metric_taxon->percent_cover * $metric_taxon->taxa->c_o_c);
			if ($metric_taxon->taxa->native == 'native') {
				$this->native_percent_cover += $metric_taxon->percent_cover;
				$this->sum_native_c_times_coverage += ($metric_taxon->percent_cover * $metric_taxon->taxa->c_o_c);
			}
			
			if ($this->physiognomy) {
				// now compute physiognomy coverage
				switch ($metric_taxon->taxa->physiognomy) {
					case 'tree':
						$this->tree_coverage += $metric_taxon->coverage;
						break;
					case 'shrub':
						$this->shrub_coverage += $metric_taxon->coverage;
						break;
					case 'vine':
						$this->vine_coverage += $metric_taxon->coverage;
						break;
					case 'forb':
						$this->forb_coverage += $metric_taxon->coverage;
						break;
					case 'grass':
						$this->grass_coverage += $metric_taxon->coverage;
						break;
					case 'sedge':
						$this->sedge_coverage += $metric_taxon->coverage;
						break;
					case 'rush':
						$this->rush_coverage += $metric_taxon->coverage;
						break;
					case 'fern':
						$this->fern_coverage += $metric_taxon->coverage;
						break;
					case 'bryophyte':
						$this->bryophyte_coverage += $metric_taxon->coverage;
						break;
				}
			}
		}
		
		// now calculate RIVs for each species
		foreach ($this->taxa as $metric_taxon) {
			$metric_taxon->relative_cover = round(100 * $metric_taxon->coverage / $this->total_coverage, 1);
			$metric_taxon->relative_frequency = round(100 * $metric_taxon->frequency / $this->total_frequency, 1);
			$metric_taxon->relative_importance_value = round( ($metric_taxon->relative_cover + $metric_taxon->relative_frequency)/2, 1);
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
			}
			if ($this->total_coverage > 0) {	
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
			if ($this->native_percent_cover > 0) {
				$this->cover_weighted_native_mean_c = round( $this->sum_native_c_times_coverage / $this->native_percent_cover , 1 );
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
			
			if ($this->total_percent_cover > 0) {
				$this->cover_weighted_total_mean_c = round( $this->sum_total_c_times_coverage / $this->total_percent_cover , 1 );
				$this->cover_weighted_total_fqi = round( ($this->cover_weighted_total_mean_c * sqrt( $this->total_species )), 1);
			}
		}
	}	
}
?>
