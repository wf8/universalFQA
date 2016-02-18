<?php
class TransectMetrics extends QuadratMetrics {

	public $taxa = array(); // array of TransectMetricsTaxa objects
	public $total_frequency = 0;
	public $riv = array(); 
	
	public $nonnative_tree = 0;
	public $nonnative_shrub = 0;
	public $nonnative_vine = 0;
	public $nonnative_forb = 0;
	public $nonnative_grass = 0;
	public $nonnative_sedge = 0;
	public $nonnative_rush = 0;
	public $nonnative_fern = 0;
	public $nonnative_bryophyte = 0;
	
	public $nonnative_tree_coverage = 0;
	public $nonnative_shrub_coverage = 0;
	public $nonnative_vine_coverage = 0;
	public $nonnative_forb_coverage = 0;
	public $nonnative_grass_coverage = 0;
	public $nonnative_sedge_coverage = 0;
	public $nonnative_rush_coverage = 0;
	public $nonnative_fern_coverage = 0;
	public $nonnative_bryophyte_coverage = 0;
	
	public $nonnative_percent_tree = 0;
	public $nonnative_percent_shrub = 0;
	public $nonnative_percent_vine = 0;
	public $nonnative_percent_forb = 0;
	public $nonnative_percent_grass = 0;
	public $nonnative_percent_sedge = 0;
	public $nonnative_percent_rush = 0;
	public $nonnative_percent_fern = 0;
	public $nonnative_percent_bryophyte = 0;
	
	public $nonnative_percent_tree_coverage = 0;
	public $nonnative_percent_shrub_coverage = 0;
	public $nonnative_percent_vine_coverage = 0;
	public $nonnative_percent_forb_coverage = 0;
	public $nonnative_percent_grass_coverage = 0;
	public $nonnative_percent_sedge_coverage = 0;
	public $nonnative_percent_rush_coverage = 0;
	public $nonnative_percent_fern_coverage = 0;
	public $nonnative_percent_bryophyte_coverage = 0;
	
	public $nonnative_tree_riv = 0;
	public $nonnative_shrub_riv = 0;
	public $nonnative_vine_riv = 0;
	public $nonnative_forb_riv = 0;
	public $nonnative_grass_riv = 0;
	public $nonnative_sedge_riv = 0;
	public $nonnative_rush_riv = 0;
	public $nonnative_fern_riv = 0;
	public $nonnative_bryophyte_riv = 0;

	public $native_tree = 0;
	public $native_shrub = 0;
	public $native_vine = 0;
	public $native_forb = 0;
	public $native_grass = 0;
	public $native_sedge = 0;
	public $native_rush = 0;
	public $native_fern = 0;
	public $native_bryophyte = 0;
	
	public $native_tree_coverage = 0;
	public $native_shrub_coverage = 0;
	public $native_vine_coverage = 0;
	public $native_forb_coverage = 0;
	public $native_grass_coverage = 0;
	public $native_sedge_coverage = 0;
	public $native_rush_coverage = 0;
	public $native_fern_coverage = 0;
	public $native_bryophyte_coverage = 0;
	
	public $native_percent_tree = 0;
	public $native_percent_shrub = 0;
	public $native_percent_vine = 0;
	public $native_percent_forb = 0;
	public $native_percent_grass = 0;
	public $native_percent_sedge = 0;
	public $native_percent_rush = 0;
	public $native_percent_fern = 0;
	public $native_percent_bryophyte = 0;
	
	public $native_percent_tree_coverage = 0;
	public $native_percent_shrub_coverage = 0;
	public $native_percent_vine_coverage = 0;
	public $native_percent_forb_coverage = 0;
	public $native_percent_grass_coverage = 0;
	public $native_percent_sedge_coverage = 0;
	public $native_percent_rush_coverage = 0;
	public $native_percent_fern_coverage = 0;
	public $native_percent_bryophyte_coverage = 0;
	
	public $native_tree_riv = 0;
	public $native_shrub_riv = 0;
	public $native_vine_riv = 0;
	public $native_forb_riv = 0;
	public $native_grass_riv = 0;
	public $native_sedge_riv = 0;
	public $native_rush_riv = 0;
	public $native_fern_riv = 0;
	public $native_bryophyte_riv = 0;

	public $avg_total_species = 0;
	public $avg_native_species = 0;
	public $avg_total_mean_c = 0;
	public $avg_native_mean_c = 0;
	public $avg_total_fqi = 0;
	public $avg_native_fqi = 0;
	public $avg_cover_weighted_total_fqi = 0;
	public $avg_cover_weighted_native_fqi = 0;
	public $avg_adjusted_fqi = 0;
	public $avg_mean_wetness = 0;
	public $avg_native_mean_wetness = 0;

	public $sd_total_species = 0;
	public $sd_native_species = 0;
	public $sd_total_mean_c = 0;
	public $sd_native_mean_c = 0;
	public $sd_total_fqi = 0;
	public $sd_native_fqi = 0;
	public $sd_cover_weighted_total_fqi = 0;
	public $sd_cover_weighted_native_fqi = 0;
	public $sd_adjusted_fqi = 0;
	public $sd_mean_wetness = 0;
	public $sd_native_mean_wetness = 0;

	/*
	 * constructor
	 * takes as input a Transect object
	 */
	public function __construct( $transect ) {
	
		Metrics::__construct( $transect );
		
		$quadrats = $transect->quadrats;

		// arrays to calculate average and SD values of quadrat metrics
		$ts_array = array();
		$ns_array = array();
		$tmc_array = array();
		$nmc_array = array();
		$tfqi_array = array();
		$nfqi_array = array();
		$cwtfqi_array = array();
		$cwnfqi_array = array();
		$afqi_array = array();
		$mw_array = array();
		$nmw_array = array();

		foreach( $quadrats as $quadrat ) {
		
			if ($quadrat->active) {
			
				if ($quadrat->metrics->wetness)
					$this->wetness = true;
				if ($quadrat->metrics->physiognomy)
					$this->physiognomy = true;
				if ($quadrat->metrics->duration)
					$this->duration = true;
				
				$ts_array[] = $quadrat->metrics->total_species;
				$ns_array[] = $quadrat->metrics->native_species;
				$tmc_array[] = $quadrat->metrics->total_mean_c;
				$nmc_array[] = $quadrat->metrics->native_mean_c;
				$tfqi_array[] = $quadrat->metrics->total_fqi;
				$nfqi_array[] = $quadrat->metrics->native_fqi;
				$cwtfqi_array[] = $quadrat->metrics->cover_weighted_total_fqi;
				$cwnfqi_array[] = $quadrat->metrics->cover_weighted_native_fqi;
				$afqi_array[] = $quadrat->metrics->adjusted_fqi;
				$mw_array[] = $quadrat->metrics->mean_wetness;
				$nmw_array[] = $quadrat->metrics->native_mean_wetness;

				// see if need to insert 'percent bare ground' into metric taxa
				// so that it is included in species RIV
				$found = false;
				if ($quadrat->percent_bare_ground !== null) {
					$this->total_frequency++;
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
					$this->total_frequency++;
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
					}						
					if ($quadrat->metrics->physiognomy) {
					
						switch ($taxon->physiognomy) {
							case 'tree':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_tree_c += $taxon->c_o_c;
									$this->native_tree++;
								} else {
									$this->nonnative_tree_c += $taxon->c_o_c;
									$this->nonnative_tree++;
								}
								break;
							case 'shrub':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_shrub_c += $taxon->c_o_c;
									$this->native_shrub++;
								} else {
									$this->nonnative_shrub_c += $taxon->c_o_c;
									$this->nonnative_shrub++;								
								}
								break;
							case 'vine':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_vine_c += $taxon->c_o_c;
									$this->native_vine++;
								} else {
									$this->nonnative_vine_c += $taxon->c_o_c;
									$this->nonnative_vine++;
								}
								break;
							case 'forb':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_forb_c += $taxon->c_o_c;
									$this->native_forb++;
								} else {
									$this->nonnative_forb_c += $taxon->c_o_c;
									$this->nonnative_forb++;
								}
								break;
							case 'grass':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_grass_c += $taxon->c_o_c;
									$this->native_grass++;
								} else {
									$this->nonnative_grass_c += $taxon->c_o_c;
									$this->nonnative_grass++;
								}
								break;
							case 'sedge':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_sedge_c += $taxon->c_o_c;
									$this->native_sedge++;
								} else {
									$this->nonnative_sedge_c += $taxon->c_o_c;
									$this->nonnative_sedge++;
								}
								break;
							case 'rush':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_rush_c += $taxon->c_o_c;
									$this->native_rush++;
								} else {
									$this->nonnative_rush_c += $taxon->c_o_c;
									$this->nonnative_rush++;
								}
								break;
							case 'fern':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_rush_c += $taxon->c_o_c;
									$this->native_rush++;
								} else {
									$this->nonnative_rush_c += $taxon->c_o_c;
									$this->nonnative_rush++;
								}
								break;
							case 'bryophyte':
								$this->physiognomy = true;
								if ($taxon->native == 'native') {
									$this->native_bryophyte_c += $taxon->c_o_c;
									$this->native_bryophyte++;
								} else {
									$this->nonnative_bryophyte_c += $taxon->c_o_c;
									$this->nonnative_bryophyte++;
								}
								break;
						}
					}
				}
			}
		}
		// done looping through quadrats
	
		//compute quadrat level averages and SDs
		$this->avg_total_species = $this->average($ts_array);
		$this->avg_native_species = $this->average($ns_array);
		$this->avg_total_mean_c = $this->average($tmc_array);
		$this->avg_native_mean_c = $this->average($nmc_array);
		$this->avg_total_fqi = $this->average($tfqi_array);
		$this->avg_native_fqi = $this->average($nfqi_array);
		$this->avg_cover_weighted_total_fqi = $this->average($cwtfqi_array);
		$this->avg_cover_weighted_native_fqi = $this->average($cwnfqi_array);
		$this->avg_adjusted_fqi = $this->average($afqi_array);
		$this->avg_mean_wetness = $this->average($mw_array);
		$this->avg_native_mean_wetness = $this->average($nmw_array);
		
		$this->sd_total_species = $this->standard_deviation($ts_array);
		$this->sd_native_species = $this->standard_deviation($ns_array);
		$this->sd_total_mean_c = $this->standard_deviation($tmc_array);
		$this->sd_native_mean_c = $this->standard_deviation($nmc_array);
		$this->sd_total_fqi = $this->standard_deviation($tfqi_array);
		$this->sd_native_fqi = $this->standard_deviation($nfqi_array);
		$this->sd_cover_weighted_total_fqi = $this->standard_deviation($cwtfqi_array);
		$this->sd_cover_weighted_native_fqi = $this->standard_deviation($cwnfqi_array);
		$this->sd_adjusted_fqi = $this->standard_deviation($afqi_array);
		$this->sd_mean_wetness = $this->standard_deviation($mw_array);
		$this->sd_native_mean_wetness = $this->standard_deviation($nmw_array);

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
				if ($metric_taxon->taxa->native == 'native') {
					switch ($metric_taxon->taxa->physiognomy) {
						case 'tree':
							$this->native_tree_coverage += $metric_taxon->coverage;
							break;
						case 'shrub':
							$this->native_shrub_coverage += $metric_taxon->coverage;
							break;
						case 'vine':
							$this->native_vine_coverage += $metric_taxon->coverage;
							break;
						case 'forb':
							$this->native_forb_coverage += $metric_taxon->coverage;
							break;
						case 'grass':
							$this->native_grass_coverage += $metric_taxon->coverage;
							break;
						case 'sedge':
							$this->native_sedge_coverage += $metric_taxon->coverage;
							break;
						case 'rush':
							$this->native_rush_coverage += $metric_taxon->coverage;
							break;
						case 'fern':
							$this->native_fern_coverage += $metric_taxon->coverage;
							break;
						case 'bryophyte':
							$this->native_bryophyte_coverage += $metric_taxon->coverage;
							break;
					}
				} else {
					switch ($metric_taxon->taxa->physiognomy) {
						case 'tree':
							$this->nonnative_tree_coverage += $metric_taxon->coverage;
							break;
						case 'shrub':
							$this->nonnative_shrub_coverage += $metric_taxon->coverage;
							break;
						case 'vine':
							$this->nonnative_vine_coverage += $metric_taxon->coverage;
							break;
						case 'forb':
							$this->nonnative_forb_coverage += $metric_taxon->coverage;
							break;
						case 'grass':
							$this->nonnative_grass_coverage += $metric_taxon->coverage;
							break;
						case 'sedge':
							$this->nonnative_sedge_coverage += $metric_taxon->coverage;
							break;
						case 'rush':
							$this->nonnative_rush_coverage += $metric_taxon->coverage;
							break;
						case 'fern':
							$this->nonnative_fern_coverage += $metric_taxon->coverage;
							break;
						case 'bryophyte':
							$this->nonnative_bryophyte_coverage += $metric_taxon->coverage;
							break;
					}
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
			$this->native_tree = 'n/a';
			$this->native_shrub = 'n/a';
			$this->native_vine = 'n/a';
			$this->native_forb = 'n/a';
			$this->native_grass = 'n/a';
			$this->native_sedge = 'n/a';
			$this->native_rush = 'n/a';
			$this->native_fern = 'n/a';
			$this->native_bryophyte = 'n/a';
			$this->native_percent_tree = '';
			$this->native_percent_shrub = '';
			$this->native_percent_vine = '';
			$this->native_percent_forb = '';
			$this->native_percent_grass = '';
			$this->native_percent_sedge = '';
			$this->native_percent_rush = '';
			$this->native_percent_fern = '';
			$this->native_percent_bryophyte = '';
			$this->native_percent_bryophyte = '';
			$this->native_tree_coverage = 'n/a';
			$this->native_shrub_coverage = 'n/a';
			$this->native_vine_coverage = 'n/a';
			$this->native_forb_coverage = 'n/a';
			$this->native_grass_coverage = 'n/a';
			$this->native_sedge_coverage = 'n/a';
			$this->native_rush_coverage = 'n/a';
			$this->native_fern_coverage = 'n/a';
			$this->native_bryophyte_coverage = 'n/a';
			$this->native_percent_tree_coverage = '';
			$this->native_percent_shrub_coverage = '';
			$this->native_percent_vine_coverage = '';
			$this->native_percent_forb_coverage = '';
			$this->native_percent_grass_coverage = '';
			$this->native_percent_sedge_coverage = '';
			$this->native_percent_rush_coverage = '';
			$this->native_percent_fern_coverage = '';
			$this->native_percent_bryophyte_coverage = '';
			$this->native_tree_riv = 'n/a';
			$this->native_shrub_riv = 'n/a';
			$this->native_vine_riv = 'n/a';
			$this->native_forb_riv = 'n/a';
			$this->native_grass_riv = 'n/a';
			$this->native_sedge_riv = 'n/a';
			$this->native_rush_riv = 'n/a';
			$this->native_fern_riv = 'n/a';
			$this->native_bryophyte_riv = 'n/a';
			
			$this->nonnative_tree = 'n/a';
			$this->nonnative_shrub = 'n/a';
			$this->nonnative_vine = 'n/a';
			$this->nonnative_forb = 'n/a';
			$this->nonnative_grass = 'n/a';
			$this->nonnative_sedge = 'n/a';
			$this->nonnative_rush = 'n/a';
			$this->nonnative_fern = 'n/a';
			$this->nonnative_bryophyte = 'n/a';
			$this->nonnative_percent_tree = '';
			$this->nonnative_percent_shrub = '';
			$this->nonnative_percent_vine = '';
			$this->nonnative_percent_forb = '';
			$this->nonnative_percent_grass = '';
			$this->nonnative_percent_sedge = '';
			$this->nonnative_percent_rush = '';
			$this->nonnative_percent_fern = '';
			$this->nonnative_percent_bryophyte = '';
			$this->nonnative_percent_bryophyte = '';
			$this->nonnative_tree_coverage = 'n/a';
			$this->nonnative_shrub_coverage = 'n/a';
			$this->nonnative_vine_coverage = 'n/a';
			$this->nonnative_forb_coverage = 'n/a';
			$this->nonnative_grass_coverage = 'n/a';
			$this->nonnative_sedge_coverage = 'n/a';
			$this->nonnative_rush_coverage = 'n/a';
			$this->nonnative_fern_coverage = 'n/a';
			$this->nonnative_bryophyte_coverage = 'n/a';
			$this->nonnative_percent_tree_coverage = '';
			$this->nonnative_percent_shrub_coverage = '';
			$this->nonnative_percent_vine_coverage = '';
			$this->nonnative_percent_forb_coverage = '';
			$this->nonnative_percent_grass_coverage = '';
			$this->nonnative_percent_sedge_coverage = '';
			$this->nonnative_percent_rush_coverage = '';
			$this->nonnative_percent_fern_coverage = '';
			$this->nonnative_percent_bryophyte_coverage = '';
			$this->nonnative_tree_riv = 'n/a';
			$this->nonnative_shrub_riv = 'n/a';
			$this->nonnative_vine_riv = 'n/a';
			$this->nonnative_forb_riv = 'n/a';
			$this->nonnative_grass_riv = 'n/a';
			$this->nonnative_sedge_riv = 'n/a';
			$this->nonnative_rush_riv = 'n/a';
			$this->nonnative_fern_riv = 'n/a';
			$this->nonnative_bryophyte_riv = 'n/a';
		} else {
			if ($this->total_species > 0) {
				$this->nonnative_percent_tree = round(100*$this->nonnative_tree / $this->total_species,1);
				$this->nonnative_percent_shrub = round(100*$this->nonnative_shrub / $this->total_species,1);
				$this->nonnative_percent_vine = round(100*$this->nonnative_vine / $this->total_species,1);
				$this->nonnative_percent_forb = round(100*$this->nonnative_forb / $this->total_species,1);
				$this->nonnative_percent_grass = round(100*$this->nonnative_grass / $this->total_species,1);
				$this->nonnative_percent_sedge = round(100*$this->nonnative_sedge / $this->total_species,1);
				$this->nonnative_percent_rush = round(100*$this->nonnative_rush / $this->total_species,1);
				$this->nonnative_percent_fern = round(100*$this->nonnative_fern / $this->total_species,1);
				$this->nonnative_percent_bryophyte = round(100*$this->nonnative_bryophyte / $this->total_species,1);
				
				$this->native_percent_tree = round(100*$this->native_tree / $this->total_species,1);
				$this->native_percent_shrub = round(100*$this->native_shrub / $this->total_species,1);
				$this->native_percent_vine = round(100*$this->native_vine / $this->total_species,1);
				$this->native_percent_forb = round(100*$this->native_forb / $this->total_species,1);
				$this->native_percent_grass = round(100*$this->native_grass / $this->total_species,1);
				$this->native_percent_sedge = round(100*$this->native_sedge / $this->total_species,1);
				$this->native_percent_rush = round(100*$this->native_rush / $this->total_species,1);
				$this->native_percent_fern = round(100*$this->native_fern / $this->total_species,1);
				$this->native_percent_bryophyte = round(100*$this->native_bryophyte / $this->total_species,1);
			}
			if ($this->total_coverage > 0) {	
				$this->nonnative_percent_tree_coverage = round(100*$this->nonnative_tree_coverage / $this->total_coverage,1);
				$this->nonnative_percent_shrub_coverage = round(100*$this->nonnative_shrub_coverage / $this->total_coverage,1);
				$this->nonnative_percent_vine_coverage = round(100*$this->nonnative_vine_coverage / $this->total_coverage,1);
				$this->nonnative_percent_forb_coverage = round(100*$this->nonnative_forb_coverage / $this->total_coverage,1);
				$this->nonnative_percent_grass_coverage = round(100*$this->nonnative_grass_coverage / $this->total_coverage,1);
				$this->nonnative_percent_sedge_coverage = round(100*$this->nonnative_sedge_coverage / $this->total_coverage,1);
				$this->nonnative_percent_rush_coverage = round(100*$this->nonnative_rush_coverage / $this->total_coverage,1);
				$this->nonnative_percent_fern_coverage = round(100*$this->nonnative_fern_coverage / $this->total_coverage,1);
				$this->nonnative_percent_bryophyte_coverage = round(100*$this->nonnative_bryophyte_coverage / $this->total_coverage,1);
				
				$this->nonnative_tree_riv = round(($this->nonnative_percent_tree + $this->nonnative_percent_tree_coverage)/2, 1);
				$this->nonnative_shrub_riv = round(($this->nonnative_percent_shrub + $this->nonnative_percent_shrub_coverage)/2, 1);
				$this->nonnative_vine_riv = round(($this->nonnative_percent_vine + $this->nonnative_percent_vine_coverage)/2, 1);
				$this->nonnative_forb_riv = round(($this->nonnative_percent_forb + $this->nonnative_percent_forb_coverage)/2, 1);
				$this->nonnative_grass_riv = round(($this->nonnative_percent_grass + $this->nonnative_percent_grass_coverage)/2, 1);
				$this->nonnative_sedge_riv = round(($this->nonnative_percent_sedge + $this->nonnative_percent_sedge_coverage)/2, 1);
				$this->nonnative_rush_riv = round(($this->nonnative_percent_rush + $this->nonnative_percent_rush_coverage)/2, 1);
				$this->nonnative_fern_riv = round(($this->nonnative_percent_fern + $this->nonnative_percent_fern_coverage)/2, 1);
				$this->nonnative_bryophyte_riv = round(($this->nonnative_percent_bryophyte + $this->nonnative_percent_bryophyte_coverage)/2, 1);
				
				
				$this->native_percent_tree_coverage = round(100*$this->native_tree_coverage / $this->total_coverage,1);
				$this->native_percent_shrub_coverage = round(100*$this->native_shrub_coverage / $this->total_coverage,1);
				$this->native_percent_vine_coverage = round(100*$this->native_vine_coverage / $this->total_coverage,1);
				$this->native_percent_forb_coverage = round(100*$this->native_forb_coverage / $this->total_coverage,1);
				$this->native_percent_grass_coverage = round(100*$this->native_grass_coverage / $this->total_coverage,1);
				$this->native_percent_sedge_coverage = round(100*$this->native_sedge_coverage / $this->total_coverage,1);
				$this->native_percent_rush_coverage = round(100*$this->native_rush_coverage / $this->total_coverage,1);
				$this->native_percent_fern_coverage = round(100*$this->native_fern_coverage / $this->total_coverage,1);
				$this->native_percent_bryophyte_coverage = round(100*$this->native_bryophyte_coverage / $this->total_coverage,1);
				
				$this->native_tree_riv = round(($this->native_percent_tree + $this->native_percent_tree_coverage)/2, 1);
				$this->native_shrub_riv = round(($this->native_percent_shrub + $this->native_percent_shrub_coverage)/2, 1);
				$this->native_vine_riv = round(($this->native_percent_vine + $this->native_percent_vine_coverage)/2, 1);
				$this->native_forb_riv = round(($this->native_percent_forb + $this->native_percent_forb_coverage)/2, 1);
				$this->native_grass_riv = round(($this->native_percent_grass + $this->native_percent_grass_coverage)/2, 1);
				$this->native_sedge_riv = round(($this->native_percent_sedge + $this->native_percent_sedge_coverage)/2, 1);
				$this->native_rush_riv = round(($this->native_percent_rush + $this->native_percent_rush_coverage)/2, 1);
				$this->native_fern_riv = round(($this->native_percent_fern + $this->native_percent_fern_coverage)/2, 1);
				$this->native_bryophyte_riv = round(($this->native_percent_bryophyte + $this->native_percent_bryophyte_coverage)/2, 1);
			}
		}
		
		// put all RIVs into array
		$this->riv[] = array("physiognomy" => "Native tree",
								"frequency" => $this->native_tree,
								"relative frequency" => $this->native_percent_tree,
								"coverage" => $this->native_tree_coverage,
								"relative coverage" => $this->native_percent_tree_coverage,
								"riv" => $this->native_tree_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native tree",
								"frequency" => $this->nonnative_tree,
								"relative frequency" => $this->nonnative_percent_tree,
								"coverage" => $this->nonnative_tree_coverage,
								"relative coverage" => $this->nonnative_percent_tree_coverage,
								"riv" => $this->nonnative_tree_riv
							);
		$this->riv[] = array("physiognomy" => "Native shrub",
								"frequency" => $this->native_shrub,
								"relative frequency" => $this->native_percent_shrub,
								"coverage" => $this->native_shrub_coverage,
								"relative coverage" => $this->native_percent_shrub_coverage,
								"riv" => $this->native_shrub_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native shrub",
								"frequency" => $this->nonnative_shrub,
								"relative frequency" => $this->nonnative_percent_shrub,
								"coverage" => $this->nonnative_shrub_coverage,
								"relative coverage" => $this->nonnative_percent_shrub_coverage,
								"riv" => $this->nonnative_shrub_riv
							);
		$this->riv[] = array("physiognomy" => "Native vine",
								"frequency" => $this->native_vine,
								"relative frequency" => $this->native_percent_vine,
								"coverage" => $this->native_vine_coverage,
								"relative coverage" => $this->native_percent_vine_coverage,
								"riv" => $this->native_vine_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native vine",
								"frequency" => $this->nonnative_vine,
								"relative frequency" => $this->nonnative_percent_vine,
								"coverage" => $this->nonnative_vine_coverage,
								"relative coverage" => $this->nonnative_percent_vine_coverage,
								"riv" => $this->nonnative_vine_riv
							);
		$this->riv[] = array("physiognomy" => "Native forb",
								"frequency" => $this->native_forb,
								"relative frequency" => $this->native_percent_forb,
								"coverage" => $this->native_forb_coverage,
								"relative coverage" => $this->native_percent_forb_coverage,
								"riv" => $this->native_forb_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native forb",
								"frequency" => $this->nonnative_forb,
								"relative frequency" => $this->nonnative_percent_forb,
								"coverage" => $this->nonnative_forb_coverage,
								"relative coverage" => $this->nonnative_percent_forb_coverage,
								"riv" => $this->nonnative_forb_riv
							);
		$this->riv[] = array("physiognomy" => "Native grass",
								"frequency" => $this->native_grass,
								"relative frequency" => $this->native_percent_grass,
								"coverage" => $this->native_grass_coverage,
								"relative coverage" => $this->native_percent_grass_coverage,
								"riv" => $this->native_grass_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native grass",
								"frequency" => $this->nonnative_grass,
								"relative frequency" => $this->nonnative_percent_grass,
								"coverage" => $this->nonnative_grass_coverage,
								"relative coverage" => $this->nonnative_percent_grass_coverage,
								"riv" => $this->nonnative_grass_riv
							);
		$this->riv[] = array("physiognomy" => "Native sedge",
								"frequency" => $this->native_sedge,
								"relative frequency" => $this->native_percent_sedge,
								"coverage" => $this->native_sedge_coverage,
								"relative coverage" => $this->native_percent_sedge_coverage,
								"riv" => $this->native_sedge_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native sedge",
								"frequency" => $this->nonnative_sedge,
								"relative frequency" => $this->nonnative_percent_sedge,
								"coverage" => $this->nonnative_sedge_coverage,
								"relative coverage" => $this->nonnative_percent_sedge_coverage,
								"riv" => $this->nonnative_sedge_riv
							);
		$this->riv[] = array("physiognomy" => "Native rush",
								"frequency" => $this->native_rush,
								"relative frequency" => $this->native_percent_rush,
								"coverage" => $this->native_rush_coverage,
								"relative coverage" => $this->native_percent_rush_coverage,
								"riv" => $this->native_rush_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native rush",
								"frequency" => $this->nonnative_rush,
								"relative frequency" => $this->nonnative_percent_rush,
								"coverage" => $this->nonnative_rush_coverage,
								"relative coverage" => $this->nonnative_percent_rush_coverage,
								"riv" => $this->nonnative_rush_riv
							);
		$this->riv[] = array("physiognomy" => "Native fern",
								"frequency" => $this->native_fern,
								"relative frequency" => $this->native_percent_fern,
								"coverage" => $this->native_fern_coverage,
								"relative coverage" => $this->native_percent_fern_coverage,
								"riv" => $this->native_fern_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native fern",
								"frequency" => $this->nonnative_fern,
								"relative frequency" => $this->nonnative_percent_fern,
								"coverage" => $this->nonnative_fern_coverage,
								"relative coverage" => $this->nonnative_percent_fern_coverage,
								"riv" => $this->nonnative_fern_riv
							);
		$this->riv[] = array("physiognomy" => "Native bryophyte",
								"frequency" => $this->native_bryophyte,
								"relative frequency" => $this->native_percent_bryophyte,
								"coverage" => $this->native_bryophyte_coverage,
								"relative coverage" => $this->native_percent_bryophyte_coverage,
								"riv" => $this->native_bryophyte_riv
							);
		$this->riv[] = array("physiognomy" => "Non-native bryophyte",
								"frequency" => $this->nonnative_bryophyte,
								"relative frequency" => $this->nonnative_percent_bryophyte,
								"coverage" => $this->nonnative_bryophyte_coverage,
								"relative coverage" => $this->nonnative_percent_bryophyte_coverage,
								"riv" => $this->nonnative_bryophyte_riv
							);
		
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
				$this->percent_native_annual = round(100*$this->native_annual / $this->total_species,1);
				$this->percent_native_perennial = round(100*$this->native_perennial / $this->total_species,1);
				$this->percent_native_biennial = round(100*$this->native_biennial / $this->total_species,1);
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

	
	
	/*
	 * compute SD of an array of values using Welford's method
	 */
	public function standard_deviation( $list ) {
		$m = 0.0;
		$s = 0.0;
		$i = 1;
		foreach ($list as $value) {
			$temp_m = $m;
			$m += ($value - $temp_m) / $i;
			$s += ($value - $temp_m) * ($value - $m);
			$i++;
		}
		if ($i > 1)
			return round(sqrt($s / ($i - 1)), 1);
		else
			return 0;
	}

	/*
	 * compute average of an array
	 */
	public function average( $list ) {
		$i = 0;
		$m = 0.0;
		foreach ($list as $value) {
			$m += $value;
			$i++;
		}
		if ($i > 0) 
			return round($m / $i, 1);
	}

}
?>
